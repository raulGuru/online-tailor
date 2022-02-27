<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductSleeve;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        $data['products'] = Product::get();
        dd($data);
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = ProductCategory::get();
        $data['colors'] = ProductColor::get();
        $data['sizes'] = ProductSize::get();
        $data['types'] = ProductType::get();
        $data['sleeves'] = ProductSleeve::get();
        return view('product.create', $data);
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
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'sku' => 'max:100',
            'category' => 'required|max:255',
            'type' => 'required|max:255',
            'color' => 'required|max:255',
            'size' => 'required|max:255',
            'sleeve' => 'required|max:255',
            'price' => 'required|max:255',
            'discount' => 'max:50',
            'coupon' => 'max:100',
            'thumbnail' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20480', // file max size 20MB
            'images' => 'required', // file max size 20MB
            'product_details' => 'required',
            'additional_details' => 'required'
        ]);
        $thumbnail = '';
        if ((isset($request->thumbnail) && $request->thumbnail !== null)) {
            $file_name = $request->thumbnail->getClientOriginalName();
            $thumbnail = str_replace(' ', '-', $file_name);
            $is_uploaded = Storage::putFileAs('public/products', $request->thumbnail, $thumbnail);
            if (!$is_uploaded) {
                return redirect()->route('product.create');
            }
        }
        $images = [];
        if (isset($request->images) && !empty($request->images)) {
            foreach ($request->images as $image) {
                $file_name = $image->getClientOriginalName();
                $thumbnail = str_replace(' ', '-', $file_name);
                $is_uploaded = Storage::putFileAs('public/products', $request->thumbnail, $thumbnail);
                if ($is_uploaded) {
                    array_push($images, $thumbnail);
                }
            }
        }

        $data = array(
            'creator' => Auth::id(),
            'cat_id' => $request->category,
            'color_id' => $request->color,
            'size_id' => $request->size,
            'type_id' => $request->type,
            'sleeve_id' => $request->sleeve,
            'title' => $request->title,
            'sku' => $request->sku,
            'slug' => $request->slug,
            'price' => $request->price,
            'discount' => $request->discount,
            'coupon' => $request->coupon,
            'thumbnail' => $thumbnail,
            'images' => json_encode($images, true),
            'description' => $request->product_details,
            'additional_details' => $request->additional_details,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        Product::insert($data);
        return redirect()->route('product.index');
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
}
