<?php

namespace App\Http\Controllers;

use App\Models\Stitching;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StitchingController extends Controller
{
    public function __construct()
    {
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
        $stitchings = Stitching::orWhere('stitch_name', 'LIKE', '%' . $q . '%')
            ->orWhere('cost', 'LIKE', '%' . $q . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10)->appends(['search' => $q]);
        $stitchings->appends(['search' => $q]);
        return view('stitching.index', array('stitchings' => $stitchings));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        return view('stitching.create', $data);
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
            'stitch_name' => 'required|unique:stitchings|max:255',
            'cost' => 'required|numeric|min:0|not_in:0'
        ]);

        $data = array(
            'creator' => Auth::id(),
            'stitch_name' => $request->stitch_name,
            'slug_name' => Str::slug($request->stitch_name, '_'),
            'cost' => $request->cost
        );
        Stitching::create($data);
        return redirect()->route('stitching.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stitching  $stitching
     * @return \Illuminate\Http\Response
     */
    public function show(Stitching $stitching)
    {
        $data['stitching'] = Stitching::find($stitching->id);
        return view('stitching.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stitching  $stitching
     * @return \Illuminate\Http\Response
     */
    public function edit(Stitching $stitching)
    {
        $data['stitching'] = Stitching::find($stitching->id);
        return view('stitching.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stitching  $stitching
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stitching $stitching)
    {
        $this->validate($request, [
            'stitch_name' => 'required',
            'cost' => 'required|numeric|min:0|not_in:0'
        ]);
        $stitching = Stitching::find($stitching->id);
        $stitching->cost = $request->cost;
        $stitching->updated_at = Carbon::now();
        $stitching->save();
        return redirect()->route('stitching.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stitching  $stitching
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stitching $stitching)
    {
        //
    }
}
