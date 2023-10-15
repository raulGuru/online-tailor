<?php

namespace App\Http\Controllers;
use App\Models\Tailor;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Instamojo;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('measurement') || !$request->session()->has('customer_details')) {
            return redirect()->route('category.index');
        }
        $product_qty = 1;
        $discount = isset($request->discount)? $request->discount : 0;
        $measurement = json_decode($request->session()->get('measurement'), True);
        $customer = json_decode($request->session()->get('customer_details'), True);
        
        $total_measement=0;
        $stitch_name='';
        if($measurement['type']==='top')
        {
            $total_measement=$measurement['length']+$measurement['shoulder']+$measurement['sleeve']+$measurement['chest']+$measurement['waist']+$measurement['hip']+$measurement['neck'];
            $stitch_name='normal-shirt';
        }
        if($measurement['type']==='bottom')
        {

            $total_measement=$measurement['length']+$measurement['waist']+$measurement['hip']+$measurement['thigh']+$measurement['knee']+$measurement['bottom']+$measurement['fock'];           
            $stitch_name='normal-pant';
        }
        
        $total_material_required= round($total_measement / 100);
        $data['total_material_required']=$total_material_required;
        $products =  Product::find($measurement['product_type_id']);
        // Tailor details
        $data['tailor'] =  Tailor::where('id', $customer['tailor_id'])->first(); 
        $stiching_cost = DB::table('stitching_costs')->where([
            'tailor_id' => $customer['tailor_id'],
            'stitch_name' => $stitch_name])->value('cost');
        

        $data['price']['product']=$products->commission_price*$total_material_required;
        //r_dump($data['price']['product']);die;
        // Need to update delivery charges logic
        // $delivey_charges = isset($data['tailor']->delivey_charges)? $request->delivey_charges : 0;
        $delivey_charges = 0;
        $estimated_day = 5;
        $data['products'] = [$products]; // 
        $data['deliver_by'] = $this->formatDate($estimated_day); 
        $data['gender'] = $measurement['gender'];
        $data['price']['product'] =$products->commission_price*$total_material_required;
        $data['price']['stiching_cost'] = $stiching_cost * $product_qty;
        $data['price']['discount'] = $discount;
        $data['price']['delivey_charges'] = $delivey_charges;
        $data['price']['total'] = $data['price']['product'] + $data['price']['stiching_cost'] - $data['price']['discount'] +  $data['price']['delivey_charges'];
        $request->session()->put('order_data', $data);
        return view('layouts.order_summary', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function make_payment(Request $request)
    {

        $login_id=5;
        $customer = json_decode($request->session()->get('customer_details'), True);
        $order_data = $request->session()->get('order_data');
        //$measurement = json_decode($request->session()->get('measurement'), True);
        $testing=false;
        if(env('PAYMENT_ENV')==='testing')
        {
            $testing=true;
            $cient_id=env('PAYMENT_TEST_CLIENT_ID');
            $cient_secret=env('PAYMENT_TEST_CLIENT_SECRET');
        }else
        {
            $cient_id=env('PAYMENT_LIVE_CLIENT_ID');
            $cient_secret=env('PAYMENT_LIVE_CLIENT_SECRET');
        }
        $app_url=env('APP_URL');
        $order_data_insert=array('login_id'=>$login_id,'name'=>$customer['fullname'],'email'=>$customer['email'],'mobile'=>$customer['mobile'],'address'=>$customer['address'],'amount'=>$order_data['price']['total']);
        $order_id=DB::table('orders')->insertGetId($order_data_insert);
        try
        {
            $api = Instamojo\Instamojo::init("app",[
            "client_id" => $cient_id,
            "client_secret" => $cient_secret
            ],$testing);
            
             $response = $api->createPaymentRequest(array(
            "purpose" => "Purchase-".$order_id,
            "buyer_name"=>$customer['fullname'],
            "amount" =>$order_data['price']['total'],
            "email"=>$customer['email'],
            "phone"=>$customer['mobile'],
            "send_email" => false,
            "redirect_url" =>$app_url."payment_response"
            
            ));
            // "webhook"=>$app_url."payment_wehook"
        if($response && !empty($response['id']))
        {
        
            $order_details_data=array('order_id'=>$order_id,'measurement'=>$request->session()->get('measurement'));
            DB::table('order_details')->insert($order_details_data);
            $temp=array(
                'amount'=>$response['amount'],
                'payment_request_id'=>$response['id'],
                'login_id'=>$login_id,'payment_response'=>json_encode($response),
                'order_id'=>$order_id
            );
            $transaction_id=DB::table('payments')->insert($temp);
            header('Location: ' . $response['longurl']);
            exit();
        }
        }catch(EXCEPTION $e)
        {
            //echo $e->getMessage();
        }
    }
    function payment_response(Request $request)
    {
        $msg='Payment Failed';
        $update_data=array('payment_id'=>$request->payment_id,'transaction_status'=>$request->payment_status);
        $update_stats=DB::table('payments')->where('payment_request_id',$request->payment_request_id)->update($update_data);
        if(!empty($request->payment_status) && strtolower($request->payment_status)==='credit')
        {
           $msg='Payment Successfull';
        }
        echo $msg;
    }

    private function formatDate($interval, $format = '', $date = ''){
        $date = !empty($date) ? $date : date('Y-m-d');
        $format = !empty($format) ? $format : 'D M d'; //Thu Nov 24 
        $data['date'] = date('Y-m-d', strtotime($date. ' + '.$interval.' days'));
        $data['format'] = date( $format, strtotime($data['date']));
        return $data;
    }
    public function list(Request $request)
    {
       $q = $request->q;
            $order_data = DB::table('orders')
            ->select('*')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->orWhere('orders.name', 'LIKE', '%' . $q . '%')
            ->orWhere('orders.email', 'LIKE', '%' . $q . '%')
            ->orWhere('orders.mobile', 'LIKE', '%' . $q . '%')
            ->orWhere('orders.address', 'LIKE', '%' . $q . '%')
            ->orWhere('orders.amount', 'LIKE', '%' . $q . '%')
            ->orderBy('orders.id', 'DESC')
            ->paginate(10)->appends(['q' => $q]);
        return view('orders.index', array('orders' => $order_data));
    }
    public function paymentList(Request $request)
    {
       $q = $request->q;
            $order_data = DB::table('payments')
            ->select('*')
            ->orWhere('payment_id', 'LIKE', '%' . $q . '%')
            ->orWhere('transaction_status', 'LIKE', '%' . $q . '%')
            ->orWhere('order_id', 'LIKE', '%' . $q . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10)->appends(['q' => $q]);
        return view('orders.payment', array('payments' => $order_data));
    }
}
