<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Tailor;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductType;

class CustomerAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::find(Auth::id());
        return view('layouts.customer.profile', $data);
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
        dd($request->all());
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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'confirmed',
            'password_confirmation' => 'same:password',
            'gender' => 'required'
        ]);
        switch ($request->update_for) {
            case 'profile':
                $user = User::find($id);
                $user->creator = Auth::id();
                $user->email = $request->email;
                $user->gender = $request->gender;
                $user->updated_at = Carbon::now();
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                break;
            case 'order':
                # code...
                break;
            case 'address':
                # code...
                break;
            default:
                # code...
                break;
        }
        
        return redirect()->route('account.index');
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

    public function orders(Request $request)
    {
        $data['user'] = User::find(Auth::id());
        $q = $request->q;
                //DB::enableQueryLog();
            $order_data = DB::table('orders')
             //this wraps the whole statement in ()
             ->where(function($query) use ($q){
               
                 $query->where(function($query) use ($q){
                     $query->where('orders.login_id','=', auth()->user()->id);
                 });
                
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

        
        return view('layouts.customer.order', array('orders' => $order_data));
    }

    public function address()
    {
        $data['user'] = User::find(Auth::id());
        return view('layouts.customer.address', $data);
    }
}
