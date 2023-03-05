<?php

namespace App\Http\Controllers;

use App\Mail\CustomerMailNotify;
use App\Mail\CustomerMailNotifyReject;
use App\Models\Appointment;
use App\Models\Tailor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(empty($appointment)) {
            return redirect()->route('appointment.index');
        }
        $tailor = Tailor::find($appointment->tailor_id);
        $data['tailor'] = $tailor;
        $data['appointment'] = $appointment;
        return view('appointment.show', $data);
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
            'address' => $tailor->address,
            "subject" => "Bookymytailor -- Waiting",
        );
        $email_body_content = array(
            "subject" => "Bookymytailor -- Approved",
            "body" => $data
        );
        // return view('emails.customer-accept', array('data' => $email_body_content));
        // exit;
        try {
            Mail::to($appointment->email)->send(new CustomerMailNotify($email_body_content));
        } catch (Exception $e) {
            return response()->json(['code' => 202, 'status' => 'error', 'errors' => array('Sorry! Please try again latter ' . $e->getMessage())]);
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
        $tailor = Tailor::find($appointment->tailor_id);
        $data = array(
            'customer_name' => $appointment->fullname,
            'tailor_name' => $tailor->name,
            'shop_name' => $tailor->shop_name,
            'mobile' => $tailor->mobile,
            'location' => $tailor->location,
            'appointment_at' => Carbon::parse($appointment->appointment_at)->format('Y-m-d g:i A'),
            'address' => $tailor->address,
            "subject" => "Bookymytailor -- Waiting"
        );
        $email_body_content = array(
            "subject" => "Bookymytailor -- Waiting",
            "body" => $data
        );
        try {
            Mail::to($appointment->email)->send(new CustomerMailNotifyReject($email_body_content));
        } catch (Exception $e) {
            return response()->json(['code' => 202, 'status' => 'error', 'errors' => array('Sorry! Please try again latter ' . $e->getMessage())]);
        }
        return redirect()->route('appointment.list');
    }

    public function list()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $appointments = Appointment::latest();
        } else {
            $tailor = Tailor::where('email', $user->email)->first();
            if (!empty($tailor)) {
                $where = array('tailor_id' => $tailor->id);
                $appointments = Appointment::where($where)->latest();
            }
        }
        $appointments = $appointments->paginate($this->limit);
        return view('appointment.index')->with('appointments', $appointments);
    }
}
