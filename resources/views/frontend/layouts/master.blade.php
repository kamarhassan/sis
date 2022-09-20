<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  {{-- <title>Company Bootstrap Template - Index</title> --}}
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ URL::asset('assets/frontend/img/favicon.png')}}" rel="icon">
  <link href="{{ URL::asset('assets/frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ URL::asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/frontend/vendor/remixicon/remixicon.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ URL::asset('assets/frontend/css/style.css')}}" rel="stylesheet">


  <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/style.css') }}">
  
  {{-- <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/vendors_css.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/skin_color.css') }}"> --}}
  <!-- =======================================================
  * Template Name: Company - v2.1.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('frontend.layouts.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <!-- End Hero -->

<div id="app" style="padding-top: 2.5cm">
     @yield('content')
</div>

 <!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('frontend.layouts.footer')
<!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ URL::asset('assets/frontend/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/jquery-sticky/jquery.sticky.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{ URL::asset('assets/frontend/vendor/aos/aos.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ URL::asset('assets/frontend/js/main.js')}}"></script>
  {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

  {{-- <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('719ad0b49c92300764ea', {
      cluster: 'mt1'
    });

    // var channel = pusher.subscribe('my-channel');
    // channel.bind('my-event', function(data) {
    //   app.messages.push(JSON.stringify(data));
    // });

    // Vue application
    // const app = new Vue({
    //   el: '#app',
    //   data: {
    //     messages: [],
    //   },
    // });
  </script> --}}
</body>

</html>