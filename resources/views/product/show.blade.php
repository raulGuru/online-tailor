@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="float-end">
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary" type="button">
                <i class="align-middle me-2" data-feather="edit-2"></i> Edit
            </a>
         </div>
        <h5 class="card-title mb-0">Material Details:</h5>
    </div>
    <div class="card-body">
        @if(!empty($product))
            <h4>Creator:</h4> 
            <p>{{ $product->user->first_name . " " . $product->user->last_name }}</p>
            <h4>Material's name:</h4>
            <p>{{ $product->title }}</p>
            <h4>Main Category:</h4>
            <p>{{ $product->MasterCategory->title }}</p>
            <h4>Category:</h4> 
            <p>{{ ucfirst($product->productCategory->name) }}</p>
            <h4>Sub Category:</h4> 
            <p>{{ ucfirst($product->productSubCategory->name) }}</p>
            <h4>Color:</h4> 
            <p>{{ ucfirst($product->productColor->name) }}</p>
            <h4>Size:</h4> 
            <p>{{ $product->size }}</p>
            <h4>Sku:</h4>
            <p>{{ $product->sku }}</p>
            <h4>Price:</h4> 
            <p>&#8377 {{ $product->price }}</p>
            <h4>Status:</h4>
            <p>{{ ucfirst($product->status) }}</p>
            <h4>Updated on:</h4>
            <p>{{ $product->updated_at }}</p>
            <h4>Description:</h4> 
            {!! $product->description !!}
            <h4 class="mt-3">Additional details:</h4> 
            {!! $product->additional_details !!}
            <h4>Thumbnail</h4>
            @if($product->thumbnail)
                <div class="thumbnail-img mt-2 position-relative">
                    <img width="75" height="75" src="{{ asset('public/storage/products/' . $product->thumbnail) }}" alt="">
                </div>
            @endif
            <hr>
            @if($product->images)
                <h4>Images</h4>
                <?php $images = json_decode($product->images, true); ?>
                @if(!empty($images))
                    <div class="clearfix">                     
                        @foreach($images as $key => $image)
                        <div class="thumbnail-img {{ $key === 0 ? 'product-image-01': '' }} px-3 mt-2 position-relative float-start">
                            <img width="75" height="75" src="{{ asset('public/storage/products/' . $image) }}" alt="">
                            @if(count($images) > 1)
                                <span class="position-absolute cursor-pointer remove-material-image" data-image="{{ $key }}" data-action-url="{{ route('product.remove_image', $product->id) }}">
                                <i class="align-middle me-2" data-feather="x-circle"></i>
                                </span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            @endif
            @if($product->tags)
            <hr>
                <h4>Tags</h4>
                <p>{{ $product->tags }}</p>
            @endif
        @else
            <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center">
                        <h1 class="display-1 font-weight-bold">402</h1>
                        <p class="h1">No data available.</p>
                        <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-lg">Create new product</a>
                    </div>
                </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection