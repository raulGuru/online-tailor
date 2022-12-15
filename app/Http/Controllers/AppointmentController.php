<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Tailor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('pincode')) {
            return redirect()->route('location.show', 'appointment');
        }
        $q = $request->session()->get('pincode');
        $tailors = Tailor::where('status', 'active')->whereBetween('pin_code', [$q - 5, $q + 5])->orderBy('created_at', 'DESC')->paginate(10);
        $data['tailors'] = $tailors;
        return view('layouts.appointment', $data);
    }

    public function get_appointment($id)
    {
        if (empty($id)) {
            return response()->json(['code' => 200, 'status' => 'success', 'result' => []]);
        }
        $appointments = Appointment::select('appointment_at')->where('tailor_id', $id)->get();
        return response()->json(['code' => 200, 'status' => 'success', 'result' => $appointments]);
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
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'address' => 'required',
            'appointment_at' => 'required',
            'tailor_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 202, 'status' => 'error', 'errors' => $validator->errors()->all()]);
        }
        $data = array(
            'tailor_id' => $request->tailor_id,
            'fullname' => $request->fullname,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'appointment_at' => Carbon::parse($request->appointment_at),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        Appointment::insert($data);
        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Your appointment has been booked. We will send you confirmation email shortly.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
