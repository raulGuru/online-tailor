<?php

namespace App\Http\Controllers;
use App\Models\Tailor;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('measurment') && !$request->session()->has('customer_details')) {
            return redirect()->route('category.index');
        }
        $product_qty = 1;
        $discount = isset($request->discount)? $request->discount : 0;
        $measurment = json_decode($request->session()->get('measurment'), True);
        $customer = json_decode($request->session()->get('customer_details'), True);
        
        $products =  Product::find($measurment['product_type_id']);
        // Tailor details
        $data['tailor'] =  Tailor::where('id', $customer['tailor_id'])->first(); 
        $stiching_cost = DB::table('stitching_costs')->where([
            'tailor_id' => $customer['tailor_id'],
            'stitch_name' => $measurment['measurment_type']])->value('cost');
        
        // Need to update delivery charges logic
        // $delivey_charges = isset($data['tailor']->delivey_charges)? $request->delivey_charges : 0;
        $delivey_charges = 0;
        $estimated_day = 5;
        $data['products'] = [$products]; // 
        $data['deliver_by'] = $this->formatDate($estimated_day); 
        $data['gender'] = $measurment['gender'];
        $data['price']['stiching_cost'] = $stiching_cost * $product_qty;
        $data['price']['discount'] = $discount;
        $data['price']['delivey_charges'] = $delivey_charges;
        $data['price']['total'] = $data['price']['stiching_cost'] - $data['price']['discount'] +  $data['price']['delivey_charges'];
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

    private function formatDate($interval, $format = '', $date = ''){
        $date = !empty($date) ? $date : date('Y-m-d');
        $format = !empty($format) ? $format : 'D M d'; //Thu Nov 24 
        $data['date'] = date('Y-m-d', strtotime($date. ' + '.$interval.' days'));
        $data['format'] = date( $format, strtotime($data['date']));
        return $data;
    }
}
