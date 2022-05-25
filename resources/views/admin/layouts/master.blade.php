<!DOCTYPE html>
<html id="mode" class="loading dark" lang="{{ LaravelLocalization::getCurrentLocaleNative() }}"
    data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <title>@yield('title')</title>


    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/vendors_css.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/skin_color.css') }}">

    @yield('css')



    @toastr_css()

</head>
{{-- {{   get_Default_language() }} --}}

{{-- @if (get_Default_language() == 'ar') --}}

    <body id="body_master"
        class="hold-transition
        @if (Session::has('mode'))
         {{ Session::get('mode') . '-skin' }}
        @else
        dark-skin
        @endif
         sidebar-mini theme-primary fixed @if (get_Default_language() == 'ar') rtl @endif">
    {{-- @else

        <body id="body_master"
            class="hold-transition  {{ Session::get('mode') . '-skin' }} sidebar-mini theme-primary fixed "> --}}
{{-- @endif --}}



<div class="wrapper">
    @include('admin.layouts.header')
    @include('admin.layouts.navbar_container')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                @yield('content') {{-- @include('admin.layouts.footer'); --}}
            </section>
        </div>

    </div>
    @include('admin.layouts.asside')
</div>

<script src="{{ URL::asset('assets/app-assets/js/vendors.min.js') }}"></script>
<script src="{{ URL::asset('assets/assets/icons/feather-icons/feather.min.js') }}"></script>
{{-- <script src="{{URL::asset('assets/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script> --}}
{{-- <script src="{{URL::asset('assets/assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script> --}}
{{-- <script src="{{URL::asset('assets/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script> --}}
<script src="{{ URL::asset('assets/app-assets/js/template.js') }}"></script>
<script src="{{ URL::asset('assets/app-assets/js/pages/dashboard.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
</script>
{{-- C:\xampp\htdocs\sis/assets/app-assets/js/jquery-3.6.0.min.js --}}
<script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ URL::asset('assets/custome_js/open_new_tab.js') }}"></script>


<script src="{{ URL::asset('assets/custome_js/chanethememode.js') }}"></script>
@yield('script')

{{-- @jquery --}}
@toastr_js
@toastr_render

@method('scripts')
</body>

</html>
