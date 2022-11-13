@extends('layouts.master2')
@section('content')
{{--<pre>{{ dd($measurments) }}</pre> --}}
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Add Measurment</h1>
    <form method="post" action="{{ route('measurment.save_measurment') }}" enctype="multipart/form-data">
        @csrf
        <div class="card p-3">
            <div class="row" id="dynamicfields">
                <div class="col-sm-6 mb-2">
                    <label>Measurment For<span class="text-danger">*</span></label>
                    <select class="form-control" name="measurment" id="measurment" onchange="getFields(this)">
                        <option value="" selected disabled>Select</option>
                        @if($measurments->count() > 0)
                        @foreach($measurments as $measurment)
                        <option value="{{ $measurment->id }}" {{ (old('measurment') && old('measurment') == $measurment->id) ? 'selected': '' }}>{{ $measurment->name }}</option>
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