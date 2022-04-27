@extends('layouts.master2')
@section('content')
<section class="banner-section position-relative">
    <img src="{{ asset('public/assets/img/banner.jpg') }}" alt="Los Angeles" class="d-block" style="width:100%">
    <div class="banner-text">
       <h2>Welcome <br>
         To Customize Tailor
       </h2>
    </div>
 </section>
 <div class="container-fluid mt-5">
    <div class="text-line-img">
       <h2 class="mb-0 font-weight-600 f-20">SERVICES OFFERED</h2>
       <img src="{{ asset('public/assets/img/line.jpg') }}" alt="">
    </div>
    <div id="demo-offered" class="carousel slide demo-sider-one" data-bs-ride="carousel">
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="row">
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
             </div>
          </div>
          <div class="carousel-item ">
             <div class="row">
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/product-services-one.jpg') }}" alt="">
                   <div class="over-text">
                      RENTAL CLOTHES OFFRED
                   </div>
                </div>
             </div>
          </div>
       </div>
       <button class="carousel-control-prev" type="button" data-bs-target="#demo-offered" data-bs-slide="prev">
       <span class="carousel-control-prev-icon"></span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#demo-offered" data-bs-slide="next">
       <span class="carousel-control-next-icon"></span>
       </button>
    </div>
 </div>
 <div class="container-fluid mt-5">
    <div class="text-line-img">
       <h2 class="mb-0 font-weight-600 f-20">MEN CUSTOMIZED TAILOR</h2>
       <img src="{{ asset('public/assets/img/line.jpg') }}" alt="">
    </div>
    <div id="demo-customized" class="carousel slide demo-sider-one" data-bs-ride="carousel">
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="row">
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
             </div>
          </div>
          <div class="carousel-item ">
             <div class="row">
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/men-alteration-services.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
             </div>
          </div>
       </div>
       <button class="carousel-control-prev" type="button" data-bs-target="#demo-customized" data-bs-slide="prev">
       <span class="carousel-control-prev-icon"></span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#demo-customized" data-bs-slide="next">
       <span class="carousel-control-next-icon"></span>
       </button>
    </div>
 </div>
 <div class="container-fluid mt-5">
    <div class="text-line-img">
       <h2 class="mb-0 font-weight-600 f-20">WOMEN CUSTOMIZED TAILOR</h2>
       <img src="{{ asset('public/assets/img/line.jpg') }}" alt="">
    </div>
    <div id="demo-women" class="carousel slide demo-sider-one" data-bs-ride="carousel">
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="row">
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
             </div>
          </div>
          <div class="carousel-item ">
             <div class="row">
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/women.jpg') }}" alt="">
                   <div class="over-text">
                      BLZER AND JACKET TAILOR
                   </div>
                </div>
             </div>
          </div>
       </div>
       <button class="carousel-control-prev" type="button" data-bs-target="#demo-women" data-bs-slide="prev">
       <span class="carousel-control-prev-icon"></span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#demo-women" data-bs-slide="next">
       <span class="carousel-control-next-icon"></span>
       </button>
    </div>
 </div>
@endsection