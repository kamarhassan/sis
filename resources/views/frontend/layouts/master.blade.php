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
  
    
{{--   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/addons/revolution.addon.beforeafter.css') }}">--}}
{{--   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/addons/revolution.addon.particles.css') }}"> --}}
    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/css/custom.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">




  
 
   
   
   
   
   
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
   
            @yield('content')
            
            </div>
   
            
   {{--         <div class="section m-0" style="padding: 120px 0; background: #FFF url('demos/course/images/instructor.jpg') no-repeat left top / cover">--}}
{{--            <div class="container">--}}
{{--               <div class="row">--}}

{{--                  <div class="col-md-7"></div>--}}

{{--                  <div class="col-md-5">--}}
{{--                     <div class="heading-block border-bottom-0 mb-4 mt-5">--}}
{{--                        <h3>Become an Instructor!</h3>--}}
{{--                        <span>Teach What You Love.</span>--}}
{{--                     </div>--}}
{{--                     <p class="mb-2">Monotonectally conceptualize covalent strategic theme areas and cross-unit deliverables.</p>--}}
{{--                     <p>Consectetur adipisicing elit. Voluptate incidunt dolorum perferendis accusamus nesciunt et est consequuntur placeat, dolor quia.</p>--}}
{{--                     <a href="#" class="button button-rounded button-xlarge ls-0 text-transform-none fw-normal m-0">Start Teaching</a>--}}
{{--                  </div>--}}

{{--               </div>--}}
{{--            </div>--}}
{{--         </div>--}}

{{--         <div class="promo promo-light promo-full p-5 footer-stick" style="padding: 60px 0 !important;">--}}
{{--            <div class="container">--}}
{{--               <div class="row align-items-center">--}}
{{--                  <div class="col-12 col-lg">--}}
{{--                     <h3 class="ls-1">Call us today at <span>+1.22.57412541</span> or Email us at <span>support@canvas.com</span></h3>--}}
{{--                     <span class="text-black-50">We strive to provide Our Customers with Top Notch Support to make their Theme Experience Wonderful.</span>--}}
{{--                  </div>--}}
{{--                  <div class="col-12 col-lg-auto mt-4 mt-lg-0">--}}
{{--                     <a href="#" class="button button-xlarge button-rounded text-transform-none ls-0 fw-normal m-0">Start Now</a>--}}
{{--                  </div>--}}
{{--               </div>--}}
{{--            </div>--}}
{{--         </div>--}}

      
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
