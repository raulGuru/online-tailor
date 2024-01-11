@extends('layouts.master2')
@section('content')
<div class="container-fluid p-0">
   <form method="post" id="measurement-form" action="{{ route('measurement.save_measurement') }}" enctype="multipart/form-data">
      @csrf
      <div class="card p-3">
         <div class="row">
            <div class="col-md-8 m-auto">
               <div class="row mb-5">
                  <div class="col-md-3 d-flex align-items-center">
                     <p class="mb-0 font-weight-500 f-16">Select what to stitch</p>
                  </div>
                  <div class="col-md-6">
                     <input type="hidden" name="product_type_id" value="{{$product_id}}">
                     <select class="form-control" name="measurement" id="measurement" data-gender="{{$gender}}">
                        <option value="" selected disabled>Select</option>
                        @if(count($measurements) > 0)
                        @foreach($measurements as $measurement)
                        <option value="{{ $measurement['id'] }}" {{ (old('measurement') && old('measurement') == $measurement['id']) ? 'selected': '' }}>{{ $measurement['name'] }}</option>
                        @endforeach
                        @endif
                     </select>
                     @error('measurement')
                     <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                     </span>
                     @enderror
                  </div>
                  <div class="row" id="dynamicfields"></div>
                  <div class="row d-none" id="image_row">
                     <div class="col-md-6 mb-4">
                        <p class="mb-1 f-16 d-flex justify-content-between">Browse images (Choose your style)
                           <input type="file" name="images[]" multiple accept="image/*">
                        </p>
                     </div>
                     <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">
               Measurement Sample
            </h5>
         </div>
         <div class="modal-body">
            <img src="" />
         </div>
      </div>
   </div>
</div>
@endsection