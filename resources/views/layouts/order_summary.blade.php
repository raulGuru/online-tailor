@extends('layouts.master2')
@section('content')
<div class="container mt-3">
    <div class="breadcrumb-menu mt-4 mb-4">
        <ul class="m-0 p-0 d-flex">
            <li>
                <a href="">Home</a>
            </li>
            <li>
                <a href="">{{ ucfirst($gender) }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Order Summary</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div id="accordion">
                <div class="card-acc">
                    <div class="card-header d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">
                        <span class="title font-weight-500">Product Details</span>
                        <span class="accicon"><i class="fa fa-angle-down rotate-icon"></i></span>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body product-summary-box">
                            <ul>
                                @foreach ($products as $product)
                                    <li class="mb-2 pb-2 bd-bottom d-flex justify-content-between">
                                        <div class="d-flex">
                                            <div class="Summary-img-box me-2">
                                                <img src="{{ asset('public/products/'.$product->images) }}" alt="">
                                            </div>
                                            <div>
                                                <h3>{{ucwords($product->title)}}</h3>
                                                <p class="mb-1">Delivery by Thu Nov 24 | Free₹40</p>
                                                <h6 class="text-brown f-20 font-weight-500 m-0"> ₹{{$product->price}}</h6>
                                            </div>
                                        </div>
                                        <a href="">
                                            <img src="{{ asset('public/assets/img/cancel.svg') }}" alt="">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-acc">
                    <div class="card-header d-flex justify-content-between" data-toggle="collapse" href="#collapseTwo">
                        <span class="title font-weight-500">Tailor Details</span>
                        <span class="accicon"><i class="fa fa-angle-down rotate-icon"></i></span>
                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <div class="tailor-details-box d-flex">
                                <div class="tailor-photo">
                                    <img src="{{ asset('public/tailors/'.$tailor->photos) }}" alt="">
                                </div>
                                <div class="w-75">
                                    <h4 class="mb-1">{{$tailor->name}}</h4>
                                    <p>{{$tailor->description}} </p>

                                    <h5 class="font-weight-500 mb-1">Expertise</h5>
                                    <p>{{$tailor->expertise}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card-acc mb-3">
                <div class="card-header">
                    <span class="title font-weight-500">Payment Details</span>
                </div>
                <div class="box-body">
                    <table class="table mb-0">
                        <tr>
                            <td>Price ({{count($products)}} items)</td>
                            <td class="text-end">₹{{$price['stiching_cost']}}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td class="text-end">- ₹{{$price['discount']}}</td>
                        </tr>
                        <tr>
                            <td>Delivery Charges</td>
                            <td class="text-end">{{($price['delivey_charges'] == 0)? 'FREE' : '₹'.$price['delivey_charges']}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-500">Total Amount</td>
                            <td class="text-end font-weight-500">₹{{$price['total']}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card-acc mb-3">
                <div class="card-header">
                    <span class="title font-weight-500">Card Details</span>
                </div>
                <div class="box-body p-2">
                    <img class="mt-3 mb-3" src="{{ asset('public/assets/img/multiple_cards-icon.svg')}}" alt="">
                   
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p class="mb-0 font-weight-500">NAME ON CARD </p>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p class="mb-0 font-weight-500">CARD NUMBER</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-0 font-weight-500">EXPIRATION DATE</p>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 font-weight-500">CV CODE</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button class="btn book-btn">
                                    Make payment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection