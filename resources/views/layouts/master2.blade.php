<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title>Customize Tailor</title>
      <link href="{{ asset('public/assets/css/light.css') }}" rel="stylesheet">
      <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('public/assets/css/media.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('public/assets/css/flatpickr.min.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
      <header>
         <nav class="navbar fixed-top navbar-expand-lg">
            <div class="container-fluid">
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"><i class="fa fa-navicon"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                  <div class="row">
                     <div class="col-md-1 col-2 p-0">
                        <a class="navbar-brand" href="{{ route('home.index') }}">
                           <img src="{{ asset('public/assets/img/logo.ico') }}" alt="logo">
                        </a>
                     </div>
                     <div class="col-md-5 menu-top col-10 p-0 mt-2">
                        <ul>
                           <li>
                              <?php $query = http_build_query(['gender' => 'men']); ?>
                              <a href="{{ route('category.index', $query) }}">MEN</a>
                           </li>
                           <li>
                              <?php $query = http_build_query(['gender' => 'women']); ?>
                              <a href="{{ route('category.index', $query) }}">WOMEN</a>
                           </li>
                           <li>
                              <a href="{{ route('location.list') }}" class="check-pincode">BOOK APPOINTMENT</a>
                           </li>
                           <li>
                              <a href="javascript:void(0)" id="change-location">CHANGE LOCATION</a>
                              @if(session()->has('pincode'))
                                 <span class="text-white">({{ session()->get('pincode') }})</span>
                              @endif
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-3 col-12 p-0 mt-2">
                        <form class="navbar-left search-box" action="{{ route('category.index') }}" method="get">
                           <input type="search" name="title" id="title" value="{{ (isset($title) && !empty($title)) ? $title: '' }}" class="form-control me-2" placeholder="Search Product">
                           <i class="fa fa-search search-icon"></i>
                           <input type="submit" class="d-none" value="Submit">
                        </form>
                     </div>
                     <div class="col-md-3 login-menu-top btn-brown d-flex justify-content-end col-12">
                        <ul class="mt-2">
                           @if(!Auth::id())
                              <li>
                                 <a href="{{ route('login.index') }}" class="p-1">Login</a>
                              </li>
                              <li>
                                 <a href="{{ route('signup.index') }}" class="p-1">Sign Up</a>
                              </li>
                           @else
                              <li>
                                 <a href="#" class="p-1"><i class="fa fa-cart-plus"> </i> </a>
                              </li>
                              <li class="nav-item dropdown">
                                 <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('account.index') }}">
                                       <i class="align-middle me-1" data-feather="user"></i> Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form class="form-inline" action="{{ route('login.logout') }}" method="post">
                                       @csrf
                                       <button type="submit" class="btn mb-1 dropdown-item">
                                          <i class="fa fa-sign-out" aria-hidden="true"></i> Log out
                                      </button>
                                    </form>
                                 </div>
                              </li>
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
      </header>
      <div class="main">
         <div class="container-fluid mt-6">
            <div class="row">
               <div class="col-12">
                  @yield('content')
               </div>
            </div>
         </div>
      </div>
      <footer class="footer mt-auto py-3 bg-dark">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 d-flex align-items-center">
                  <p class="m-0"> © 2023 Custom Tailor. All rights reserved</p>
               </div>
               <div class="col-md-6 d-flex justify-content-end align-items-center">
                  <ul>
                     <li><a href="#">Footer Link</a></li>
                     <li><a href="#">Footer Link</a></li>
                     <li><a href="#">Footer Link</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </footer>
      <div class="modal fade" id="search-location" tabindex="-1" aria-labelledby="search-location-modal" aria-hidden="true">
         <div class="modal-dialog">
            <form method="post" action="{{ route('location.store') }}">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Search Location</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     @csrf
                     <p>Are you looking the best tailor near your location ?</p>
                     <div class="input-group find-location-search">
                        <input type="number" required maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="pincode" value="{{ old('pincode') }}" placeholder="Enter your pincode">
                        <button class="btn btn-blue text-white" type="submit" id="search-location-btn">Search</button>
                     </div>
                     <div class="text-danger mt-2" id="pincode-error"></div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="modal" id="confirm-dialog" tabindex="-1">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title">Proceed to login</h4>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <h4 class="text-center">Please log in to book a tailor or add measurements. Are you sure?</h4>
             </div>
             <div class="modal-footer">
               <div id="dynamic-content">
                  {{-- Dynamic link will be load here. --}}
               </div>
             </div>
           </div>
         </div>
       </div>
      <script type="text/javascript">
         var baseUrl = "{{ url('/') }}";
         var fullUrl = '{{ Request::fullUrl() }}';
         var segment1 = "{{ !empty(Request::segment(1)) ? Request::segment(1): ''; }}";
         var segment2 = "{{ !empty(Request::segment(2)) ? Request::segment(2): ''; }}";
         var segment3 = "{{ !empty(Request::segment(3)) ? Request::segment(3): ''; }}";
     </script>
      <script src="{{ asset('public/assets/js/app.js') }}"></script>
      <script src="{{ asset('public/assets/js/flatpickr.js') }}"></script>
      <script src="{{ asset('public/assets/js/main.js?ver=' . time()) }}"></script>
   </body>
</html>