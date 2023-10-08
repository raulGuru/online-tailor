@extends('layouts.master2')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Order Summary</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item card-acc">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button title font-weight-500" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Product Details
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <ul>
                                @foreach ($products as $product)
                                <li class="mb-2 pb-2 bd-bottom d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="Summary-img-box me-2">
                                            @if(json_decode($product->images, true))
                                                <img src="{{ asset('storage/app/public/products/'. json_decode($product->images, true)[0]) }}" alt="">
                                            @endif
                                        </div>
                                        <div>
                                            <h3>{{ucwords($product->title)}}</h3>
                                            <h6 class="text-brown f-20 font-weight-500 m-0"> ₹{{$product->commission_price}}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-2 pb-2 bd-bottom d-flex justify-content-between">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tbody>
                                                @if($product->width)
                                                <tr>
                                                    <th scope="col">Dimensions</th>
                                                    <td>{{ $product->width }}</td>
                                                </tr>
                                            @endif
                                            @if($product->productCategory->name)
                                                <tr>
                                                    <th scope="col">Type</th>
                                                    <td>{{ ucfirst($product->productCategory->name) }}</td>
                                                </tr>
                                            @endif
                                            @if($product->productColor)
                                                <tr>
                                                    <th scope="col">Color</th>
                                                    <td>{{ $product->productColor->name }}</td>
                                                </tr>
                                            @endif
                                            @if($product->mfg_by)
                                                <tr>
                                                <th scope="col">Mfg by</th>
                                                <td>{{ $product->mfg_by }}</td>
                                                </tr>
                                            @endif
                                            @if($product->note)
                                                <tr>
                                                <th scope="col">Info</th>
                                                <td>{{ $product->note }}</td>
                                                </tr>
                                            @endif
                                            @if($product->disclaimer)
                                                <tr>
                                                <th scope="col">Disclaimer</th>
                                                <td>{{ $product->disclaimer }}</td>
                                                </tr>
                                            @endif
                                            @if($product->additional_details)
                                                <tr>
                                                <th scope="col">Additional details</th>
                                                <td>{!! $product->additional_details !!}</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>     
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed title font-weight-500" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Tailor Details
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            <div class="tailor-details-box d-flex">
                                <div class="tailor-photo">
                                    <img src="{{ asset('public/tailors/'.$tailor->photos) }}" alt="">
                                </div>
                                <div class="w-75">
									<div class="media-body pr-3">
										<h3 class="mt-0 mb-1">{{ $tailor->shop_name }}</h3>
										<h4 class="mt-0 mb-1 text-muted"><strong>Location: </strong><i class="fas fa-map-marker text-success"></i> {{ $tailor->location }} - {{ $tailor->pin_code }}</h4>
										<p class="m-0"><strong>Address: </strong>{{ $tailor->address }}</p>
										<p class="m-0"><strong>Phone: </strong>{{ $tailor->phone }}</p>
									</div>
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
                            <td class="text-end">₹{{$price['product']}}</td>
                        </tr>
                        <tr>
                            <td>Stitching Cost</td>
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
                <div class="box-body p-2">
                    <form action="process_payment" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn book-btn">
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