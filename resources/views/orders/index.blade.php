@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="float-end">
         <form class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
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
   <div class="card-body">
      @if(isset($orders) && $orders->count() > 0)
         <table class="table table-striped">
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
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $orders->links() }}</div>
          </div>
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
@endsection