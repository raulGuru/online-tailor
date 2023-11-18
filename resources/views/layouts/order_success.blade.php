@extends('layouts.master2')
@section('content')
<div class="container-fluid p-0  mt-3">
    <div class="row">
        <div class="col-md-12 mb-3" style="text-align:center; ">
            <h3><?php echo $data['msg']; ?></h3>
        </div>
    </div>
    <h1 class="h3 mb-3"><strong>Your order Id is-<?php echo $data['order_summary']->id; ?>-
            <?php echo ($data['order_summary']->status==='initiated')?'Placed':$data['order_summary']->status; ?>
            <br/>
            Order Date-<?php echo date('d-M-y',strtotime($data['order_summary']->order_date));?>
    </strong></h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" style="min-height: 50%">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Shipping Address</h5>
                                    </div>
                                </div>
                                <div class="mb-0">
                                   <?php echo $data['order_summary']->address; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="min-height: 50%">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Billing Address</h5>
                                    </div>
                                </div>
                                <div class="mb-0">
                                   <?php echo $data['order_summary']->billing_address; ?>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-sm-6">
                        <div class="card" >
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Shipping Method</h5>
                                    </div>
                                </div>
                                <div class="mb-0">
                                  
                                    <span class="text-muted">Post</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Payment Method</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <span class="text-muted">Prepaid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Order Summary</h5>
                </div>
                <div >
                    <table style="width:100%">
                    @foreach ($data['order_details'] as $details)
                    <tr>
                        <td>
                            <div class="Summary-img-box me-2">
                                    @if(json_decode($details['product']->images, true))
                                        <img src="{{ asset('storage/app/public/products/'. json_decode($details['product']->images, true)[0]) }}" alt="">
                                    @endif
                            </div>
                        </td>
                        <td>
                            <div>
                                <h3>{{ucwords($details['product']->title)}}</h3>
                                    <h6 class="text-brown f-20 font-weight-500 m-0"> </h6>
                                    Qty:{{$details['additional_data']['total_material_required']}} Meter
                            </div>
                        </td>
                        <td style="text-align: right !important;">
                            <h6 class="text-brown f-20 font-weight-500 m-0"> ₹{{$details['additional_data']['price']}}</h6>
                        </td>
                    </tr>                
                    @endforeach
                        <tfoot style="background-color: #D3D3D3;padding:5px;" >
                            <tr>
                                <th  style="padding:2%;padding-bottom:0" colspan="2">Subtotal</th>
                                <th  style="padding:2%;padding-bottom:0;text-align: right !important;" class="footerpadding" >{{$data['order_summary']->amount}}</th>
                            </tr>
                            <tr>
                                <th style="padding:2%;padding-bottom:0" class="footerpadding" colspan="2">Shipping</th>
                                <th style="padding:2%;padding-bottom:0;text-align: right !important;" class="footerpadding" >{{$data['order_summary']->delivery_charge}}</th>
                            </tr>
                            <tr>
                                <th style="padding:2%;padding-bottom:0" class="footerpadding" colspan="2">Discount</th>
                                <th style="padding:2%;padding-bottom:0;text-align: right !important;" class="footerpadding" >{{$data['order_summary']->discount}}</th>
                            </tr>
                            <tr>
                                <th style="padding:2%;padding-bottom:0" class="footerpadding" colspan="2">Tax</th>
                                <th style="padding:2%;padding-bottom:0;text-align: right !important;" class="footerpadding" >0</th>
                            </tr>
                            <tr>
                                <th style="padding:2%;padding-bottom:0" class="footerpadding" colspan="2">Grand total</th>
                                <th style="padding:2%;padding-bottom:0;text-align: right !important;" class="footerpadding" >{{$data['order_summary']->amount}}</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection