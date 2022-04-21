<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\Product;
use App\Models\ProductColor;
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
    public function index(Request $request)
    {
        $q = $request->q;
        $products = Product::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('additional_details', 'LIKE', '%' . $q . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10)->appends(['search' => $q]);

        $products->appends(['search' => $q]);
        return view('product.index', array('products' => $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = MasterCategory::get();
        $data['colors'] = ProductColor::get();
        $data['types'] = ProductType::get();
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
            'slug' => 'required|unique:products|max:255',
            'sku' => 'max:100',
            'category' => 'required|max:255',
            'type' => 'required|max:255',
            'color' => 'required|max:255',
            'size' => 'required|numeric|min:1|max:100000',
            'price' => 'required|numeric|min:1|max:10000',
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
                $is_uploaded = Storage::putFileAs('public/products', $image, $thumbnail);
                if ($is_uploaded) {
                    array_push($images, $thumbnail);
                }
            }
        }

        $data = array(
            'creator' => Auth::id(),
            'title' => $request->title,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'cat_id' => $request->category,
            'type_id' => $request->type,
            'color_id' => $request->color,
            'size' => $request->size,
            'price' => $request->price,
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
        $data['product'] = Product::find($id);
        return view('product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = MasterCategory::get();
        $data['colors'] = ProductColor::get();
        $data['types'] = ProductType::get();
        $data['product'] = Product::find($id);
        if (empty($data['product'])) {
            return redirect()->route('product.create');
        }
        return view('product.edit', $data);
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
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'sku' => 'max:100',
            'category' => 'required|max:255',
            'type' => 'required|max:255',
            'color' => 'required|max:255',
            'size' => 'required|numeric|min:1|max:100000',
            'price' => 'required|numeric|min:1|max:10000',
            'product_details' => 'required',
            'additional_details' => 'required'
        ]);
        $thumbnail = '';
        if ((isset($request->thumbnail) && $request->thumbnail !== null)) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20480'
            ]);
            $file_name = time() . "_" . $request->thumbnail->getClientOriginalName();
            $thumbnail = str_replace(' ', '-', $file_name);
            $is_uploaded = Storage::putFileAs('public/products', $request->thumbnail, $thumbnail);
            if (!$is_uploaded) {
                return redirect()->route('product.create');
            }
        }
        $images = [];
        if (isset($request->images) && !empty($request->images)) {
            $this->validate($request, [
                'images' => 'required'
            ]);
            foreach ($request->images as $image) {
                $file_name = time() . "_" . $image->getClientOriginalName();
                $thumbnail = str_replace(' ', '-', $file_name);
                $is_uploaded = Storage::putFileAs('public/products', $image, $thumbnail);
                if ($is_uploaded) {
                    array_push($images, $thumbnail);
                }
            }
        }

        $product = Product::find($id);
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->sku = $request->sku;
        $product->cat_id = $request->category;
        $product->type_id = $request->type;
        $product->color_id = $request->color;
        $product->size = $request->size;
        $product->price = $request->price;
        if (!empty($thumbnail)) {
            $product->thumbnail = $thumbnail;
        }
        if (!empty($images)) {
            $product->images = json_encode($images, true);
        }
        $product->description = $request->product_details;
        $product->additional_details = $request->additional_details;
        $product->updated_at = Carbon::now();
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }

    public function remove_image(Request $request, $id)
    {
        if (empty($id)) {
            return response()->json(["code" => 201, 'status' => 'error', 'message' => 'Material id is missing'], 200);
        }
        $product = Product::find($id);

        if (empty($product)) {
            return response()->json(["code" => 201, 'status' => 'error', 'message' => 'Material not found'], 200);
        }

        $images = $product->images;

        if (empty($images)) {
            return response()->json(["code" => 201, 'status' => 'error', 'message' => 'Material image not found'], 200);
        }

        $json_decode = json_decode($images, true);
        
        if (empty($json_decode)) {
            return response()->json(["code" => 201, 'status' => 'error', 'message' => 'Material image not found due to technical error'], 200);
        }
        
        unset($json_decode[$request->image]);
        
        $product->images = json_encode($json_decode, true);
        $product->updated_at = Carbon::now();
        $update_status = $product->save();

        return response()->json(["code" => 200, "status" => "success", "message" => "Image removed successfully!", "data" => $update_status], 200);
    }
}
