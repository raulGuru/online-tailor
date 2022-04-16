<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $limit;
    private $order;
    private $type;
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
        $data = $this->get_categories_colors();
        $searchTerm = $request->title ? trim($request->title) : '';
        $gender = $request->gender ? trim($request->gender) : '';
        $this->order = $request->order ? trim($request->order) : $this->order;
        $this->limit = $request->limit ? trim($request->limit) : $this->limit;
        $this->type = $request->type ? trim($request->type) : null;
        $this->color = $request->color ? trim($request->color) : null;
        $products = Product::where('title', 'like', '%' . $searchTerm . '%');
        if (!empty($this->type)) {
            $type = ProductType::where('name', $this->type)->first();
            if (!empty($type)) {
                $products->where('type_id', $type->id);
            }
        }
        if (!empty($this->color)) {
            $color = ProductColor::where('name', $this->color)->first();
            if (!empty($color)) {
                $products->where('color_id', $color->id);
            }
        }
        if (!empty($searchTerm)) {
            $products->orWhere('slug', 'like', '%' . $searchTerm . '%');
            $products->orWhere('description', 'like', '%' . $searchTerm . '%');
            $products->orWhere('additional_details', 'like', '%' . $searchTerm . '%');
        }
        $products->orderBy('id', $this->order);
        $results = $products->paginate($this->limit);
        $results->appends(['title' => $searchTerm, 'gender' => $gender, 'type' => $this->type, 'color' => $this->color, 'order' => $this->order]);
        return view('category.index', ['results' => $results, 'title' => $searchTerm, 'limit' => $this->limit, 'type' => $this->type, 'color' => $this->color, 'order' => $this->order, 'categories' => $data['categories'], 'colors' => $data['colors']]);
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
        $material = Product::where('title', $title)->first();
        if (empty($material)) {
            return redirect()->route('category.index');
        }
        $data = $this->get_categories_colors();
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

    private function get_categories_colors()
    {
        $data['categories'] = ProductType::get();
        $data['colors'] = ProductColor::get();
        return $data;
    }
}
