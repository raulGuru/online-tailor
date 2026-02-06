<?php

namespace App\Http\Controllers;

use App\Models\Stitching;
use App\Models\Tailor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TailorController extends Controller
{
    /**
     * @var string[] $services
     */

    private $services;

    /**
     * @var string[] $appointments
     */

    private $appointments;

    /**
     * @var string[] $image_extensions
     */

    private $working_hours;
    /**
     * @var string[] $image_extensions
     */

    private $image_extensions;
    private $stitchings;
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
        $this->services = ['new stitching', 'alteration', 'custom tailoring', 'other'];
        $this->appointments = week_days();
        $this->working_hours = working_hours();
        $this->image_extensions = ['apng', 'avif', 'gif', 'jpg', 'jpeg', 'jfif', 'pjpeg', 'pjp', 'png', 'svg', 'webp', 'tif', 'tiff', 'bmp'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Name, Shop Name, Location, Pin code, Mobile, Services
        $q = $request->q;
        $data = Tailor::orWhere('name', 'LIKE', '%' . $q . '%')
            ->orWhere('shop_name', 'LIKE', '%' . $q . '%')
            ->orWhere('location', 'LIKE', '%' . $q . '%')
            ->orWhere('pin_code', 'LIKE', '%' . $q . '%')
            ->orWhere('mobile', 'LIKE', '%' . $q . '%')
            ->orWhere('services', 'LIKE', '%' . $q . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10)->appends(['q' => $q]);
        return view('tailors.index', array('tailors' => $data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['services'] = $this->services;
        $data['appointments'] = $this->appointments;
        $data['working_hours'] = $this->working_hours;
        $data['stitchings'] = Stitching::all();
        return view('tailors.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Create a tailor profile and associated dependent records.
     *
     * Side effects:
     * - writes tailor, store_timings, and stitching_costs rows
     * - uploads tailor photos to storage/app/public/tailors
     * - creates/links a vendor user account when email does not already exist
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'shop_name' => 'required|max:255',
            'location' => 'required|max:255',
            'pin_code' => 'required|regex:/\b\d{6}\b/',
            'email' => 'required|unique:tailors|max:255',
            'mobile' => 'required|digits:10',
            'commission' => 'required|numeric|min:1|max:100',
            // 'visit_charges' => 'required|numeric',
            'address' => 'required|max:255',
            'services' => 'required|min:1',
            'appointments' => 'required|min:1',
            'stitchings' => 'required|min:1',
            'status' => 'required'
        ]);
        $files = [];
        if ($request->hasfile('photos')) {
            $images = $request->file('photos');
            foreach ($images as $image) {
                // Getting image extension
                $extension = $image->getClientOriginalExtension();
                $check = in_array($extension, $this->image_extensions);
                // Checking the image extension
                if (!$check) {
                    return redirect()->back()->with('error', 'Images must be ' . implode(', ', $this->image_extensions) . '!');
                }
                $file_name = $image->getClientOriginalName();
                $new_filename = str_replace(' ', '-', $file_name);
                Storage::putFileAs('public/tailors', $image, $new_filename);
                array_push($files, $new_filename);
            }
        }
        $data = array(
            'creator' => Auth::id(),
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'location' => $request->location,
            'pin_code' => $request->pin_code,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'commission' => $request->commission,
            'visit_charges' => 0,//$request->visit_charges,
            'address' => $request->address,
            'services' => json_encode($request->services, true),
            'appointments' => json_encode($request->appointments, true),
            'expertise' => $request->expertise,
            'description' => $request->description,
            'status' => $request->status,
            'photos' => json_encode($files, true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );
        $inserted_id = Tailor::insertGetId($data);
        if($inserted_id) {
            $store_timings = array(
                'tailor_id' => (int) $inserted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            $temp = array();
            if(!empty($request->appointments)) {
                foreach($request->appointments as $key => $appointment) {
                    $timings[$appointment . '_opens'] = $request[$appointment . '_opens'];
                    $timings[$appointment . '_closes'] = $request[$appointment . '_closes'];
                    $temp = array_merge($store_timings, $timings);
                }
                DB::table('store_timings')->insert($temp);

            }
            $stitchings = array();
            if(!empty($request->stitchings)) {
                foreach($request->stitchings as $key => $cost) {
                    if($cost !== null) {
                        $stitchings[] = array(
                            'tailor_id' => $inserted_id,
                            'stitch_name' => $key,
                            'cost' => $cost,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        );
                    }
                }
                DB::table('stitching_costs')->insert($stitchings);
            }
        }

        $data = array(
            'creator' => Auth::id(),
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'location' => $request->location,
            'pin_code' => $request->pin_code,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'commission' => $request->commission,
            'visit_charges' => 0,//$request->visit_charges,
            'address' => $request->address,
            'services' => json_encode($request->services, true),
            'appointments' => json_encode($request->appointments, true),
            'expertise' => $request->expertise,
            'description' => $request->description,
            'status' => $request->status,
            'photos' => json_encode($files, true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        $user = User::where('email', $request->email)->first();
        if(empty($user)) {
            $users = array(
                'creator' => Auth::id(),
                'email' => $request->email,
                'password' => Hash::make('abc@123'),
                'gender' => 'male',
                'phone' => $request->mobile,
                'pin_code' => $request->pin_code,
                'status' => 'active',
                'role' => 'vendor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            $users = User::create($users);
            $tailor = Tailor::find($inserted_id);
            $tailor->user_id = $users->id;
            $tailor->save();
        }
        return redirect()->route('tailors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tailor  $Tailor
     * @return \Illuminate\Http\Response
     */
    public function show(Tailor $Tailor)
    {
        $data['tailor'] = $Tailor;
        $data['appointments'] = $this->appointments;
        $data['store_timings'] = (array) DB::table('store_timings')->where('tailor_id', $Tailor->id)->get()->first();
        $data['stitching_costs'] = DB::table('stitching_costs')->where('tailor_id', $Tailor->id)->get();
        return view('tailors.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tailor  $Tailor
     * @return \Illuminate\Http\Response
     */
    public function edit(Tailor $Tailor)
    {
        $data['tailor'] = $Tailor;
        $data['services'] = $this->services;
        $data['appointments'] = $this->appointments;
        $data['working_hours'] = $this->working_hours;
        $stitches = Stitching::all();
        $selected_costs = DB::table('stitching_costs')->where('tailor_id', $Tailor->id)->get();
        $hold_array = array();
        if($selected_costs->count() > 0) {
            foreach($selected_costs as $stitch) {
                array_push($hold_array, $stitch);
            }
        }
        if($stitches->count() > 0) {
            foreach($stitches as $key => $selected_cost) {
                $index = array_search($selected_cost->slug_name, array_column($hold_array, 'stitch_name'));
                if(is_int($index)) {
                    $stitches[$key]->cost = $hold_array[$index]->cost;
                }
            }
        }
        $data['stitchings'] = $stitches;
        $data['store_timings'] = (array) DB::table('store_timings')->where('tailor_id', $Tailor->id)->get()->first();
        $costs = DB::table('stitching_costs')->where('tailor_id', $Tailor->id)->get();
        $data['stitching_costs'] = array();
        if(!empty($costs)) {
            foreach($costs as $cost) {
                $data['stitching_costs'] += [$cost->stitch_name => $cost->cost];
            }
        }
        return view('tailors.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tailor  $Tailor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tailor $Tailor)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'shop_name' => 'required|max:255',
            'location' => 'required|max:255',
            'pin_code' => 'required|regex:/\b\d{6}\b/',
            'email' => 'required|max:255',
            'mobile' => 'required|digits:10',
            'commission' => 'required|numeric|min:1|max:100',
            // 'visit_charges' => 'required|numeric',
            'address' => 'required|max:255',
            'services' => 'required|min:1',
            'appointments' => 'required|min:1',
            'status' => 'required'
        ]);
        $files = [];
        if ($request->hasfile('photos')) {
            $images = $request->file('photos');
            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $check = in_array($extension, $this->image_extensions);
                if (!$check) {
                    return redirect()->back()->with('error', 'Images must be ' . implode(', ', $this->image_extensions) . '!');
                }
                $file_name = $image->getClientOriginalName();
                $new_filename = str_replace(' ', '-', $file_name);
                Storage::putFileAs('public/tailors', $image, $new_filename);
                array_push($files, $new_filename);
            }
        }
        // Update privious email into users table
        $previous_tailor_email = $Tailor->email;
        $user = User::where('email', $previous_tailor_email)->first();
        if(empty($user)) {
            $users = array(
                array(
                    'creator' => Auth::id(),
                    'email' => $request->email,
                    'password' => Hash::make('abc@123'),
                    'gender' => 'male',
                    'phone' => $request->mobile,
                    'pin_code' => $request->pin_code,
                    'status' => 'active',
                    'role' => 'vendor',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            );
            User::insert($users);
        } else {
            $user->email = $request->email;
            $user->phone = $request->mobile;
            $user->pin_code = $request->pin_code;
            $user->save();
        }
        // Update tailors
        $tailor = $Tailor;
        $tailor->name = $request->name;
        $tailor->email = $request->email;
        $tailor->shop_name = $request->shop_name;
        $tailor->location = $request->location;
        $tailor->pin_code = $request->pin_code;
        $tailor->mobile = $request->mobile;
        $tailor->phone = $request->phone;
        $tailor->commission = $request->commission;
        $tailor->visit_charges = 0;//$request->visit_charges;
        $tailor->address = $request->address;
        $tailor->services = json_encode($request->services, true);
        $tailor->appointments = json_encode($request->appointments, true);
        $tailor->expertise = $request->expertise;
        $tailor->description = $request->description;
        $tailor->status = $request->status;
        if(!empty($files)) {
            $tailor->photos = json_encode($files, true);
        }
        $tailor->updated_at = Carbon::now();
        $tailor->save();

        $store_timings = array(
            'updated_at' => Carbon::now()
        );
        $temp = array();
        if(!empty($request->appointments)) {
            foreach($request->appointments as $key => $appointment) {
                $timings[$appointment . '_opens'] = $request[$appointment . '_opens'];
                $timings[$appointment . '_closes'] = $request[$appointment . '_closes'];
                $temp = array_merge($store_timings, $timings);
            }
            DB::table('store_timings')->where('tailor_id', $Tailor->id)->update($temp);
        }
        $stitchings = array();
        if(!empty($request->stitchings)) {
            foreach($request->stitchings as $key => $cost) {
                if($cost !== null) {
                    $stitchings[] = array(
                        'tailor_id' => $Tailor->id,
                        'stitch_name' => $key,
                        'cost' => $cost,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    );
                }
            }
        }
        if(!empty($stitchings)) {
            foreach($stitchings as $stitching) {
                $exists = DB::table('stitching_costs')->where(array('tailor_id' => $stitching['tailor_id'], 'stitch_name' => $stitching['stitch_name']))->count();
                if(empty($exists)) {
                    DB::table('stitching_costs')->insert($stitching);
                } else {
                    $update_data = array('cost' => $stitching['cost'], 'updated_at' => Carbon::now());
                    DB::table('stitching_costs')->where(array('tailor_id' => $Tailor->id, 'stitch_name' => $stitching['stitch_name']))->update($update_data);
                }
            }
        }

        return redirect()->route('tailors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tailor  $Tailor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tailor $Tailor)
    {
        $Tailor->delete();
        return redirect()->route('tailors.index');
    }
}
