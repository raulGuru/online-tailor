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
      <link href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/media.css') }}" rel="stylesheet">
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
                        <a class="navbar-brand" href="#"><img src="{{ asset('assets/img/logo.jpg') }}" height="40" alt="logo"></a>
                     </div>
                     <div class="col-md-5 menu-top col-10 p-0">
                        <ul>
                           <li>
                              <a href="{{ route('category.show', 'men') }}">MEN</a>
                           </li>
                           <li>
                              <a href="{{ route('category.show', 'women') }}">WOMEN</a>
                           </li>
                           <li>
                              <a class="text-brown" href="">BOOK APPOINTMENT</a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-3 col-12 p-0">
                        <form class="navbar-left serach-box">
                           <input class="form-control me-2" type="search" value="Search" placeholder="Search" aria-label="Search">
                           <i class="fa fa-search serach-icon"></i>
                        </form>
                     </div>
                     <div class="col-md-3 login-menu-top btn-brown d-flex justify-content-end col-12">
                        <ul>
                           <li>
                              <a href="#">Login</a>
                           </li>
                           <li>
                              <a href="#">Sing Up</a>
                           </li>
                           <li>
                              <a href="#"> <i class="fa fa-user"></i> </a>
                           </li>
                           <li>
                              <a href="#"><i class="fa fa-cart-plus"> </i> </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
      </header>
      @yield('content')
      <footer>
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 d-flex align-items-center">
                  <p class="m-0"> © 2022 Custom Tailor. All rights reserved</p>
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
      <script src="{{ asset('assets/js/app.js') }}"></script>
   </body>
</html>