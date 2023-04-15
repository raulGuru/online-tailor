@extends('layouts.master2')

@section('content')
<div class="container">
   @include('category.breadcrumb')
    <div class="row">
       <div class="col-md-3">
          @include('category.common-sidebar')
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
                        {!! $result->description !!}
                    </div>
                </div>
                <div class="col-md-12">
                   <h4 class="btn-brown p-3 text-white">Product Details</h4>
                  <table class="table">
                     <tbody>
                        @if($result->width)
                           <tr>
                              <th scope="col">Dimensions</th>
                              <td>{{ $result->width }}</td>
                           </tr>
                       @endif
                       @if($result->quality)
                           <tr>
                              <th scope="col">Quality</th>
                              <td>{{ $result->quality }}</td>
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
                           <th scope="col">Info</th>
                           <td>{{ $result->note }}</td>
                        </tr>
                       @endif
                       @if($result->disclaimer)
                        <tr>
                           <th scope="col">Disclaimer</th>
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
                     <a href="{{ route('home.index') }}" class="btn btn-primary btn-lg">Return to home</a>
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