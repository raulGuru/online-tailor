<?php

namespace App\Http\Controllers;

use App\Models\MeasurmentShirt;
use Illuminate\Http\Request;

class MeasurmentController extends Controller
{
    public function __construct() {
        $this->gender = 'men';
        $this->product_id = 1;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->gender = !empty($request->gender) ? $request->gender : $this->gender;
        // $data['product_id'] = $request->product_id;
        $data['measurments'] = measurment_types($this->gender);
        return view('measurment.create', $data);
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

    public function get_fields(Request $request)
    {
        $type = $request->type;
        $data = get_measurment_form_fields($this->gender , $type);
        array_push($data , array('type' => 'hidden', 'name' => 'product_type_id', 'value' => $this->product_id));
        return response()->json(["code" => 200, "status" => "success", "message" => "fields found successfully!", "data" => $data], 200);
    }

    public function save_measurment(Request $request)
    {
        $form_data = $request->all();
        unset($form_data['_token']);
        $request->session()->push('measurment', json_encode($form_data));
        echo '<pre>'; print_r($form_data); exit();
    }
}
