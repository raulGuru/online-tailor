@extends('layouts.master2')

@section('content')
<div class="container">
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
                     <a href="#" class="text-decoration-none text-reset">
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
          <div class="row">
             @if(!empty($result))
                <?php $images = json_decode($result->images, true); ?>
                @if(isset($images) && !empty($images))
                    <div class="col-md-6 big-img-product">
                        <ul>
                            @foreach($images as $image)
                                <li><img src="{{ asset('public/storage/products/' . $image) }}" alt=""></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-6 {{ (isset($images) && !empty($images)) ? 'col-md-6': 'col-md-12'}}">
                    <h4 class="font-weight-600">{{ $result->title }} </h4>
                    <div class="d-flex mb-4">
                        <h6 class="text-brown f-20 font-weight-500 m-0">&#8377; {{ $result->price }} /meter</h6>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <a href="{{ route('location.list') }}" id="check-pincode" class="btn d-block add-bag-btn">BOOK TAILOR</a>
                            <form action="{{ route('measurement.store') }}" method="post">
                              @csrf
                              <input type="hidden" name="product_id" value="{{$result->id}}">
                              <input type="hidden" name="cat_id" value="{{$result->cat_id}}">
                              <button type="submit" class="btn d-block add-wish-btn mt-3">
                                 ADD MEASUREMENT 
                              </button>
                            </form>
                            {{-- <a href="{{ route('measurement.index') }}" class="btn d-block add-wish-btn mt-3">ADD MEASUREMENT </a> --}}
                        </div>
                    </div>

                    <div class="product-details mb-4">
                        <h3>Product Details </h3>
                        {!! $result->description !!}
                    </div>
                </div>
                <div class="col-md-12">
                   <h4 class="btn-brown p-3 text-white">Product Details</h4>
                  <table class="table">
                     <tbody>
                        @if($result->width)
                           <tr>
                              <th scope="col">Width</th>
                              <td>{{ $result->width }}</td>
                           </tr>
                       @endif
                       @if($result->productType->name)
                           <tr>
                              <th scope="col">Type</th>
                              <td>{{ ucfirst($result->productType->name) }}</td>
                           </tr>
                       @endif
                       @if($result->productColor)
                           <tr>
                              <th scope="col">Color</th>
                              <td>{{ $result->productColor->name }}</td>
                           </tr>
                       @endif
                       @if($result->mfg_by)
                        <tr>
                           <th scope="col">Mfg by</th>
                           <td>{{ $result->mfg_by }}</td>
                        </tr>
                       @endif
                       @if($result->note)
                        <tr>
                           <th scope="col">Note</th>
                           <td>{{ $result->note }}</td>
                        </tr>
                       @endif
                       @if($result->disclaimer)
                        <tr>
                           <th scope="col">disclaimer</th>
                           <td>{{ $result->disclaimer }}</td>
                        </tr>
                       @endif
                       @if($result->additional_details)
                        <tr>
                           <th scope="col">Additional details</th>
                           <td>{!! $result->additional_details !!}</td>
                        </tr>
                       @endif
                     </tbody>
                   </table>
                </div>
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
       </div>
    </div>
 </div>
 <script>
    let fullUrl = '{{ Request::fullUrl() }}';
    console.log('fullUrl => ', fullUrl);
 </script>
@endsection