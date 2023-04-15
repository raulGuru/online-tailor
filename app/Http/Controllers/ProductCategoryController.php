<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\ProductCategory;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
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
        $ProductCategory = ProductCategory::orWhere('name', 'LIKE', '%' . $q . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(10)->appends(['search' => $q]);
        $ProductCategory->appends(['search' => $q]);
        return view('product.category.index', array('categorys' => $ProductCategory));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = MasterCategory::all();
        return view('product.category.create', $data);
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
            'category' => 'required|max:255',
        ]);
        $sub_cat = ProductCategory::where(array('master_cat_id' => $request->category, 'name' => $request->name))->first();
        if(empty($sub_cat)) {
            $data = array(
                'creator' => Auth::id(),
                'name' => $request->name,
                'master_cat_id' => $request->category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            ProductCategory::insert($data);
        }
        return redirect()->route('product_category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $ProductCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $ProductCategory)
    {
        $data['category'] = ProductCategory::find($ProductCategory->id);
        return view('product.category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $ProductCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $ProductCategory)
    {
        $data['category'] = ProductCategory::find($ProductCategory->id);
        return view('product.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $ProductCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $ProductCategory)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $ProductCategory = ProductCategory::find($ProductCategory->id);
        $ProductCategory->name = $request->name;
        $ProductCategory->updated_at = Carbon::now();
        $ProductCategory->save();
        return redirect()->route('product_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $ProductCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductCategory::find($id);
        $product->delete();
        return redirect()->route('product_category.index');
    }


    public function update_status(Request $request)
    {
        $ProductCategory = ProductCategory::find($request->id);
        $ProductCategory->action = ($request->status === 'active') ? 'inactive' : 'active';
        $ProductCategory->updated_at = Carbon::now();
        $ProductCategory->save();
        return redirect()->route('product_category.index');
    }
}
