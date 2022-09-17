@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
    <div class="float-end">
        <a href="{{ route('tailors.index') }}" class="btn btn-primary" role="button">Tailors</a>
     </div>
      <h5 class="card-title mb-0">Tailors Detail</h5>
   </div>
   <div class="card-body">
      @if(!empty($tailor))
        <div class="row">
            <div class="col-md-12">
                <div class="card-body text-left">
                <div><strong>Creator:</strong> {{ $tailor->user->email }}</div>
                <div><strong>Name:</strong> {{ $tailor->name }}</div>
                <div><strong>Shop name:</strong> {{ $tailor->shop_name }}</div>
                <div><strong>Location:</strong> {{ $tailor->location }}</div>
                <div><strong>Pin code:</strong> {{ $tailor->pin_code }}</div>
                <div><strong>Email:</strong> {{ $tailor->email }}</div>
                <div><strong>Mobile:</strong> {{ $tailor->mobile }}</div>
                <div><strong>Phone:</strong> {{ $tailor->phone }}</div>
                <div><strong>Commission:</strong> {{ $tailor->commission }}</div>
                <div><strong>Address:</strong> {{ $tailor->address }}</div>
                <div><strong>Services:</strong> {{ implode(", ", json_decode($tailor->services)) }}</div>
                <div>
                  <strong>Shop Opening Timings:</strong>
                  <div class="row p-3 pt-0">
                     <div class="col-sm-2">
                        <strong>Days</strong>
                     </div>
                     <div class="col-sm-3">
                        <strong>Opnes</strong>
                     </div>
                     <div class="col-sm-7">
                        <strong>Closes</strong>
                     </div>
                     @foreach($appointments as $appointment)
                        <div class="col-sm-2">
                           {{ Str::ucfirst($appointment) }}
                        </div>
                        @if($store_timings)
                           <div class="col-sm-3">
                              {{ $store_timings[$appointment . '_opens'] }}
                           </div>
                           <div class="col-sm-7">
                              {{ $store_timings[$appointment . '_closes'] }}
                           </div>
                        @endif
                     @endforeach
                  </div>
               </div>
               @if($stitching_costs)
                  <div>
                     <strong>Stitching Cost:</strong>
                     <div class="row p-3 pt-0">
                        @foreach($stitching_costs as $stitching_cost)
                           <div class="col-sm-2">{{ Str::ucfirst(str_replace("_", " ", $stitching_cost->stitch_name)) }}</div>
                           <div class="col-sm-10">&#8377; {{ $stitching_cost->cost }}</div>
                        @endforeach
                     </div>
                  </div>
               @endif
                <div><strong>Expertise:</strong> {{ $tailor->expertise }}</div>
                <?php $photos = (isset($tailor->photos) && !empty($tailor->photos)) ? json_decode($tailor->photos) : null; ?>
                @if(!empty($photos))
                        <div class="mb-3">
                            <label>Photos:</label>
                            <div class="clearfix">                     
                                @foreach($photos as $key => $photo)
                                <div class="thumbnail-img {{ $key === 0 ? 'product-image-01': '' }} px-3 mt-2 position-relative float-start">
                                    <img width="75" height="75" src="{{ asset('public/storage/tailors/' . $photo) }}" alt="">
                                    {{-- @if(count($photos) > 1)
                                        <span class="position-absolute cursor-pointer remove-tailor-image" data-image="{{ $key }}" data-action-url="{{ route('tailor.remove_image', $tailor->id) }}">
                                        <i class="align-middle me-2" data-feather="x-circle"></i>
                                        </span>
                                    @endif --}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                @endif
                <div><strong>Status:</strong> {{ $tailor->status }}</div>
                <div><strong>Created at:</strong> {{ $tailor->created_at }}</div>
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
                     <a href="{{ route('tailors.create') }}" class="btn btn-primary btn-lg">Create new tailor</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection