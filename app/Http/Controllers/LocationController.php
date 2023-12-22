<?php

namespace App\Http\Controllers;

use App\Mail\TailorMailNotify;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\Tailor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    private $limit;
    public function __construct()
    {
        $this->limit = 10;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user() === null) {
            return response()->json(['code' => 404, 'status' => 'error', 'result' => false]);
        }
        if ($request->session()->has('pincode')) {
            return response()->json(['code' => 200, 'status' => 'success', 'result' => true]);
        }
        return response()->json(['code' => 200, 'status' => 'success', 'result' => false]);
    }

    public function list(Request $request)
    {
        if (!$request->session()->has('pincode')) {
            return redirect()->route('home.index');
        }
        $q = $request->session()->get('pincode');
        $query = Tailor::query();
        if($request->product_id) {
            $product = Product::find($request->product_id);
            if(!empty($product)) {
                $query->where('id', $product->tailor_id);
                $results = $query->where(array('status' => 'active', 'id' => $product->tailor_id))
                        ->whereBetween('pin_code', [$q - 5, $q + 5])
                        ->orderBy('created_at', 'DESC')
                        ->paginate($this->limit);
                if($results->count() > 0) {
                    $data['tailors'] = $results;
                } else {
                    $query2 = Tailor::query();
                    $result2 = $query2->where(array('status' => 'active', 'id' => $product->tailor_id))
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate($this->limit);
                    $data['related_tailors'] = $result2;
                }
                $data['product_id'] = $request->product_id;
            }
        } else {
            $data['tailors'] = $query->where('status', 'active')->whereBetween('pin_code', [$q - 5, $q + 5])->orderBy('created_at', 'DESC')->paginate($this->limit);
        }
        return view('layouts.appointment', $data);
    }

    public function get_appointment($id)
    {
        if (empty($id)) {
            return response()->json(['code' => 200, 'status' => 'success', 'result' => []]);
        }
        $appointments = Appointment::select('appointment_at')->where('tailor_id', $id)->get()->toArray();
        $tailor = Tailor::select('services')->find($id)->toArray();
        $services = json_decode($tailor['services'], true);
        $data['services'] = $services;
        if(Auth::id()) {
            $data['user'] = array(
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone
            );
        }
        $data['disabled_date'] = array_column($appointments, 'appointment_at');
        return response()->json(['code' => 200, 'status' => 'success', 'result' => $data]);
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
        $this->validate($request, ['pincode' => 'required|regex:/^(?:\d{6})$/i']);
        $request->session()->put('pincode', $request->pincode);
        return response()->json(['code' => 200, 'status' => 'success', 'result' => $request->session()->get('pincode')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(empty($id)) {
        //     return redirect()->route('appointment.index');
        // }
        // $data['redirect_uri'] = $id;
        // return view('layouts.location', $data);
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

    public function send_notification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'address' => 'required',
            'appointment_at' => 'required',
            'services' => 'required',
            'service_description' => 'required',
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
            'services' => json_encode($request->services),
            'service_description' => $request->service_description,
            'appointment_at' => Carbon::parse($request->appointment_at),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );
        $inserted_id = Appointment::insertGetId($data);
        $tailor = Tailor::find($request->tailor_id);
        unset($data['created_at'], $data['updated_at']);
        $data['subject'] = "Book Tailor Support";
        $data['appointment_at'] = Carbon::parse($request->appointment_at)->format('Y-m-d g:i A');
        $data['appointment_id'] = $inserted_id;
        $data['tailor_name'] = $tailor->name;
        $data['services'] = $request->services;
        $email_body_content = array(
            "subject" => "Book Tailor Support",
            "body" => $data
        );
        try {
            Mail::to($tailor->email)->send(new TailorMailNotify($email_body_content));
        } catch (Exception $e) {
            return response()->json(['code' => 202, 'status' => 'error', 'errors' => array('Sorry! Please try again latter'), 'log' => $e->getMessage()]);
        }
        return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Your appointment has been booked. We will send you confirmation email shortly.']);
    }
}
