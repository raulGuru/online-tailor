@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="float-end">
            <a href="{{ route('product_category.index') }}" class="btn btn-primary" role="button">
                Product Sub Category List
            </a>
         </div>
        <h4 class="mb-3 font-weight-600">Add Product Category</h4>
        <form method="post" action="{{ route('product_subcategory.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-4 mb-3">
                    <label class="mb-1">Sub Category Name<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="text" name="name" value="{{ old('name') }}" required placeholder="Enter stitching name" />
                    @error('name')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label>Category<span class="text-danger">*</span></label>
                    <select class="form-control" name="category">
                        <option value="" selected disabled>Select category</option>
                        @if($categories->count() > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ((old('category') && old('category') == $category->id)) ? 'selected': '' }}>{{ $category->name }}</option>
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
@endsection