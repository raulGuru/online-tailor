@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
    <div class="float-end">
        <a href="{{ route('user.index') }}" class="btn btn-primary" role="button">Users</a>
     </div>
      <h5 class="card-title mb-0">User Details</h5>
   </div>
   <div class="card-body">
      @if(!empty($user))
      <div class="row">
        <div class="col-md-12">
            <div class="card-body text-left">
               <div class="text-muted">Creator: {{ isset($user->user->email) ? $user->user->email: 'N/A' }}</div>
               <div class="text-muted">Email: {{ $user->email }}</div>
               <div class="text-muted">Gender: {{ ucfirst($user->gender) }}</div>
               <div class="text-muted">Role: {{ ucfirst($user->role) }}</div>
               <div class="text-muted">Status: {{ ucfirst($user->status) }}</div>
               <ul class="list-unstyled">
                  <li class="mb-1">
                        <span data-feather="briefcase" class="feather-sm me-1"></span> Postal Code <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $user->pin_code }}</a>
                  </li>
                  <li class="mb-1">
                  <span data-feather="map-pin" class="feather-sm me-1"></span> Phone <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $user->phone}}</a>
                  </li>
               </ul>
            </div>
        </div>
      </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg">Create new user</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection