
@extends('layouts.master2')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-2 border-end">
                <div class="d-grid gap-2">
                    <a href="{{ route('account.index') }}" role="button" class="btn btn-light mb-3">Account Settings</a>
                    <a href="{{ route('account.orders') }}" role="button" class="btn btn-primary mb-3">My Orders</a>
                    <a href="{{ route('account.address') }}" role="button" class="btn btn-light mb-3">Address</a>
                </div>
            </div>
            <div class="col">
                 <input type="hidden" name="update_for" value="order" />
                    <div class="row float-end ">
                        <button width="10%" style="display:none" class="btn btn-primary details_view" type="button" onclick="backFunc();">Back
                        </button>
                    </div>
                <form method="post" action="">
                    @csrf
                    @method('PATCH')
                   
                    <div class="row mb-3">
                       
               </button>
                       @if(isset($orders) && $orders->count() > 0)
         <table style="width:100% !important;" class="table table-striped summary_view" >
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
            
                <?php
                  $pass_data['continue_btn'] =false;
                  $pass_data['order_summary'] =$order_dets;
                  $pass_data['order_details'] =!empty($order_dets->order_details)?$order_dets->order_details:[];
                  $pass_data['tailor'] =!empty($order_dets->tailor)?$order_dets->tailor:[];
                ?>

            <x-order-summary :summary="(array)$pass_data" />
           
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
                    <div class="text-end mt-3">
                        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
var selected_id=0;   
function view_details(id,show)
{
   selected_id=id;
   if(show==true)
   {
      $(".summary_view").css('display','none');
      $("#details_view"+id).css('display','block');
      $(".details_view").show();
   }else
   {
      $(".summary_view").removeAttr('style');
      $("#details_view"+id).css('display','none');
      $(".details_view").hide();
   }
}
function  backFunc()
{
    $(".summary_view").removeAttr('style');
      $("#details_view"+selected_id).css('display','none');
      $(".details_view").hide();
}

</script>