@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="float-end">
            <a href="{{ route('product_subcategory.index') }}" class="btn btn-primary" role="button">
                Product sub category List
            </a>
         </div>
        <h4 class="mb-3 font-weight-600">Add Product Sub Category</h4>
        <form method="post" action="{{ route('product_subcategory.update', $subcategory->id) }}">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <div class="col-sm-4 mb-3">
                    <label class="mb-1">Product Sub Category Name<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="text" name="name" value="{{ old('name') ? old('name') : $subcategory->name }}" placeholder="Enter product category name" />
                    @error('name')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>

                <div class=" col-sm-4">
                <label>Category<span class="text-danger">*</span></label>
                <select class="form-control" name="category">
                    <option value="" selected disabled>Select category</option>
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ((old('category') && old('category') == $category->id) || $subcategory->product_category_id == $category->id) ? 'selected': '' }}>{{ $category->name }}</option>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection