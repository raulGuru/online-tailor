<?php

namespace App\Http\Controllers;

use App\Mail\CustomerMailNotify;
use App\Models\Appointment;
use App\Models\Tailor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $limit;
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->limit = 10;
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
        $appointment->status = 'accepted';
        $appointment->save();
        $tailor = Tailor::find($appointment->tailor_id);
        $data = array(
            'customer_name' => $appointment->fullname,
            'tailor_name' => $tailor->name,
            'shop_name' => $tailor->shop_name,
            'mobile' => $tailor->mobile,
            'location' => $tailor->location,
            'appointment_at' => Carbon::parse($appointment->appointment_at)->format('Y-m-d g:i A'),
            'address' => $tailor->address
        );
        $email_body_content = array(
            "subject" => "Book Tailor Support",
            "body" => $data
        );

        try {
            Mail::to($appointment->email)->send(new CustomerMailNotify($email_body_content));
        } catch (Exception $e) {
            return response()->json(['code' => 202, 'status' => 'error', 'errors' => array('Sorry! Please try again latter')]);
        }

        return redirect()->route('appointment.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->status = 'rejected';
        $appointment->save();
        return redirect()->route('appointment.list');
    }

    public function list() {
        $appointments = Appointment::latest();
        $appointments = $appointments->paginate($this->limit);
        return view('appointment.index')->with('appointments', $appointments);
    }
}
