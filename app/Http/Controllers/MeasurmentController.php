<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\Tailor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MeasurmentController extends Controller
{
    public function __construct() {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('pincode')) {
            return redirect()->route('location.show', 'measurment');
        }
        $q = $request->session()->get('pincode');
        $tailors = Tailor::where('status', 'active')->whereBetween('pin_code', [$q - 5, $q + 5])->paginate(2);
        // Doubt 
        // Need to confirm which type of service while create new use  
        // Need to confirm pricing based on service type how to differentiate this stiching_cost
        // foreach ($tailors as $key => $value) {
        //     $value['stitching_costs'] = DB::table('stitching_costs')->where('tailor_id', $Tailor->id)->get();
        // } 
        $data['tailors'] = $tailors;
        $data['request_from'] = 'measurment';
        return view('layouts.appointment', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $cat_id = $request->cat_id;
        if(empty($cat_id)){
            return redirect()->route('category.index');
        }
        $gender = MasterCategory::where('id', $cat_id)->first()['slug'];
        $data['product_id'] = $request->product_id;
        $data['gender'] = $gender;
        $data['measurments'] = measurment_types($gender);
        return view('measurment.create', $data);
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

    public function get_fields(Request $request)
    {
        $type = $request->type;
        $gender = $request->gender;
        $data = get_measurment_form_fields($gender , $type);
        return response()->json(["code" => 200, "status" => "success", "message" => "fields found successfully!", "data" => $data], 200);
    }

    public function save_measurment(Request $request)
    {
        $form_data = $request->all();
        unset($form_data['_token']);
        // when there is multiple uncomment below method
        // $request->session()->push('measurment', json_encode($form_data));

        // Use For single element
        $request->session()->put('measurment', json_encode($form_data));
        return redirect()->route('measurment.index');
    }

    public function book_tailor(Request $request)
    {
        $form_data = $request->all();
        unset($form_data['_token']);
        $request->session()->put('customer_details', json_encode($form_data));
        return redirect()->route('order.index');
    }
    
}
