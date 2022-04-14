@extends('layouts.master')
@section('content')
<div class="container-fluid p-0">
   <h1 class="h3 mb-3">Add Material</h1>
   <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="card p-3">
         <div class="row">
            <div class=" col-sm-4">
               <label>Material title</label>
               <input type="text" name="title" id="material-title" value="{{ old('title') }}" class="form-control" placeholder="Enter Material title">
               @error('title')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class=" col-sm-4">
               <label>Slug (<span class="small"><span class="text-danger">*</span> SEO friendly URL</span>)</label>
               <input type="text" name="slug" id="material-slug" value="{{ old('slug') }}" class="form-control" placeholder="Change slug">
               @error('slug')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class=" col-sm-4">
               <label>SKU</label>
               <input type="text" name="sku" value="{{ old('sku') }}" class="form-control">
               @error('sku')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class=" col-sm-4">
               <label>Category</label>
               <select class="form-control" name="category">
                  <option value="" selected disabled>Category</option>
                  @if($categories->count() > 0)
                     @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category') && old('category') == $category->id) ? 'selected': '' }}>{{ $category->title }}</option>
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
            <div class=" col-sm-4">
               <label>Sub Category</label>
               <select class="form-control" name="type">
                  <option value="" selected disabled>Sub category</option>
                  @if($categories->count() > 0)
                     @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ (old('type') && old('type') == $type->id) ? 'selected': '' }}>{{ ucfirst($type->name) }}</option>
                     @endforeach
                  @endif
               </select>
               @error('type')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class=" col-sm-4">
               <label>Color</label>
               <select class="form-control" name="color">
                  <option value="" selected disabled>Select color</option>
                  @if($colors->count() > 0)
                     @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ (old('color') && old('color') == $color->id) ? 'selected': '' }}>{{ ucfirst($color->name) }}</option>
                     @endforeach
                  @endif
               </select>
               @error('color')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class=" col-sm-6">
               <label>Material Size</label>
               <input type="text" name="size" id="material-size" value="{{ old('size') }}" class="form-control" placeholder="Enter material size">
               @error('size')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-sm-6">
               <label>Material Price <span class="small text-primary">(Per Meter)</span></label>
               <input type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="Enter price">
               @error('price')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label class="m-0">Material Thumbnail</label>
               <div class="mt-2">
                  <input type="file" name="thumbnail" accept="image/*">
                  @error('thumbnail')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label>Material Images</label>
               <div class="mt-2">
                  <input type="file" name="images[]" multiple accept="image/*">
                  @error('images')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label class="mb-3">Material Details</label>
               <div class="cleaxfix">
                  <div id="product-details" class="quill-editor"></div>
                  <textarea name="product_details" id="product_details" class="d-none">{{ old('product_details') }}</textarea>
                  @error('product_details')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label class="mb-3">Additional material Information</label>
               <div class="cleaxfix">
                  <div id="product-additional-detail" class="quill-editor"></div>
                  <textarea name='additional_details' id="additional_details" class="d-none">{{ old('additional_details') }}</textarea>
                  @error('additional_details')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 text-end">
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary">Cancel</button>
         </div>
      </div>
   </form>
</div>
@endsection