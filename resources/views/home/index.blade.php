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
       <h2 class="mb-0 font-weight-600 f-20">MEN CUSTOMIZED TAILOR</h2>
       <img src="{{ asset('public/assets/img/line.jpg') }}" alt="">
    </div>
    <div id="demo-men" class="carousel slide demo-sider-one" data-bs-ride="carousel">
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="row">               
                <div class="col-md-3 position-relative text-center">
                <!-- <a href="category?gender=men&type=brand"> -->
                <img src="{{ asset('public/assets/img/home/Blazer_1.jpeg') }}" alt="Blazer_1">
                   <div class="over-text">
                     BLAZER
                   </div>
                <!-- </a> -->                   
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/home/Jacket.jpeg') }}" alt="Jacket">
                   <div class="over-text">
                     JACKET
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/home/Kurta.jpeg') }}" alt="Kurta">
                   <div class="over-text">
                     KURTA
                   </div>
                </div>
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/home/Sherwani_2.jpeg') }}" alt="Sherwani_2">
                   <div class="over-text">
                     SHERWANI
                   </div>
                </div>
             </div>
          </div>
          <div class="carousel-item ">
             <div class="row">                
                <div class="col-md-3 position-relative text-center">
                   <img src="{{ asset('public/assets/img/home/Shirt.jpeg') }}" alt="Shirt">
                   <div class="over-text">
                     SHIRT
                   </div>
                </div>
             </div>
          </div>
       </div>
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
    </div>
 </div>
@endsection