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
            <a href="{{ route('order.paymentList') }}" class="btn btn-secondary ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear search data">
               <i class="align-middle" data-feather="refresh-cw"></i>
            </a>
         @endif
      </div>
      <h5 class="card-title mb-0">Payments</h5>
   </div>
   <div class="card-body">
      @if(isset($payments) && $payments->count() > 0)
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Payment Request Id</th>
                  <th>Payment Id</th>
                  <th>Order Id</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Created at</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($payments as $key => $payment)
               <tr>
                  <td>{{ ($payments->currentpage()-1) * $payments->perpage() + $key + 1 }}</td>
                   <td>{{ $payment->payment_request_id }}</td>
                  <td>{{ $payment->payment_id }}</td>
                  <td>{{ $payment->order_id }}</td>
                  <td>{{ $payment->amount }}</td>
                  <td>{{ $payment->transaction_status }}</td>
                  <td>{{ $payment->created_at }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $payments->links() }}</div>
          </div>
      @else
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <p class="h1">No payments found.</p>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection