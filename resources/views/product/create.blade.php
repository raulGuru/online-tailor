@extends('layouts.master')
@section('content')
<div class="container-fluid p-0">
   <h1 class="h3 mb-3">Add Material</h1>
   <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
      @csrf
      @if($tailors->count() > 0)
         <div class="card p-3">
            <div class="row">
               <div class="col-sm-3">
                  <label for="tailor-change">Tailor<span class="text-danger">*</span></label>
                  <select class="form-control" name="tailor" id="tailor-change" {{ auth()->user()->role === 'vendor' ? 'readonly': ''}}>
                     <option value="" selected disabled>Tailor</option>
                     @if($tailors->count() > 0)
                        @foreach($tailors as $tailor)
                           <option value="{{ $tailor->id }}" {{ (old('tailor') && old('tailor') == $tailor->id) ? 'selected': '' }}>{{ ucfirst($tailor->name) }}</option>
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
                  <input type="text" name="title" id="material-title" value="{{ old('title') }}" class="form-control" placeholder="Enter Material title">
                  @error('title')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
               <div class="col-sm-3">
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
               <div class="col-sm-3">
                  <label>SKU<span class="text-danger">*</span></label>
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
                  <label>Gender<span class="text-danger">*</span></label>
                  <select class="form-control" name="category">
                     <option value="" selected disabled>Gender</option>
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
                  <label>Category<span class="text-danger">*</span></label>
                  <select class="form-control" name="type" id="product_type">
                     <option value="" selected disabled>Category</option>
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
                  <label>Sub Category<span class="text-danger">*</span></label>
                  <select class="form-control" name="subtype" id="product_subtype">
                     <option value="" selected disabled>Sub category</option>

                  </select>
                  @error('subtype')
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
                  <label>Color<span class="text-danger">*</span></label>
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
               <div class="col-sm-3">
                  <label>Material Size<span class="text-danger">*</span></label>
                  <input type="text" name="size" id="material-size" value="{{ old('size') }}" class="form-control" placeholder="Enter material size">
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
                  <input type="number" min="0" name="price" value="{{ old('price') }}" id="material-price" class="form-control" placeholder="Enter price">
                  @error('price')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
               <div class="col-sm-3">
                  <label>New Commission Price <span class="text-danger">*</span></label>
                  <input type="hidden" id="commission-price-hidden" value="">
                  <input type="number" min="0" name="commission_price" value="{{ old('commission_price') }}" id="commission-price" readonly="readonly" class="form-control" placeholder="Enter commission price">
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
                  <label class="m-0">Material Thumbnail<span class="text-danger">*</span></label>
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
                  <label>Material Images<span class="text-danger">*</span></label>
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
                  <label class="mb-3">Material description<span class="text-danger">*</span></label>
                  <textarea name="product_details" class="form-control" rows="5" id="product_details">{{ old('product_details') }}</textarea>
                  @error('product_details')
                     <span class="alert alert-danger alert-dismissible mt-1">
                           <div class="alert-message p-0">
                              {{ $message }}
                           </div>
                     </span>
                  @enderror
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-6">
                  <label class="mb-1">Width</label>
                  <input type="text" name="width" value="{{ old('width') }}" class="form-control" placeholder="Enter material width">
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
                  <input type="text" name="quality" value="{{ old('quality') }}" class="form-control" placeholder="Enter material quality">
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
                  <input type="text" name="disclaimer" value="{{ old('disclaimer') }}" class="form-control" placeholder="Enter material disclaimer if any">
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
                  <input type="text" name="mfg_by" value="{{ old('mfg_by') }}" class="form-control" placeholder="Enter material Mktg. Or Mfg. By">
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
                  <textarea name="note" class="form-control" rows="5" id="note" placeholder="Enter note related this material">{{ old('note') }}</textarea>
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
         <div class="card p-3">
            <div class="row">
               <div class="col-sm-12">
                  <label class="mb-3">Tags<span class="text-danger">*</span></label>
                  <textarea name="tags" class="form-control" rows="5" id="tags">{{ old('tags') }}</textarea>
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
         <div class="row">
            <div class="col-sm-12 text-end">
               <button class="btn btn-primary" type="submit">Submit</button>
               <button class="btn btn-secondary">Cancel</button>
            </div>
         </div>
      @else
         <div class="card p-3">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('tailors.create') }}" class="btn btn-primary btn-lg">Add new Tailor</a>
                  </div>
               </div>
         </div>
         </div>
      @endif
   </form>
</div>
@endsection