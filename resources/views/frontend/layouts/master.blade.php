<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="SemiColonWeb">
    <meta name="description"
        content="Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">

    <!-- Font Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/style.css') }}">

    <!-- Font Icons -->
    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/css/font-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/one-page/css/et-line.css') }}">

    <!-- Niche Demos -->
    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/demos/course/course.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/css/swiper.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets//Canvas/demos/store/store.css') }}"> --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/custome_style.css') }}">
    
{{--   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/addons/revolution.addon.beforeafter.css') }}">--}}
{{--   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/addons/revolution.addon.particles.css') }}"> --}}
    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/css/custom.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="{{URL::asset('public/files/logo.jfif')}}" type="image/x-icon">
      <title>act college</title>
       @toastr_css()
       @yield('css')
   </head>
   
   <body class="stretched">
   
   
   <div id="wrapper">
   
      
     
      
   @include('frontend.layouts.header')
      
    
   
      
      <section id="content">
         <div class="content-wrap" style="overflow: visible;">
   
            
            <div class="wave-bottom" style="position: absolute; top: -12px; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);"></div>
            @include('admin.layouts.spinner-loader.loader')
            @yield('content')
            
            </div>
   
   
   </section>

   
   @include('cms::frontend.layouts.render-footer')
</div><!-- #wrapper end -->


<div id="gotoTop" class="uil uil-angle-up"></div>


    <script src="{{ URL::asset('assets/custome_js/front.js') }}"></script>
{{--<script src="js/functions.js"></script>--}}
{{--   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
<script src="{{ URL::asset('assets/jquery.js') }}"></script>
<script src="{{ URL::asset('assets/Canvas/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/Canvas/js/functions.js') }}"></script>
<script src="{{ URL::asset('assets/assets/sweetalert2/sweetalert.js') }}"></script>
<script src="{{ URL::asset('assets/assets/toastr/toastr.js') }}"></script>

@yield('script')
</body>
</html>
