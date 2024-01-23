<div class="container">
    <h1 class="text-center mt-2 fw-bold"><?php echo (!empty($summaryData['msg'])) ? $summaryData['msg'] : ''; ?></h1>
    <h4 class="mb-3 fw-normal">
        Your Order Id: <strong><?php echo $summaryData['order_summary']->instamojo_order_id; ?></strong> <?php echo ($summaryData['order_summary']->status === 'initiated') ? 'placed' : $summaryData['order_summary']->status; ?>, <br>
        Order Date: <strong><?php echo date('d M Y', strtotime($summaryData['order_summary']->order_date)); ?></strong>
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
                                <?php echo $summaryData['order_summary']->address; ?>
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
                                <?php echo $summaryData['order_summary']->billing_address; ?>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title align-self-center mb-0">Measurement</h5>
                            </div>
                            <div class="mt-3">
                                <?php
                                if (!empty($summaryData['order_details'][0]['additional_data'])) {
                                    $measurement = $summaryData['order_details'][0]['additional_data'];                                    
                                ?>
                                    <table class="table-striped table table-responsive">
                                        <tr>
                                            <td class="col-thumbnail">
                                                <p class="text-grey f-14 font-weight-500 m-0">Stitch Type</p>
                                            </td>
                                            <td class="col-details">
                                                <p class="text-grey f-14 font-weight-500 m-0">{{ $measurement['selStitchType'] }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-thumbnail">
                                                <p class="text-grey f-14 font-weight-500 m-0">Panna (in meters)</p>
                                            </td>
                                            <td class="col-details">
                                                <p class="text-grey f-14 font-weight-500 m-0">{{ $measurement['selPanna'] }} meters</p>
                                            </td>
                                        </tr>
                                        @foreach ($summaryData['order_details'][0]['additional_data'] as $key=>$val)
                                        <?php 
                                        $topItems = array('chest', 'length', 'shoulder', 'sleeve', 'waist', 'hip', 'neck');
                                        if(in_array($key, $topItems)){
                                        ?>    
                                            <tr>
                                                <td class="col-thumbnail">
                                                  <p class="text-grey f-14 font-weight-500 m-0">{{$key}}</p>
                                                </td>
                                                <td class="col-details">
                                                   <p class="text-grey f-14 font-weight-500 m-0">{{$val}} Inches</p>
                                                </td>
                                                
                                            </tr>
                                            <?php } ?>
                                        @endforeach
                                        <tr>
                                            <td class="col-thumbnail">
                                                <p class="text-grey f-14 font-weight-500 m-0">Notes</p>
                                            </td>
                                            <td class="col-details">
                                                <p class="text-grey f-14 font-weight-500 m-0">{{ $measurement['note'] }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
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
                    <table class="table-striped table table-responsive">
                        @foreach ($summaryData['order_details'] as $details)
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
                                    <p class="text-grey f-14 font-weight-500 m-0">Qty: {{$details['additional_data']['total_material_required']}} Meters</p>
                                    <p class="text-grey f-14 font-weight-500 m-0">Tailor name: {{ $summaryData['tailor']->name }}</p>
                                </div>
                            </td>
                            <td style="text-align: right !important;">
                                <h6 class="text-brown f-20 font-weight-500 m-0"> ₹{{$summaryData['order_summary']->amount}}</h6>
                            </td>
                        </tr>

                        @endforeach
                        <tr>
                            <th colspan="2">Subtotal</th>
                            <th style="text-align: right !important;">₹{{$summaryData['order_summary']->amount}}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Shipping</th>
                            <th style="text-align: right !important;">{{$summaryData['order_summary']->delivery_charge}}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Discount</th>
                            <th style="text-align: right !important;">{{$summaryData['order_summary']->discount}}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Grand total</th>
                            <th style="text-align: right !important;">₹{{$summaryData['order_summary']->amount}}</th>
                        </tr>
                    </table>


                    <?php if ($summaryData['continue_btn']) { ?>
                        <div class="pt-2 text-end">
                            <a href="{{ route('home.index') }}" class="btn btn-primary" role="button">Continue Shopping</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>