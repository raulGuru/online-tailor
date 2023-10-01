@extends('layouts.master')
@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between mb-2">
        <h4 class="font-weight-600">Add Product Category</h4>
        <a href="{{ route('product_category.index') }}" class="btn btn-primary" role="button">
            Product Category List
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('product_category.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-4 mb-3">
                        <label class="mb-1">Category Name<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter stitching name" />
                        @error('name')
                            <span class="alert alert-danger alert-dismissible mt-1">
                                <div class="alert-message p-0">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="mb-1">Category<span class="text-danger">*</span></label>
                        <select class="form-control" name="category">
                            <option value="" selected disabled>Select category</option>
                            @if($categories->count() > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ ((old('category') && old('category') == $category->id)) ? 'selected': '' }}>{{ $category->title }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('category')
                            <span class="alert alert-danger alert-dismissible mt-1">
                                <div class="alert-message p-0">
                                {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-start mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection