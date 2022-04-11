@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="float-end">
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary" type="button">
                <i class="align-middle me-2" data-feather="edit-2"></i> Edit
            </a>
         </div>
        <h5 class="card-title mb-0">Product Details</h5>
    </div>
    <div class="card-body">
        @if(!empty($product))
            <ul class="list-unstyled mb-0">
                <li class="mb-1">
                    <strong>Product name:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->title }}</a>
                </li>
                <li class="mb-1">
                    <strong>Creator:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->user->first_name . " " . $product->user->last_name }}</a>
                </li>
                <li class="mb-1">
                    <strong>Category name:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->productCategory->title }}</a>
                </li>
                <li class="mb-1">
                    <strong>Color:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->productColor->name }}</a>
                </li>
                <li class="mb-1">
                    <strong>Size:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->productSize->label }}</a>
                </li>
                <li class="mb-1">
                    <strong>Type:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->productType->name }}</a>
                </li>
                <li class="mb-1">
                    <strong>Sleeve:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->productSleeve->name }}</a>
                </li>
                <li class="mb-1">
                    <strong>Sku:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->sku }}</a>
                </li>
                <li class="mb-1">
                    <strong>Price:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">&#8377 {{ $product->price }}</a>
                </li>
                <li class="mb-1">
                    <strong>Discount:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->discount }}</a>
                </li>
                <li class="mb-1">
                    <strong>Coupon:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->coupon }}</a>
                </li>
                <li class="mb-1">
                    <strong>Description:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{!! $product->description !!}</a>
                </li>
                <li class="mb-1">
                    <strong>Additional details:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{!! $product->additional_details !!}</a>
                </li>
                <li class="mb-1">
                    <strong>Status:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ ucfirst($product->status) }}</a>
                </li>
                <li class="mb-1">
                    <strong>Updated on:</strong> <a href="#" class="pe-none" tabindex="-1" aria-disabled="true">{{ $product->updated_at }}</a>
                </li>
                <hr>
                <li class="mb-1">
                    <p><strong>Thumbnail</strong></p>
                    @if($product->thumbnail)
                        <div class="thumbnail-img mt-2 position-relative">
                                <img width="75" height="75" src="{{ asset('storage/products/' . $product->thumbnail) }}" alt="">
                                <span class="position-absolute cursor-pointer"><i class="align-middle me-2" data-feather="x-circle"></i></span>
                            </span>
                        </div>
                    @endif
                </li>
                <hr>
                @if($product->images)
                    <li class="mb-1">
                    <p class="p-0 m-0"><strong>Images:</strong></p>
                    <?php $images = json_decode($product->images, true); ?>
                        @if(!empty($images))
                            <div class="clearfix">                     
                                @foreach($images as $key => $image)
                                <div class="thumbnail-img {{ $key === 0 ? 'product-image-01': '' }} px-3 mt-2 position-relative float-start">
                                        <img width="75" height="75" src="{{ asset('storage/products/' . $image) }}" alt="">
                                        <span class="position-absolute cursor-pointer"><i class="align-middle me-2" data-feather="x-circle"></i></span>
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endif
            </ul>
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