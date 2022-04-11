<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />
      <link rel="canonical" href="https://demo.adminkit.io/pages-blank.html" />
      <title>Customize Tailor</title>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
      <link href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
   </head>
   <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
      <div class="wrapper">
         @include('layouts.sidebar')
         <div class="main">
            @include('layouts.header')
            <main class="content p-3">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        @yield('content')
                     </div>
                  </div>
               </div>
            </main>
            @include('layouts.footer')
         </div>
      </div>
      <script type="text/javascript">
         var baseUrl = "{{ url('/') }}";
         var segment1 = "{{ !empty(Request::segment(1)) ? Request::segment(1): ''; }}";
         var segment2 = "{{ !empty(Request::segment(2)) ? Request::segment(2): ''; }}";
         var segment3 = "{{ !empty(Request::segment(3)) ? Request::segment(3): ''; }}";
     </script>
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script src="{{ asset('assets/js/app.js') }}"></script>
      <script src="{{ asset('assets/js/main.js?ver=' . time()) }}"></script>
   </body>
</html>