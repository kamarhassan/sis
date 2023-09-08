<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="keywords" content=""/>
   <meta name="author" content=""/>
   <meta name="robots" content=""/>
   <meta name="description" content="Smart Class: coaching classes"/>
   <meta property="og:title" content="Smart Class: coaching classes"/>
   <meta property="og:description" content="Smart Class: coaching classes"/>
   <meta property="og:image" content=""/>
   <meta name="format-detection" content="telephone=no">

   <!-- FAVICONS ICON -->
   <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
   <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>

   <!-- PAGE TITLE HERE -->
   <title>Smart Class: coaching classes</title>

   <!-- MOBILE SPECIFIC -->
   <meta name="viewport" content="width=device-width, initial-scale=1">

   {{--   <script src="{{ URL::asset('assets/frontend/js/html5shiv.min.js') }}"></script>--}}
   {{--   <script src="{{ URL::asset('assets/frontend/js/respond.min.js') }}"></script>--}}
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/frontend/css/plugins.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/frontend/css/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/frontend/css/templete.css') }}">
   <link class="skin" rel="stylesheet" type="text/css"
         href="{{ URL::asset('assets/frontend/css/skin/skin-1.css') }}">
   @toastr_css()
   @yield('css')


   <style>


   </style>
</head>

<body id="bg">
<div class="page-wraper">
   <div id="loading-area">
      <h1 class="ml4">
         <span class="letters letters-1">Ready</span>
         <span class="letters letters-2">Set</span>
         <span class="letters letters-3">Go</span>
      </h1>
   </div>

   @include('frontend.layouts.header')


   <div class="page-content bg-white">

      <div class="content-block ">
         <div class="section-full bg-gray content-inner-2">
            <div class="container bg-white">
               @yield('content')
            </div>
         </div>

      </div>
   </div>
</div>
@include('cms::frontend.layouts.render-footer')


<button class="scroltop fa fa-chevron-up"></button>
  
<script src="{{ URL::asset('assets/app-assets/js/vendors.min.js') }}"></script>
<script src="{{ URL::asset('assets/custome_js/front.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/wow/wow.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/lightgallery/js/lightgallery-all.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/counter/waypoints-min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/counter/counterup.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/masonry/masonry-3.1.4.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/masonry/masonry.filter.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/scroll/scrollbar.min.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/js/custom.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/js/dz.carousel.js') }}"></script>
{{--     <script src="https://maps.google.com/maps/api/js?key=AIzaSyBjirg3UoMD5oUiFuZt3P9sErZD-2Rxc68&sensor=false"></script> --}}
{{--     <script src='https://www.google.com/recaptcha/api.js'></script> --}}
<script src="{{ URL::asset('assets/frontend/js/dz.ajax.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/loading/anime.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/plugins/loading/anime-app.js') }}"></script>
<script src="{{ URL::asset('assets/frontend/js/jquery.marquee.js') }}"></script>
@toastr_js
@toastr_render
@yield('script')

<script>
    $(function () {
        $('.marquee').marquee({
            speed: 100,
            gap: 0,
            delayBeforeStart: 0,
            direction: 'left',
            duplicated: true,
            pauseOnHover: true
        });
        $('.marquee1').marquee({
            speed: 50,
            gap: 0,
            delayBeforeStart: 0,
            direction: 'up',
            duplicated: true,
            pauseOnHover: true
        });
    });
</script>

</body>

</html>
