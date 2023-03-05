<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $roles;
    public function __construct()
    {
        $this->roles = get_roles();
        $this->middleware(['auth', 'role']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $users = User::latest();
        if(Auth::user()->role === 'admin') {
            $users = $users->orWhere('email', 'LIKE', '%' . $q . '%')
            ->orWhere('phone', 'LIKE', '%' . $q . '%')
            ->paginate(10);
        } else {
            $users = $users->where('id', Auth::id())->paginate(10);
        }
        $users->appends(['search' => $q]);
        return view('user.index', array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('user.create', array('roles' => $this->roles));
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
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:255|confirmed',
            'password_confirmation' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits:10',
            'pin_code' => 'required|regex:/\b\d{6}\b/',
            'role' => 'required',
            'status' => 'required'
        ]);

        $data = array(
            'creator' => Auth::id(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone' => $request->phone,
            'pin_code' => $request->pin_code,
            'role' => $request->role,
            'status' => $request->status
        );
        
        User::create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = $this->roles;
        return view('user.edit', $data);
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
            'gender' => 'required',
            'phone' => 'required|digits:10',
            'pin_code' => 'required|regex:/\b\d{6}\b/',
            'role' => 'required',
            'status' => 'required'
        ]);
        $user = User::find($id);
        $user->creator = Auth::id();
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->pin_code = $request->pin_code;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->updated_at = Carbon::now();
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
