<?php

namespace App\Http\Controllers;

use App\Mail\CustomerSignupMailNotify;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerSignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $redirectTo = null;
        if ($request->has('redirectTo')) {
            $redirectTo = $request->input('redirectTo');
         }
        $data = array('redirectTo' => $redirectTo);
        return view('layouts.customer.signup', $data);
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
        $this->validate($request, [
            'email' => 'required|email:rfc,dns|unique:users|max:255',
            'password_confirmation' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits:10',
            'pin_code' => 'required|regex:/\b\d{6}\b/'
        ]);

        $data = array(
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'pin_code' => $request->pin_code,
            'role' => 'customer'
        );
        User::create($data);
        $email_data['name'] = explode('@', $request->email)[0];
        $email_body_content = array(
            "subject" => "Welcome to bookmytailor",
            "body" => $email_data
        );
        try {
            Mail::to($request->email)->send(new CustomerSignupMailNotify($email_body_content));
        } catch (Exception $e) {}
        if($request->redirectTo) {
            return redirect($request->redirectTo);
        }
        return redirect()->route('login.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }
}
