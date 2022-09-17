@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
    <div class="float-end">
        <a href="{{ route('stitching.index') }}" class="btn btn-primary" role="button">
            Stitching List
        </a>
     </div>
      <h5 class="card-title mb-0">Stitching Details</h5>
   </div>
   <div class="card-body">
      @if(!empty($stitching))
      <div class="row">
        <div class="col-md-12">
            <div class="card-body text-left">
               <div class="mb-2">Creator: <span class="text-muted">{{ $stitching->user->email }}<span></div>
               <div class="mb-2">Stitching Name: <span class="text-muted">{{ $stitching->stitch_name }}<span></div>
               <div>Stitching Cost: <span class="text-muted">{{ ucfirst($stitching->cost) }}<span></div>
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
                     <a href="{{ route('stitching.create') }}" class="btn btn-primary btn-lg">Add Stitching Cost</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection