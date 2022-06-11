<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function orders()
    {
        $data['user'] = User::find(Auth::id());
        return view('layouts.customer.order', $data);
    }

    public function address()
    {
        $data['user'] = User::find(Auth::id());
        return view('layouts.customer.address', $data);
    }
}
