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
      <title>Online Tailor</title>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
      <link href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
      <script src="{{ asset('assets/js/settings.js') }}"></script>
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
      <script src="{{ asset('assets/js/app.js') }}"></script>
      <script>
         document.addEventListener("DOMContentLoaded", function() {
            var editor = new Quill("#quill-editor", {
               modules: {
                  toolbar: "#quill-toolbar"
               },
               placeholder: "Type something",
               theme: "snow"
            });
            var bubbleEditor = new Quill("#quill-bubble-editor", {
               placeholder: "Compose an epic...",
               modules: {
                  toolbar: "#quill-bubble-toolbar"
               },
               theme: "bubble"
            });
         });
      </script>
   </body>
</html>