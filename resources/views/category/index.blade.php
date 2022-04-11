@extends('layouts.master2')

@section('content')
<div class="container mt-7">
    <div class="breadcrumb-menu mt-4 mb-4">
       <ul class="m-0 p-0 d-flex">
          <li>
             <a href="">Home</a>
          </li>
          <li class="pl-1">
             <a href="">Men</a>
          </li>
       </ul>
    </div>
    <div class="row">
       <div class="col-md-3">
          <div class="categories-border mb-4">
             <h4 class="font-weight-600 m-0">CATEGORIES</h4>
             <img src="{{ asset('assets/img/small-line.svg') }}" alt="">
             @if($categories->count() > 0)
               <ul class="categories-listing mt-3 p-0">
                  @foreach($categories as $category)
                     <a href="#" class="text-decoration-none text-reset">
                        <li class="d-flex justify-content-between mt-3">
                           <span> {{ $category->title }} </span>
                           <span>(15)</span>
                        </li>
                     </a>
                  @endforeach
               </ul>
             @endif
          </div>
          <div class="categories-border">
             <h4 class="font-weight-600 m-0">COLOR</h4>
             <img src="{{ asset('assets/img/small-line.svg') }}" alt="">
             @if($colors->count() > 0)
               <ul class="categories-listing mt-3 p-0">
                  @foreach($colors as $color)
                     <a href="#" class="text-decoration-none text-reset">
                        <li class="d-flex justify-content-between mt-3">
                           <span> {{ $color->name }} </span>
                           <span class="circle-color" style="background: {{ $color->code }}"></span>
                        </li>
                     </a>
                  @endforeach
               </ul>
             @endif
          </div>
       </div>
       <div class="col-md-9">
          <div class="row mb-4">
             <div class="col-md-4">
               <div class="input-group mb-3">
                  <span class="input-group-text">Sort By:</span>
                  <select class="form-select" aria-label="Default select example">
                     <option value="Name (A - Z)">Name (A - Z)</option>
                     <option value="Default">Default</option>
                     <option value="Name (Z - A)">Name (Z - A)</option>
                     <option value="Price (Low &gt; High)">Price (Low &gt; High)</option>
                     <option value="Price (High &gt; Low)">Price (High &gt; Low)</option>
                     <option value="Rating (Highest)">Rating (Highest)</option>
                     <option value="Rating (Lowest)">Rating (Lowest)</option>
                     <option value="Model (A - Z)">Model (A - Z)</option>
                     <option value="Model (Z - A)">Model (Z - A)</option>
                  </select>
                </div>
             </div>
             <div class="col-md-4">
               <div class="input-group mb-3">
                  <span class="input-group-text">Show:</span>
                  <select class="form-select" aria-label="Default select example">
                     <option value="15">15</option>
                     <option value="25">25</option>
                     <option value="50">50</option>
                     <option value="75">75</option>
                     <option value="100">100</option>
                  </select>
                </div>
             </div>
             <div class="col-md-4 text-end">
                <p class="m-0"> Showing at 15 result </p>
             </div>
          </div>
          <div class="row">
             <div class="col-md-4 text-center mb-4">
                <div class="product-shrot-view">
                   <img src="{{ asset('assets/img/product.jpg') }}" alt="">
                   <h4 class="mt-3 font-weight-500">Slik Fabric</h4>
                   <h4 class="mt-2 font-weight-500">$ 300</h4>
                   <div class="start-icon">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="col-md-4 text-center mb-4">
                <div class="product-shrot-view">
                   <img src="{{ asset('assets/img/product.jpg') }}" alt="">
                   <h4 class="mt-3 font-weight-500">Slik Fabric</h4>
                   <h4 class="mt-2 font-weight-500">$ 300</h4>
                   <div class="start-icon">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="col-md-4 text-center mb-4">
                <div class="product-shrot-view">
                   <img src="{{ asset('assets/img/product.jpg') }}" alt="">
                   <h4 class="mt-3 font-weight-500">Slik Fabric</h4>
                   <h4 class="mt-2 font-weight-500">$ 300</h4>
                   <div class="start-icon">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="col-md-4 text-center mb-4">
                <div class="product-shrot-view">
                   <img src="{{ asset('assets/img/product.jpg') }}" alt="">
                   <h4 class="mt-3 font-weight-500">Slik Fabric</h4>
                   <h4 class="mt-2 font-weight-500">$ 300</h4>
                   <div class="start-icon">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="col-md-4 text-center mb-4">
                <div class="product-shrot-view">
                   <img src="{{ asset('assets/img/product.jpg') }}" alt="">
                   <h4 class="mt-3 font-weight-500">Slik Fabric</h4>
                   <h4 class="mt-2 font-weight-500">$ 300</h4>
                   <div class="start-icon">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
             <div class="col-md-4 text-center mb-4">
                <div class="product-shrot-view">
                   <img src="{{ asset('assets/img/product.jpg') }}" alt="">
                   <h4 class="mt-3 font-weight-500">Slik Fabric</h4>
                   <h4 class="mt-2 font-weight-500">$ 300</h4>
                   <div class="start-icon">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection