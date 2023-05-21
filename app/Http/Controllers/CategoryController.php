<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\Product;
use App\Models\ProductColor;
// use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $limit;
    private $gender;
    private $order;
    private $master_categories;
    private $product_categories;
    private $product_colors;
    private $type;
    private $subtype;
    private $color;
    public function __construct()
    {
        $this->limit = 9;
        $this->order = 'asc';
        $this->master_categories = MasterCategory::all();
        $this->product_categories = ProductCategory::all();
        $this->product_colors = ProductColor::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $searchTerm = $request->title ? trim($request->title) : null;
        if($request->gender) {
            $request->session()->put('gender', $request->gender);
        }
        $this->order = $request->order ? trim($request->order) : $this->order;
        $this->limit = $request->limit ? trim($request->limit) : $this->limit;
        $products = Product::query();
        $this->type = $request->type ? trim($request->type) : null;
        $this->subtype = $request->subtype ? trim($request->subtype) : null;
        $this->color = $request->color ? trim($request->color) : null;
        if($searchTerm) {
            $products = Product::where('title', 'like', '%' . $searchTerm . '%');
        }
        $this->gender = session()->get('gender');
        if(!empty($this->gender)) {
            $gender = MasterCategory::where('slug', $this->gender)->first();
            if (!empty($gender)) {
                $products->where('cat_id', $gender->id);
            }
        }
        if (!empty($this->type)) {
            $type = ProductCategory::where('name', $this->type)->first();
            if (!empty($type)) {
                $products->where('type_id', $type->id);
            }
        }
        if (!empty($this->subtype)) {
            $subtype = ProductSubCategory::where('name', $this->subtype)->first();
            if (!empty($subtype)) {
                $products->where('subtype_id', $subtype->id);
            }
        }

        if (!empty($this->color)) {
            $color = ProductColor::where('name', $this->color)->distinct()->first();
            if (!empty($color)) {
                $products->where('color_id', $color->id);
            }
        }
        $products->orderBy('id', $this->order);
        $data['results'] = $products->paginate($this->limit);
        $data['categories'] = $this->product_categories;
        $data['master_categories'] = $this->master_categories;
        $data['colors'] = $this->product_colors;
        $data['order'] = $this->order;
        $data['limit'] = $this->limit;
        return view('category.index')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $material = Product::where('slug', $title)->first();
        if (empty($material)) {
            return redirect()->route('category.index');
        }
        $data['result'] = $material;
        $data['master_categories'] = $this->master_categories;
        $data['colors'] = $this->product_colors;
        return view('category.show', $data);
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

    private function get_categories_colors($id)
    {
        $data['categories'] = ProductCategory::join('products', 'product_categories.id', '=', 'products.type_id')
                                ->where(['action' => 'active', 'products.cat_id' => $id ])->get();
        $data['colors'] = ProductColor::join('products', 'product_colors.id', '=', 'products.color_id')
                        ->where('products.cat_id', $id)->get();
        $data['sub_categories'] = null;
        return $data;
    }
}
