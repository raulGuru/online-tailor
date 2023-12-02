@extends('layouts.master2')
@section('content')
<div class="container">
    <h1 class="text-center mt-2 fw-bold"><?php echo $data['msg']; ?></h1>
    <h4 class="mb-3 fw-normal">
        Your Order Id: <strong><?php echo $data['order_summary']->id; ?></strong> <?php echo ($data['order_summary']->status==='initiated')? 'Placed': $data['order_summary']->status; ?>, <br>
        Order Date: <strong><?php echo date('d M Y', strtotime($data['order_summary']->order_date)); ?></strong>
    </h4>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title align-self-center mb-0">Shipping Address</h5>
                                <div class="stat text-primary">
                                <i class="align-middle" data-feather="mail"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <?php echo $data['order_summary']->address; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title align-self-center mb-0">Billing Address</h5>
                                <div class="stat text-primary">
                                <i class="align-middle" data-feather="mail"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <?php echo $data['order_summary']->billing_address; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title align-self-center mb-0">Shipping Method</h5>
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="text-muted">Post</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title align-self-center mb-0">Payment Method</h5>
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="text-muted">Prepaid</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Summary</h5>
                </div>
                <div class="summary-table-container pt-0">
                    <table style="width:100%">
                        <tbody>
                            @foreach ($data['order_details'] as $details)
                                <tr>
                                    <td class="col-thumbnail">
                                        <div class="summary-img-box">
                                            @if(json_decode($details['product']->images, true))
                                                <img src="{{ asset('storage/app/public/products/'. json_decode($details['product']->images, true)[0]) }}" width="80" height="auto" class="rounded-square">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="col-details">
                                        <div>
                                            <h3><strong>{{ucwords($details['product']->title)}}</strong></h3>
                                            <p class="text-grey f-14 font-weight-500 m-0">Gender: {{ ucwords($details['additional_data']['gender']) }}</p>
                                            <p class="text-grey f-14 font-weight-500 m-0">Color: {{ ucfirst($details['product']->productColor->name) }}</p>
                                            <p class="text-grey f-14 font-weight-500 m-0">SKU: {{ $details['product']->sku }}</p>
                                            {{-- <p class="text-grey f-14 font-weight-500 m-0">Size: M</p> --}}
                                            <p class="text-grey f-14 font-weight-500 m-0">Qty: {{$details['additional_data']['total_material_required']}} Meters</p>

                                        </div>
                                    </td>
                                    <td style="text-align: right !important;">
                                        <h6 class="text-brown f-20 font-weight-500 m-0"> ₹{{$data['order_summary']->amount}}</h6>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="background-color: #D3D3D3;">
                            <tr>
                                <th colspan="2">Subtotal</th>
                                <th style="text-align: right !important;">₹{{$data['order_summary']->amount}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Shipping</th>
                                <th style="text-align: right !important;">{{$data['order_summary']->delivery_charge}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Discount</th>
                                <th style="text-align: right !important;">{{$data['order_summary']->discount}}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Tax</th>
                                <th style="text-align: right !important;">0</th>
                            </tr>
                            <tr>
                                <th colspan="2">Grand total</th>
                                <th style="text-align: right !important;">₹{{$data['order_summary']->amount}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="pt-2 text-end">
                        <a href="{{ route('home.index') }}" class="btn btn-primary" role="button">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection