@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="float-end">
            <a href="{{ route('stitching.index') }}" class="btn btn-primary" role="button">
                Stitching List
            </a>
         </div>
        <h4 class="mb-3 font-weight-600">Add Stitching Cost</h4>
        <form method="post" action="{{ route('stitching.update', $stitching->id) }}">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <div class="col-sm-4 mb-3">
                    <label class="mb-1">Stitching Name<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="text" name="stitch_name" value="{{ old('stitch_name') ? old('stitch_name') : $stitching->stitch_name }}" required readonly placeholder="Enter stitching name" />
                    @error('stitch_name')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Stitching Cost<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" name="cost" value="{{ old('cost') ? old('cost') : $stitching->cost }}" step="any" required placeholder="Enter stitching cost" />
                    @error('cost')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="text-start mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection