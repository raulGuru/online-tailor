@extends('layouts.master2')

@section('content')
<div class="container mt-6">
    <div class="breadcrumb-menu mt-0 mb-4">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('category.index') }}">Home</a>
            </li>
            @if(request()->gender)
               <li class="breadcrumb-item active">{{ ucfirst(request()->gender) }}</li>
            @endif
         </ol>
      </nav>
    </div>
    <div class="row">
       <div class="col-md-3">
          <div class="categories-border mb-4">
             <h4 class="font-weight-600 m-0">CATEGORIES</h4>
             <img src="{{ asset('public/assets/img/small-line.svg') }}" alt="">
             @if($categories->count() > 0)
               <ul class="categories-listing mt-3 p-0">
                  @foreach($categories as $category)
                     <a href="{{ route('category.index', http_build_query(['type' => strtolower($category->name)])) }}" class="text-decoration-none text-reset">
                        <li class="d-flex justify-content-between mt-3">
                           <span> {{ ucfirst($category->name) }} </span>
                           <span>({{ $category->posts->count() }})</span>
                        </li>
                     </a>
                  @endforeach
               </ul>
             @endif
          </div>
          <div class="categories-border">
             <h4 class="font-weight-600 m-0">COLOR</h4>
             <img src="{{ asset('public/assets/img/small-line.svg') }}" alt="">
             @if($colors->count() > 0)
               <ul class="categories-listing mt-3 p-0">
                  @foreach($colors as $color)
                     <a href="{{ route('category.index', http_build_query(['color' => strtolower($color->name)])) }}" class="text-decoration-none text-reset">
                        <li class="d-flex justify-content-between mt-3">
                           <span> {{ $color->name }} </span>
                           <span class="circle-color" style="background: {{ $color->code }}"></span>
                        </li>
                     </a>
                  @endforeach
               </ul>
             @endif
          </div>
       </div>
       <div class="col-md-9">
          <div class="row mb-4">
             <div class="col-md-4">
               <div class="input-group mb-3">
                  <span class="input-group-text">Sort By: </span>
                  <select class="form-select" id="order" aria-label="Default select example">
                     <option value="asc" {{ ($order && $order == 'asc') ? 'selected': '' }}>Name (A - Z)</option>
                     <option value="desc" {{ ($order && $order == 'desc') ? 'selected': '' }}>Name (Z - A)</option>
                  </select>
                </div>
             </div>
            <div class="col-md-4">
               <div class="input-group mb-3">
                  <span class="input-group-text">Show:</span>
                  <select class="form-select change-limit" aria-label="Default select example">
                     <option value="5" {{ ($limit && $limit == '5') ? 'selected': '' }}>5</option>
                     <option value="10" {{ ($limit && $limit == '10') ? 'selected': '' }}>10</option>
                     <option value="15" {{ ($limit && $limit == '15') ? 'selected': '' }}>15</option>
                     <option value="25" {{ ($limit && $limit == '25') ? 'selected': '' }}>25</option>
                     <option value="50" {{ ($limit && $limit == '50') ? 'selected': '' }}>50</option>
                     <option value="75" {{ ($limit && $limit == '75') ? 'selected': '' }}>75</option>
                     <option value="100" {{ ($limit && $limit == '100') ? 'selected': '' }}>100</option>
                  </select>
               </div>
            </div>
             <div class="col-md-4 text-end">
                <p class="m-0"> Showing {{ ($results->count()) }} results</p>
             </div>
          </div>
          <div class="row">
             @if($results->count() > 0)
               @foreach($results as $result)
                  <div class="col-md-4 text-center mb-4">
                     <div class="product-shrot-view card pb-2">
                        <a href="{{ route('category.show', $result->slug) }}" data-id="{{$result->id}}">
                           <img src="{{ asset('public/storage/products/' . $result->thumbnail) }}" alt="{{ $result->title }}">
                        </a>
                        <h4 class="mt-3 font-weight-500">{{ $result->title }}</h4>
                        <h4 class="mt-2 font-weight-500">&#8377; {{ $result->price }}</h4>
                        <div class="text-center">
                           <a href="{{ route('category.show', $result->slug) }}" class="btn btn-success btn-sm">
                              <i class="fa fa-eye"></i> View
                           </a>
                        </div>
                     </div>
                  </div>
               @endforeach
             @else
               <div class="col-md-12">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">404</h1>
                     <p class="h1">No Result Found.</p>
                     <p class="font-weight-normal mt-3 mb-4">Try searching some other keywords or apply different set of filters</p>
                     <p class="font-weight-normal mt-3 mb-4">Try other items in our store</p>
                     <a href="{{ route('category.index') }}" class="btn btn-primary btn-lg">Return to home</a>
                  </div>
               </div>
             @endif
          </div>
         <div class="d-flex justify-content-center">
            {!! $results->links() !!}
         </div>
       </div>
    </div>
 </div>
 <script>
    let fullUrl = '{{ Request::fullUrl() }}';
    console.log('fullUrl => ', fullUrl);
 </script>
@endsection