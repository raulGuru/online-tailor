@extends('layouts.master2')
@section('content')
<div class="container-fluid p-0">
    <form method="post" id="measurment-form" action="{{ route('measurment.save_measurment') }}" enctype="multipart/form-data">
        @csrf
        <div class="card p-3">
            <div class="row">
            <div class="col-md-8 m-auto">
                    <div class="row mb-5">
                        <div class="col-md-3 d-flex align-items-center">
                            <p class="mb-0 font-weight-500 f-16">Select  what to  stitch</p>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="product_type_id" value="{{$product_id}}">
                            <select class="form-control" name="measurment" id="measurment"  data-gender="{{$gender}}">
                                <option value="" selected disabled>Select</option>
                                @if(count($measurments) > 0)
                                @foreach($measurments as $measurment)
                                <option value="{{ $measurment['id'] }}" {{ (old('measurment') && old('measurment') == $measurment['id']) ? 'selected': '' }}>{{ $measurment['name'] }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('measurment')
                            <span class="alert alert-danger alert-dismissible mt-1">
                                <div class="alert-message p-0">
                                    {{ $message }}
                                </div>
                            </span>
                            @enderror                            
                        </div>
                    </div>
                    
                    <h3 class="font-weight-500 mb-4 h3_title_measurment"></h3>
                    <div class="row" id="dynamicfields">
    
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection