@extends('layouts.master')
@section('content')
<div class="container-fluid p-0">
   <h1 class="h3 mb-3">Add Product</h1>
   <div class="card p-3">
      <div class="row">
         <div class=" col-sm-4">
            <label>Product title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter product title">
            @error('title')
               <span class="alert alert-danger alert-dismissible mt-1">
                     <div class="alert-message p-0">
                        {{ $message }}
                     </div>
               </span>
            @enderror
         </div>
         <div class=" col-sm-4">
            <label>Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Change slug">
            @error('slug')
               <span class="alert alert-danger alert-dismissible mt-1">
                     <div class="alert-message p-0">
                        {{ $message }}
                     </div>
               </span>
            @enderror
         </div>
         <div class=" col-sm-4">
            <label>SKU</label>
            <input type="text" name="sku" value="{{ old('sku') }}" class="form-control">
            @error('sku')
               <span class="alert alert-danger alert-dismissible mt-1">
                     <div class="alert-message p-0">
                        {{ $message }}
                     </div>
               </span>
            @enderror
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class=" col-sm-4">
            <label>Product Category</label>
            <select class="form-control" name="category">
               <option value="" selected disabled>Select category</option>
               @if($categories->count() > 0)
                  @foreach($categories as $category)
                     <option value="{{ $category->id }}">{{ $category->title }}</option>
                  @endforeach
               @endif
            </select>
         </div>
         <div class=" col-sm-4">
            <label>Product Type</label>
            <select class="form-control" name="type">
               <option value="" selected disabled>Select type</option>
               @if($categories->count() > 0)
                  @foreach($types as $type)
                     <option value="{{ $type->id }}">{{ ucfirst($type->name) }}</option>
                  @endforeach
               @endif
            </select>
         </div>
         <div class=" col-sm-4">
            <label>Product Color</label>
            <select class="form-control" name="color">
               <option value="" selected disabled>Select color</option>
               @if($colors->count() > 0)
                  @foreach($colors as $color)
                     <option value="{{ $color->id }}">{{ ucfirst($color->name) }}</option>
                  @endforeach
               @endif
            </select>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class=" col-sm-6">
            <label>Product Size</label>
            <select class="form-control" name="category">
               <option value="" selected disabled>Select size</option>
               @if($sizes->count() > 0)
                  @foreach($sizes as $size)
                     <option value="{{ $size->id }}">{{ $size->label }}</option>
                  @endforeach
               @endif
            </select>
         </div>
         <div class=" col-sm-6">
            <label>Product Sleeves</label>
            <select class="form-control" name="type">
               <option value="" selected disabled>Select sleeve</option>
               @if($sleeves->count() > 0)
                  @foreach($sleeves as $sleeve)
                     <option value="{{ $sleeve->id }}">{{ ucfirst($sleeve->name) }}</option>
                  @endforeach
               @endif
            </select>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class=" col-sm-4">
            <label>Product Price</label>
            <input type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="Enter price">
         </div>
         <div class=" col-sm-4">
            <label>Discount Code</label>
            <input type="text" name="discount" value="{{ old('discount') }}" class="form-control" placeholder="Enter discount">
         </div>
         <div class=" col-sm-4">
            <label>Coupon Code</label>
            <input type="text" name="coupon" value="{{ old('coupon') }}" class="form-control" placeholder="Enter coupon code">
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-sm-6">
             <label class="m-0">Product Thumbnail</label>
         </div>
         <div class="col-sm-6">
             <div class="mt-2">
                <input type="file">
            </div>
            <div class="thumbnail-img mt-2">
               <span>
                  <img width="50" height="50" src="./img/big-img.jpg" alt="">
               </span>
            </div>
         </div>
       </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-sm-6">
            <label>Product Images</label>
          </div>
         <div class="col-sm-6">
             <div class="mt-2">
                <input type="file">
            </div>
            <div class="thumbnail-img mt-2">
                <img width="50" height="50" src="./img/big-img.jpg" alt="">
             </div>
         </div>
       </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-sm-12">
            <div id="quill-editor"></div>
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