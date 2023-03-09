@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
    <div class="float-end">
        <a href="{{ route('product_subcategory.index') }}" class="btn btn-primary" role="button">
            Product Sub Category List
        </a>
     </div>
      <h5 class="card-title mb-0">Product Sub Category Details</h5>
   </div>
   <div class="card-body">
      @if(!empty($subcategory))
      <div class="row">
        <div class="col-md-12">
            <div class="card-body text-left">
               <div class="mb-2">Creator: <span class="text-muted">{{ $subcategory->user->email }}<span></div>
               <div class="mb-2">Name: <span class="text-muted">{{ $subcategory->name }}<span></div>
               <div class="mb-2">Category Name: <span class="text-muted">{{ $subcategory->category->name }}<span></div>
               <div class="mb-2">Status: <span class="text-muted">{{ $subcategory->action }}<span></div>
            </div>
        </div>
      </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('product_category.create') }}" class="btn btn-primary btn-lg">Add Product Category </a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection