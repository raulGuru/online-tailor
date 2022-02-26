@extends('layouts.master')

@section('content')

    <div class="container-fluid p-0">
       <h1 class="h3 mb-3">Add Product</h1>
       <div class="card p-3">
          <div class="row">
             <div class=" col-sm-6">
                <label>Product</label>
                <input type="text" class="form-control">
             </div>
             <div class=" col-sm-6">
                <label>Product Name</label>
                <input type="text" class="form-control">
             </div>
          </div>
       </div>
       <div class="card p-3">
          <div class="row">
             <div class=" col-sm-6">
                <label>Product Color</label>
                <input type="text" class="form-control">
             </div>
             <div class=" col-sm-6">
                <label>Product Type</label>
                <select class="form-control">
                   <option></option>
                </select>
             </div>
          </div>
       </div>
       <div class="card p-3">
          <div class="row">
             <div class=" col-sm-6">
                <label>Product Price</label>
                <input type="text" class="form-control">
             </div>
             <div class=" col-sm-6">
                <label>Product Size</label>
                <select class="form-control">
                   <option></option>
                </select>
             </div>
          </div>
       </div>
       <div class="card p-3">
          <div class="row">
             <div class=" col-sm-6">
                <label>Product thumbnail</label>
                <div class=" mt-2">
                   <input type="file">
                </div>
             </div>
             <div class=" col-sm-6">
                <label>Product Big Images</label>
                <div class=" mt-2">
                   <input type="file">
                </div>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-sm-12 text-end">
             <button class="btn btn-primary" type="button">Submit</button>
             <button class="btn btn-secondary">Cancel</button>
          </div>
       </div>
    </div>
 
@endsection