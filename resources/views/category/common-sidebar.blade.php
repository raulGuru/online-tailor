<div class="categories-border mb-4">
    <h4 class="font-weight-600 m-0">CATEGORIES</h4>
    <img src="{{ asset('public/assets/img/small-line.svg') }}" alt="">
    @if($categories->count() > 0)
      <ul class="categories-listing mt-3 p-0">
         @foreach($categories as $key => $category)
            @if($category->posts->count() > 0)
               <li class="sidebar-item">
                  <a href="{{ route('category.index', http_build_query(['gender'=> session()->get('gender'), 'type' => strtolower($category->name)])) }}" class="sidebar-link d-flex justify-content-between mt-3 text-white">
                     <span>{{ ucfirst($category->name) }}</span>
                     {{-- @TODO Add logic for fetch product count --}}
                     {{-- <span>({{ $category->posts->count() }})</span> --}}
                  </a>
                  <ul class="sidebar-dropdown list-unstyled">
                     @foreach($category->subCategories as $subCategory)
                        @if($subCategory->post_count->count() > 0)
                           <li class="sidebar-item p-2">
                              <a href="{{ route('category.index', http_build_query(['gender'=> session()->get('gender'), 'type' => strtolower($category->name), 'subtype' => strtolower($subCategory->name)])) }}" class="d-flex justify-content-between mt-3">
                                 <span>{{ ucfirst($subCategory->name) }}</span>
                                 <span>({{ $subCategory->post_count->count() }})</span>
                              </a>
                           </li>
                        @endif
                     @endforeach
                  </ul>
               </li>
            @endif
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
            @if($color->post_count->count() > 0)
                <a href="{{ route('category.index', http_build_query(['gender'=> session()->get('gender'), 'type' => strtolower(request()->type), 'subtype' => strtolower(request()->subtype), 'color' => strtolower($color->name)])) }}" class="text-decoration-none text-reset">
                    <li class="d-flex justify-content-between mt-3">
                        <span> {{ $color->name }} </span>
                        <span class="circle-color" style="background: {{ $color->code }}"></span>
                    </li>
                </a>
            @endif
         @endforeach
      </ul>
    @endif
 </div>