@extends('layouts.master')
@section('content')
<div class="container-fluid p-0">
   <h1 class="h3 mb-3">Edit Material</h1>
   <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-3">
               <label for="tailor-change">Tailor<span class="text-danger">*</span></label>
               <select class="form-control" name="tailor" id="tailor-change" {{ auth()->user()->role === 'vendor' ? 'readonly': ''}}>
                  <option value="" selected disabled>Tailor</option>
                  @if($tailors->count() > 0)
                     @foreach($tailors as $tailor)
                        <option value="{{ $tailor->id }}" {{ (old('tailor') && (old('tailor') == $tailor->id) || $tailor->id == $product->tailor_id) ? 'selected': '' }}>{{ ucfirst($tailor->name) }}</option>
                     @endforeach
                  @endif
               </select>
               @error('tailor')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-sm-3">
               <label>Material title<span class="text-danger">*</span></label>
               <input type="text" name="title" id="material-title" value="{{ (old('title')) ? old('title'): $product->title }}" class="form-control" placeholder="Enter product title">
               @error('title')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-sm-3">
               <label>Slug (<span class="small">SEO friendly URL</span>)<span class="text-danger">*</span></label>
               <input type="text" name="slug" id="material-slug" value="{{ (old('slug')) ? old('slug'): $product->slug }}" class="form-control" placeholder="Change slug">
               @error('slug')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-sm-3">
               <label>SKU<span class="text-danger">*</span></label>
               <input type="text" name="sku" value="{{ (old('sku')) ? old('sku'): $product->sku }}" class="form-control">
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
               <label>Main Category<span class="text-danger">*</span></label>
               <select class="form-control" name="category">
                  <option value="" selected disabled>Select category</option>
                  @if($categories->count() > 0)
                     @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ((old('category') && old('category') == $category->id) || $product->cat_id == $category->id) ? 'selected': '' }}>{{ $category->title }}</option>
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
               <label>Category<span class="text-danger">*</span></label>
               <select class="form-control" name="type" id="product_type">
                  <option value="" selected disabled>Category</option>
                  @if($categories->count() > 0)
                     @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ ((old('type') && old('type') == $type->id) || $product->type_id == $type->id) ? 'selected': '' }}>{{ ucfirst($type->name) }}</option>
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
               <label>Sub Category<span class="text-danger">*</span></label>
               <select class="form-control" name="subtype" id="product_subtype">
                  <option value="" selected disabled>Sub category</option>
                  @if($categories->count() > 0)
                     @foreach($subtypes as $type)
                        <option value="{{ $type->id }}" {{ ((old('subtype') && old('subtype') == $type->id) || $product->subtype_id == $type->id) ? 'selected': '' }}>{{ ucfirst($type->name) }}</option>
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
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-3">
               <label>Product Color<span class="text-danger">*</span></label>
               <select class="form-control" name="color">
                  <option value="" selected disabled>Select color</option>
                  @if($colors->count() > 0)
                     @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ ((old('color') && old('color') == $color->id) || $product->color_id == $color->id) ? 'selected': '' }}>{{ ucfirst($color->name) }}</option>
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
            <div class="col-sm-3">
               <label>Material Size<span class="text-danger">*</span></label>
               <input type="text" name="size" value="{{ (old('size')) ? old('size'): $product->size }}" class="form-control" placeholder="Enter material size">
               @error('size')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-sm-3">
               <label>Material Price <span class="small text-primary">(Per Meter)</span><span class="text-danger">*</span></label>
               <input type="number" min="0" name="price" value="{{ (old('price')) ? old('price'): $product->commission_price }}" id="material-price" class="form-control" placeholder="Enter price">
               @error('price')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-sm-3">
               <label>Final price with commission <span class="text-danger">*</span></label>
               <input type="hidden" id="commission-price-hidden" value="{{ $product->tailor->commission }}">
               <input type="number" min="0" name="commission_price" value="{{ (old('commission_price')) ? old('commission_price'): $product->commission_price }}" id="commission-price" readonly="readonly" class="form-control" placeholder="Enter commission price">
               @error('commission_price')
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
               <label class="m-0">Product Thumbnail<span class="text-danger">*</span></label>
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
               @if($product->thumbnail)
                  <div class="thumbnail-img mt-2 position-relative">
                     <img width="75" height="75" src="{{ asset('public/storage/products/' . $product->thumbnail) }}" alt="">
                  </div>
               @endif
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label>Product Images<span class="text-danger">*</span></label>
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
               @if($product->images)
                  <?php $images = json_decode($product->images, true); ?>
                  @if(!empty($images))
                     <div class="clearfix">                     
                        @foreach($images as $key => $image)
                           <div class="thumbnail-img mt-2 px-3 position-relative float-start">
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
            </div>
         </div>
      </div>
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label class="mb-3">Product Details<span class="text-danger">*</span></label>
               <div class="cleaxfix">
                  <textarea name="product_details" class="form-control" rows="5" id="product_details">{{ (old('description')) ? old('description'): $product->description }}</textarea>
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
         <div class="row mt-3">
            <div class="col-6">
               <label class="mb-1">Dimensions</label>
               <input type="text" name="width" value="{{ (old('width')) ? old('width'): $product->width }}" class="form-control" placeholder="Enter material width">
               @error('width')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-6">
               <label class="mb-1">Quality</label>
               <input type="text" name="quality" value="{{ (old('quality')) ? old('quality'): $product->quality }}" class="form-control" placeholder="Enter material quality">
               @error('quality')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-6">
               <label class="mb-1 mt-2">Disclaimer</label>
               <input type="text" name="disclaimer" value="{{ (old('disclaimer')) ? old('disclaimer'): $product->disclaimer }}" class="form-control" placeholder="Enter material disclaimer if any">
               @error('disclaimer')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-6">
               <label class="mb-1 mt-2">Mktg. Or Mfg. By</label>
               <input type="text" name="mfg_by" value="{{ (old('mfg_by')) ? old('mfg_by'): $product->mfg_by }}" class="form-control" placeholder="Enter material Mktg. Or Mfg. By">
               @error('mfg_by')
                  <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                           {{ $message }}
                        </div>
                  </span>
               @enderror
            </div>
            <div class="col-12">
               <label class="mb-1 mt-2">Info</label>
               <textarea name="note" class="form-control" rows="5" id="note" placeholder="Enter note related this material">{{ (old('note')) ? old('note'): $product->note }}</textarea>
               @error('note')
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
               <label class="mb-3">Additional Product Information</label>
               <div class="cleaxfix">
                  <div id="product-additional-detail" class="quill-editor"></div>
                  <textarea name='additional_details' id="additional_details" class="d-none">{{ (old('additional_details')) ? old('additional_details'): $product->additional_details }}</textarea>
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
      <div class="card p-3">
         <div class="row">
            <div class="col-sm-12">
               <label class="mb-3">Tags<span class="text-danger">*</span></label>
               <div class="cleaxfix">
                  <textarea name="tags" class="form-control" rows="5" id="tags">{{ (old('tags')) ? old('tags'): $product->tags }}</textarea>
                  @error('tags')
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