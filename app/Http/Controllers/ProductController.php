<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        $products = Product::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('additional_details', 'LIKE', '%' . $q . '%')
            ->orWhere('tags', 'LIKE', '%' . $q . '%')
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
        // $data['types'] = ProductType::get();
        $data['types'] = ProductCategory::where('action','active')->get();
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
            'subtype' => 'required|max:255',
            'color' => 'required|max:255',
            'size' => 'required|numeric|min:1|max:100000',
            'price' => 'required|numeric|min:1|max:10000',
            'commission_price' => 'required|numeric',
            'thumbnail' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:20480', // file max size 20MB
            'images' => 'required', // file max size 20MB
            'product_details' => 'required',
            'tags' => 'required'
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
                $thumbnail2 = str_replace(' ', '-', $file_name);
                $is_uploaded = Storage::putFileAs('public/products', $image, $thumbnail2);
                if ($is_uploaded) {
                    array_push($images, $thumbnail2);
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
            'subtype_id' => $request->subtype,
            'color_id' => $request->color,
            'size' => $request->size,
            'price' => $request->price,
            'commission_price' => $request->commission_price,
            'description' => $request->product_details,
            'width' => $request->width,
            'disclaimer' => $request->disclaimer,
            'quality' => $request->quality,
            'mfg_by' => $request->mfg_by,
            'note' => $request->note,
            'additional_details' => $request->additional_details,
            'tags' => $request->tags,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        if(!empty($thumbnail)) {
            $data['thumbnail'] = $thumbnail;
        }
        if(!empty($images)) {
            $data['images'] = json_encode($images, true);
        }
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
        // $data['types'] = ProductType::get();
        $data['types'] = ProductCategory::where('action','active')->get();
        $data['product'] = Product::find($id);
        if (empty($data['product'])) {
            return redirect()->route('product.create');
        }
        $data['subtypes'] = ProductSubCategory::where('product_category_id',$data['product']['type_id'])->get();
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
            'subtype' => 'required|max:255',
            'color' => 'required|max:255',
            'size' => 'required|numeric|min:1|max:100000',
            'price' => 'required|numeric|min:1|max:10000',
            'product_details' => 'required',
            'tags' => 'required'
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
                $thumbnail2 = str_replace(' ', '-', $file_name);
                $is_uploaded = Storage::putFileAs('public/products', $image, $thumbnail2);
                if ($is_uploaded) {
                    array_push($images, $thumbnail2);
                }
            }
        }

        $product = Product::find($id);
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->sku = $request->sku;
        $product->cat_id = $request->category;
        $product->type_id = $request->type;
        $product->subtype_id = $request->subtype;
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
        $product->width = $request->width;
        $product->disclaimer = $request->disclaimer;
        $product->quality = $request->quality;
        $product->mfg_by = $request->mfg_by;
        $product->note = $request->note;
        $product->additional_details = $request->additional_details;
        $product->tags = $request->tags;
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

    public function get_subcategory(Request $request)
    {
        $id = $request->id;
        if (empty($id)) {
            return response()->json(["code" => 201, 'status' => 'error', 'message' => 'Category id is missing'], 200);
        }
        $subCategory = ProductSubCategory::where('product_category_id',$id)->where('action','active')->pluck('name', 'id');
        return response()->json(["code" => 200, "status" => "success", "message" => "Image removed successfully!", "data" => $subCategory], 200);
    }
}
