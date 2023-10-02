<?php

namespace App\Http\Controllers;

use App\Models\ProductSubCategory;
use App\Models\ProductCategory;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSubCategoryController extends Controller
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
        $productSubCategory = ProductSubCategory::query();
        $productSubCategory->select('product_categories.*', 'product_sub_categories.*');
        $productSubCategory->orWhere('product_sub_categories.name', 'LIKE', '%' . $q . '%');
        $productSubCategory->orWhere('product_categories.name', 'LIKE', '%' . $q . '%');
        $productSubCategory->join('product_categories', 'product_categories.id', '=', 'product_sub_categories.product_category_id');
        $productSubCategory = $productSubCategory->orderBy('product_sub_categories.id', 'DESC')->paginate(10)->appends(['search' => $q]);
        return view('product.subcategory.index', array('categorys' => $productSubCategory));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = ProductCategory::get();
        return view('product.subcategory.create', $data);
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
        $sub_cat = ProductSubCategory::where(array('product_category_id' => $request->category, 'name' => $request->name))->first();
        if(empty($sub_cat)) {
            $data = array(
                'creator' => Auth::id(),
                'name' => $request->name,
                'product_category_id' => $request->category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            ProductSubCategory::insert($data);
        }
        return redirect()->route('product_subcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['subcategory'] = ProductSubCategory::find($id);
        return view('product.subcategory.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = ProductCategory::get();
        $data['subcategory'] = ProductSubCategory::find($id);
        return view('product.subcategory.edit', $data);
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
            'name' => 'required|max:255',
            'category' => 'required|max:255',
        ]);
        $ProductSubCategory = ProductSubCategory::find($id);
        $ProductSubCategory->name = $request->name;
        $ProductSubCategory->product_category_id = $request->category;
        $ProductSubCategory->updated_at = Carbon::now();
        $ProductSubCategory->save();
        return redirect()->route('product_subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductSubCategory::find($id);
        $product->delete();
        return redirect()->route('product_subcategory.index');
    }


    public function update_status(Request $request)
    {
        $ProductCategory = ProductSubCategory::find($request->id);
        $ProductCategory->action = ($request->status === 'active') ? 'inactive' : 'active';
        $ProductCategory->updated_at = Carbon::now();
        $ProductCategory->save();
        return redirect()->route('product_subcategory.index');
    }
}
