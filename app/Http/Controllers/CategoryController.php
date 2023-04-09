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
    private $type;
    private $subtype;
    private $color;
    public function __construct()
    {
        $this->limit = 9;
        $this->order = 'asc';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
     
        $searchTerm = $request->title ? trim($request->title) : '';
        $this->gender = $request->gender ? trim($request->gender) : '';
        $this->order = $request->order ? trim($request->order) : $this->order;
        $this->limit = $request->limit ? trim($request->limit) : $this->limit;
        $this->type = $request->type ? trim($request->type) : null;
        $this->subtype = $request->subtype ? trim($request->subtype) : null;
        $this->color = $request->color ? trim($request->color) : null;
        $products = Product::where('title', 'like', '%' . $searchTerm . '%');
        if (!empty($this->type)) {
            // $type = ProductType::where('name', $this->type)->first();
            $type = ProductCategory::where('name', $this->type)->first();
            if (!empty($type)) {
                $data['sub_categories'] = ProductSubCategory::where('product_category_id', $type->id)->get();
                $products->where('type_id', $type->id);
            }
        }

        if (!empty($this->subtype)) {
            $subtype = ProductSubCategory::where('name', $this->subtype)->first();
            if (!empty($subtype)) {
                $data['sub_categories'] = ProductSubCategory::where('product_category_id', $subtype->product_category_id)->get();
                $products->where('subtype_id', $subtype->id);
            }
        }

        if (!empty($this->color)) {
            $color = ProductColor::where('name', $this->color)->first();
            if (!empty($color)) {
                $products->where('color_id', $color->id);
            }
        }
        if(!empty($this->gender)) {
            $gender = MasterCategory::where('slug', $this->gender)->first();
            if (!empty($gender)) {
                $products->where('cat_id', $gender->id);
            }
        }
        if (!empty($searchTerm)) {
            // $products->orWhere('slug', 'like', '%' . $searchTerm . '%');
            // $products->orWhere('description', 'like', '%' . $searchTerm . '%');
            // $products->orWhere('additional_details', 'like', '%' . $searchTerm . '%');
            $products->orWhere('tags', 'LIKE', '%' . $searchTerm . '%');
        }
        $data = $this->get_categories_colors($gender->id);
        $products->orderBy('id', $this->order);
        $results = $products->paginate($this->limit);
        $results->appends(['title' => $searchTerm, 'gender' => $this->gender, 'type' => $this->type, 'color' => $this->color, 'order' => $this->order]);
        return view('category.index', ['results' => $results, 'title' => $searchTerm, 'limit' => $this->limit, 'type' => $this->type, 'color' => $this->color, 'order' => $this->order, 'categories' => $data['categories'], 'sub_categories' => $data['sub_categories'], 'colors' => $data['colors']]);
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
    public function show(Request $request, $title)
    {
        $material = Product::where('slug', $title)->first();
        if (empty($material)) {
            return redirect()->route('category.index');
        }
        $data = $this->get_categories_colors($material->cat_id);
        return view('category.show', ['result' => $material, 'categories' => $data['categories'], 'colors' => $data['colors']]);
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
