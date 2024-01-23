@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="float-end">
         <form class="d-none d-sm-inline-block ">
            <div class="input-group input-group-navbar ">
               <input type="text" class="form-control summary_view" name="q" value="{{ request()->q }}" title="Searchs" placeholder="Search" aria-label="Search">
               <button class="btn summary_view" type="submit">
                  <i class="align-middle" data-feather="search"></i>
               </button>

            </div>
         </form>
         <button style="display:none" class="btn btn-primary float-end details_view" type="button" onclick="backFunc();">Back
         </button>
         @if(request()->q)
         <a href="{{ route('order.list') }}" class="btn btn-secondary ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear search data">
            <i class="align-middle" data-feather="refresh-cw"></i>
         </a>
         @endif
      </div>
      <h5 class="card-title mb-0">Orders</h5>
   </div>
   <div class="card-body">
      @if(isset($orders) && $orders->count() > 0)
      <table style="width:100% !important;" class="table table-striped summary_view">
         <thead>
            <tr>
               <th>#</th>
               <th>Order Id</th>
               <th>Name</th>
               <th>Email</th>
               <th>Mobile</th>
               <th>Address</th>
               <th>Amount</th>
               <th style="text-align: center">Status</th>
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
               <td style="text-align: center"><span id="statsspan<?php echo $order->id; ?>">{{ $order->status }}</span></td>
               <td>{{ $order->order_date }}</td>
               <td>
                  <div>
                     <a href="javascript:void(0);" onclick="view_details('<?php echo $order->id; ?>',true);">
                        <i class="align-middle me-2" data-feather="eye"></i>
                     </a>
                  </div>
               </td>
               <?php if (!empty($role) && $role === 'vendor' && $order->status !== 'delivered' && $order->status !== 'failed') {
                  $nxt_stats = '';
                  if ($order->status === 'initiated') {
                     $nxt_stats = 'placed';
                  } elseif ($order->status === 'placed') {
                     $nxt_stats = 'in progress';
                  } elseif ($order->status === 'in progress') {
                     $nxt_stats = 'out for delivery';
                  } elseif ($order->status === 'out for delivery') {
                     $nxt_stats = 'delivered';
                  }
               ?>
                  <td style="text-align: center">
                     <div>
                        <input type="hidden" name="next<?php echo $order->id; ?>" id="next<?php echo $order->id; ?>" value="<?php echo $nxt_stats; ?>">
                        <button class="btn btn-info" type="button" id="btn<?php echo $order->id; ?>" onClick="updateStatus('<?php echo $order->id; ?>')">
                           Update to {{ $nxt_stats }}
                        </button>
                     </div>
                  </td>
               <?php
                  unset($nxt_stats);
               } ?>
            </tr>
            @endforeach
         </tbody>
      </table>
      <div class="d-flex flex-row-reverse summary_view">
         <div class="p-0">{{ $orders->links() }}</div>
      </div>

      @foreach($orders as $key2 => $order_dets)

      <div class="card-body" style="display:none;" id="details_view<?php echo $order_dets->id; ?>">
         <?php
         $pass_data['continue_btn'] = false;
         $pass_data['order_summary'] = $order_dets;
         $pass_data['order_details'] = !empty($order_dets->order_details) ? $order_dets->order_details : [];
         $pass_data['tailor'] = !empty($order_dets->tailor) ? $order_dets->tailor : [];
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
</div>
<script>
   var selected_id = 0;

   function view_details(id, show) {
      selected_id = id;
      if (show == true) {
         $(".summary_view").css('display', 'none');
         $("#details_view" + id).css('display', 'block');
         $(".details_view").show();
      } else {
         $(".summary_view").removeAttr('style');
         $("#details_view" + id).css('display', 'none');
         $(".details_view").hide();
      }
   }

   function backFunc() {
      $(".summary_view").removeAttr('style');
      $("#details_view" + selected_id).css('display', 'none');
      $(".details_view").hide();
   }

   function updateStatus(id) {

      const update_stats = $("#next" + id).val();
      let next_stats = '';
      if (update_stats === 'initiated') {
         next_stats = 'placed';
      } else if (update_stats === 'placed') {
         next_stats = 'in progress';
      } else if (update_stats === 'in progress') {
         next_stats = 'out for delivery';
      } else if (update_stats === 'out for delivery') {
         next_stats = 'delivered';
      }


      $.ajax({
         url: "{{ route('order.update_status') }}",
         type: "post",
         dataType: "json",
         data: {
            id,
            update_stats,
            "_token": "{{ csrf_token() }}"
         },
         success: function(d) {
            alert(d.status);
            if (d.status) {
               if (next_stats.length === 0) {
                  $("#next" + id).remove();
                  $("#btn" + id).remove();
                  if (update_stats === 'delivered') {
                     $("#statsspan" + id).html('delivered');
                  }

               } else {

                  $("#next" + id).val(next_stats);
                  $("#statsspan" + id).html(update_stats);
                  $("#btn" + id).html("Update to " + next_stats);
               }
            }
         }
      });
   }
</script>
@endsection