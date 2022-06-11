<?php

namespace App\Http\Controllers;

use App\Models\Tailor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    private $image_extensions;

    public function __construct()
    {
        $this->middleware(['auth', 'role']);
        $this->services = ['constructing', 'altering', 'repairing', 'custom tailoring'];
        $this->appointments = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $this->image_extensions = ['apng', 'avif', 'gif', 'jpg', 'jpeg', 'jfif', 'pjpeg', 'pjp', 'png', 'svg', 'webp', 'tif', 'tiff', 'bmp'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $q = $request->q;
        $data = Tailor::orWhere('email', 'LIKE', '%' . $q . '%')
            ->orWhere('phone', 'LIKE', '%' . $q . '%')
            ->orWhere('name', 'LIKE', '%' . $q . '%')
            ->orWhere('shop_name', 'LIKE', '%' . $q . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10)->appends(['search' => $q]);
        $data->appends(['search' => $q]);
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
        return view('tailors.create', $data);
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
            'name' => 'required|max:255',
            'shop_name' => 'required|max:255',
            'location' => 'required|max:255',
            'pin_code' => 'required|max:255',
            'email' => 'required|unique:tailors|max:255',
            'mobile' => 'required|max:255',
            'commission' => 'required|numeric|min:1|max:100',
            'address' => 'required|max:255',
            'services' => 'required|min:1',
            'appointments' => 'required|min:1',
            'status' => 'required',
            'photos.*' => 'max:20000'
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

        Tailor::insert($data);
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
        // echo "<pre>";
        // print_r($data);
        // exit;
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
            'pin_code' => 'required|max:255',
            'email' => 'required|max:255',
            'mobile' => 'required|max:255',
            'commission' => 'required|numeric|min:1|max:100',
            'address' => 'required|max:255',
            'services' => 'required|min:1',
            'appointments' => 'required|min:1',
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
        $tailor = $Tailor;
        $tailor->name = $request->name;
        $tailor->shop_name = $request->shop_name;
        $tailor->location = $request->location;
        $tailor->pin_code = $request->pin_code;
        $tailor->mobile = $request->mobile;
        $tailor->phone = $request->phone;
        $tailor->commission = $request->commission;
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
