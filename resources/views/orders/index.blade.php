@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="float-end">
         <form class="d-none d-sm-inline-block ">
            <div class="input-group input-group-navbar summary_view">
               <input type="text" class="form-control" name="q" value="{{ request()->q }}" title="Searchs" placeholder="Search" aria-label="Search">
               <button class="btn" type="submit">
               <i class="align-middle" data-feather="search"></i>
               </button>
            </div>
         </form>
         @if(request()->q)
            <a href="{{ route('order.list') }}" class="btn btn-secondary ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear search data">
               <i class="align-middle" data-feather="refresh-cw"></i>
            </a>
         @endif
      </div>
      <h5 class="card-title mb-0">Orders</h5>
   </div>
   <div class="card-body" >
      @if(isset($orders) && $orders->count() > 0)
         <table class="table table-striped summary_view" >
            <thead>
               <tr>
                  <th>#</th>
                  <th>Order Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($orders as $key => $order)
               <tr>
                  <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</td>
                  <td>{{ $order->instamojo_order_id }}</td>
                  <td>{{ $order->name }}</td>
                  <td>{{ $order->email }}</td>
                  <td>{{ $order->mobile }}</td>
                  <td>{{ $order->address }}</td>
                  <td>{{ $order->amount }}</td>
                  <td>{{ $order->status }}</td>
                  <td>{{ $order->order_date }}</td>
                  <td>
                        <div>
                           <a href="javascript:void(0);" onclick="view_details('<?php echo $order->id;?>',true);">
                              <i class="align-middle me-2" data-feather="eye"></i>
                           </a>
                        </div>
                     </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse summary_view" >
            <div class="p-0">{{ $orders->links() }}</div>
         </div>

         @foreach($orders as $key2 => $order_dets)
         
            <div class="card-body" style="display:none;" id="details_view<?php echo $order_dets->id;?>">
            <button class="btn btn-primary float-end" type="submit">Back
            </button>
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
                                      <?php echo $order_dets->address; ?>
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
                                      <?php echo $order_dets->billing_address; ?>
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
              <?php 

              /*
                  todo 
               ?>
              <div class="col-lg-6">
                  <!--<div class="card flex-fill w-100">
                      <div class="summary-table-container pt-0">
                          <table style="width:100%">
                              <tbody>
                                  @foreach ($orders[$key2]->order_details as $details)
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
                                              <h6 class="text-brown f-20 font-weight-500 m-0"> ₹{{$order_dets->amount}}</h6>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                              <tfoot style="background-color: #D3D3D3;">
                                  <tr>
                                      <th colspan="2">Subtotal</th>
                                      <th style="text-align: right !important;">₹{{$order_dets->amount}}</th>
                                  </tr>
                                  <tr>
                                      <th colspan="2">Shipping</th>
                                      <th style="text-align: right !important;">{{$order_dets->delivery_charge}}</th>
                                  </tr>
                                  <tr>
                                      <th colspan="2">Discount</th>
                                      <th style="text-align: right !important;">{{$order_dets->discount}}</th>
                                  </tr>
                                  <tr>
                                      <th colspan="2">Tax</th>
                                      <th style="text-align: right !important;">0</th>
                                  </tr>
                                  <tr>
                                      <th colspan="2">Grand total</th>
                                      <th style="text-align: right !important;">₹{{$order_dets->amount}}</th>
                                  </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>--->
              </div><?php */ ?>
    </div>
            </div>
         @endforeach
      @else
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <p class="h1">No orders found.</p>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
<script>
function view_details(id,show)
{
   if(show)
   {
      $(".summary_view").hide();
      $("#details_view"+id).show();
   }else
   {
      $(".summary_view").show();
      $("#details_view"+id).hide();
   }
}
</script>
@endsection