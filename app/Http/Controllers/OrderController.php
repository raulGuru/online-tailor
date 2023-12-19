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
    public function __construct() 
    {
        date_default_timezone_set('Asia/Calcutta');
    }
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
        
        $total_material_required= round($total_measement * 0.01 );
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

        $login_id=auth()->user()->id;
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

        $order_data_insert=array('login_id'=>$login_id,'name'=>$customer['fullname'],'email'=>$customer['email'],'mobile'=>$customer['mobile'],'address'=>$customer['address'],'amount'=>$order_data['price']['total'],'tailor_id'=>$customer['tailor_id'],'billing_address'=>$customer['address'],'instamojo_order_id'=>'');
        $order_id=DB::table('orders')->insertGetId($order_data_insert);
        $generated_order_id=date("Ymdhi").$order_id;
        try
        {
            
            $api = Instamojo\Instamojo::init("app",[
            "client_id" => $cient_id,
            "client_secret" => $cient_secret
            ],$testing);
            
             $response = $api->createPaymentRequest(array(
            "purpose" => $generated_order_id,
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
            $update_order_data=array('instamojo_order_id'=>$generated_order_id);
            $update_order_stats=DB::table('orders')->where('id',$order_id)->update($update_order_data);
            $measurement_data = json_decode($request->session()->get('measurement'), True);

            //minus
            $products_row =  Product::find($measurement_data['product_type_id']);
            $update_order_size_data=array('size'=>$products_row->size-$order_data['total_material_required']);
            $update_order_stats=DB::table('products')->where('id',$measurement_data['product_type_id'])->update($update_order_size_data);

            $measurement_data['total_material_required']=$order_data['total_material_required'];
            $measurement_data['price']=$order_data['price']['product']+$order_data['price']['stiching_cost'];
            $order_details_data=array('order_id'=>$order_id,'measurement'=>json_encode($measurement_data));
            DB::table('order_details')->insert($order_details_data);
            $temp=array(
                'amount'=>$response['amount'],
                'payment_request_id'=>$response['id'],
                'login_id'=>$login_id,'payment_response'=>json_encode($response),
                'order_id'=>$order_id,
                "buyer_name"=>$customer['fullname'],
                "instamojo_order_id"=>$generated_order_id
            );
            $transaction_id=DB::table('payments')->insert($temp);
            header('Location: ' . $response['longurl']);
            exit();
        }
        }catch(EXCEPTION $e)
        {
            echo $e->getMessage();
        }
    }
    function payment_response(Request $request)
    {
        $user_id=auth()->user()->id;
        if(empty($request->payment_request_id))
        {
            echo 'Invalid request';exit(0);
        }
        $order_id = DB::table('payments')->where(['payment_request_id' =>$request->payment_request_id]
        )->value('order_id');
        if(empty($order_id))
        {
            echo 'Invalid request';exit(0);
        }
        $update_data=array('payment_id'=>$request->payment_id,'transaction_status'=>$request->payment_status);
         $update_stats=DB::table('payments')->where('payment_request_id',$request->payment_request_id)->update($update_data);

        if(!empty($request->payment_status) && strtolower($request->payment_status)!='credit')
        {

            $update_order_stats=DB::table('orders')->where(array('id'=>$order_id,'login_id'=>$user_id))->update(array('status'=>'failed'));
        }
        
        //return redirect()->route('order.order_view/'.$order_id);//todo
        //copy from here
        $data['order_summary'] = DB::table('orders')->where(array('id'=>$order_id,'login_id'=>$user_id))->first();
        if(empty($data['order_summary']))
        {
            echo 'Invalid request';exit(0);
        }
        $data['payment_details'] = DB::table('payments')->where('order_id', $order_id)->first();
        if(empty($data['order_summary']))
        {
            echo 'Invalid request';exit(0);
        }
        
        $msg='Order Failed';
        if(!empty($data['payment_details']) && strtolower( $data['payment_details']->transaction_status)==='credit')
        {
           $msg='Thank you for your Purchase';
        }
        
        $data['order_details'] =[];

        $order_details=DB::table('order_details')->where('order_id', $order_id)->get();
        $data['tailor'] =  Tailor::where('id', $data['order_summary']->tailor_id)->first();
        foreach ($order_details as $key => $value) 
        {
            $decoded_data=json_decode($value->measurement,true);
            $products =  Product::find($decoded_data['product_type_id']);
            $stitch_name='';
            if($decoded_data['type']==='top')
            {
                $stitch_name='normal-shirt';
            }
            if($decoded_data['type']==='bottom')
            {
               $stitch_name='normal-pant';
            }
            $stiching_cost = DB::table('stitching_costs')->where([
                'tailor_id' => $data['order_summary']->tailor_id,
                'stitch_name' => $stitch_name])->value('cost');
            $data['order_details'][]=array('product'=>$products,'stitch_cost'=>$stiching_cost,'additional_data'=>$decoded_data); 
        }
        $data['msg']=$msg;
        return view('layouts.order_success', array('data' => $data));
        
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
        $role=auth()->user()->role;
        $q = $request->q;
                //DB::enableQueryLog();
            $order_data = DB::table('orders')
             //this wraps the whole statement in ()
             ->where(function($query) use ($q,$role){
                if($role==='vendor')
                {
                 $query->where(function($query) use ($q){
                     $query->where('orders.tailor_id','=', auth()->user()->id);
                 });
                }
                 $query->where(function($query) use ($q){
                        
                        $query->orWhere('orders.name', 'LIKE', '%' . $q . '%');
                        $query->orWhere('orders.email', 'LIKE', '%' . $q . '%');
                        $query->orWhere('orders.mobile', 'LIKE', '%' . $q . '%');
                        $query->orWhere('orders.address', 'LIKE', '%' . $q . '%');
                        $query->orWhere('orders.amount', 'LIKE', '%' . $q . '%');
                        $query->orWhere('orders.instamojo_order_id', 'LIKE', '%' . $q . '%');
                 });
             })
             ->paginate(10)->appends(['q' => $q]);

            $data['order_details'] =[];
            $new_data=[];
            foreach ($order_data as $key => $summary)
            {
                $order_details_data=[];
                $order_details=DB::table('order_details')->where('order_id', $summary->id)->get();
                $tailor=  Tailor::where('id', $summary->tailor_id)->first();
                foreach ($order_details as $key => $value) 
                {
                    $decoded_data=json_decode($value->measurement,true);
                    $products =  Product::find($decoded_data['product_type_id']);
                    $stitch_name='';
                    if($decoded_data['type']==='top')
                    {
                        $stitch_name='normal-shirt';
                    }
                    if($decoded_data['type']==='bottom')
                    {
                       $stitch_name='normal-pant';
                    }
                    $stiching_cost = DB::table('stitching_costs')->where([
                        'tailor_id' => $summary->tailor_id,
                        'stitch_name' => $stitch_name])->value('cost');
                    $order_details_data[]=array('product'=>$products,'stitch_cost'=>$stiching_cost,'additional_data'=>$decoded_data); 
                }
                $order_data[$key]->order_details=$order_details_data;
            }

        return view('orders.index', array('orders' => $order_data,'role'=>$role));
    }
    public function paymentList(Request $request)
    {
        $q = $request->q;
        $start_date='';
        $end_date='';
        $appendto=['q' => $q];
        if(!empty($request->datepick))
        {
       //     var_dump($request->datepick);die;
            $search_date=$request->datepick;
            $expl_date=explode('to',$search_date);
            $start_date=date("Y-m-d",strtotime(trim($expl_date[0])));
            $end_date=date("Y-m-d",strtotime(trim($expl_date[1])));
            $appendto['datepick']=$request->datepick;
        }else
        {
            $start_date=date("Y-m-d",strtotime('-30 days'));
            $end_date=date("Y-m-d");
            $appendto['datepick']=date("d-M-Y",strtotime($start_date)).' to '.date("d-M-Y");
        }  
            $result = DB::table('payments')
            ->select('*')
            ->orWhere('payment_id', 'LIKE', '%' . $q . '%')
            ->orWhere('payment_request_id', 'LIKE', '%' . $q . '%')
            ->orWhere('transaction_status', 'LIKE', '%' . $q . '%')
            ->orWhere('instamojo_order_id', 'LIKE', '%' . $q . '%')
            ->orWhere('order_id', 'LIKE', '%' . $q . '%')
            //->whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('id', 'DESC')
            ->paginate(10)->appends($appendto);
        return view('orders.payment', array('payments' => $result));
    }
    public function order_view(Request $request)
    {
        $user_data=auth()->user();
        var_dump($user_data);die;
        //todo
        if(empty($request->id))
        {
            echo 'Invalid request';exit(0);
        }
       
        $data['order_summary'] = DB::table('orders')->where(array('id'=>$request->id,'login_id'=>5))->first();
        if(empty($data['order_summary']))
        {
            echo 'Invalid request';exit(0);
        }
        $data['payment_details'] = DB::table('payments')->where('order_id', $request->order_id)->first();
        if(empty($data['order_summary']))
        {
            echo 'Invalid request';exit(0);
        }
        
        $msg='Order Failed';
        if(!empty( $data['payment_details']) && strtolower( $data['payment_details']->transaction_status)==='credit')
        {
           $msg='Thank you for your Purchase';
        }
        
        $data['order_details'] =[];

        $order_details=DB::table('order_details')->where('order_id', $order_id)->get();
        $data['tailor'] =  Tailor::where('id', $data['order_summary']->tailor_id)->first();
        foreach ($order_details as $key => $value) 
        {
            $decoded_data=json_decode($value->measurement,true);
            $products =  Product::find($decoded_data['product_type_id']);
            $stitch_name='';
            if($decoded_data['type']==='top')
            {
                $stitch_name='normal-shirt';
            }
            if($decoded_data['type']==='bottom')
            {
               $stitch_name='normal-pant';
            }
            $stiching_cost = DB::table('stitching_costs')->where([
                'tailor_id' => $data['order_summary']->tailor_id,
                'stitch_name' => $stitch_name])->value('cost');
            $data['order_details'][]=array('product'=>$products,'stitch_cost'=>$stiching_cost); 
        }
        $data['msg']=$msg;

        return view('layouts.order_success', array('data' => $data));
    }

    public function update_status(Request $request)
    {
        
        $update_order_data=array('status'=>$request->update_stats);
        $update_order_stats=DB::table('orders')->where('id',$request->id)->update($update_order_data);
        if($update_order_stats)
        {
            $status=true;
        }
        else{
             $status=false;
        }
        echo json_encode(array('status'=>$status));
    }
}
