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



    <style>
           .pulse {
            position: absolute;
            top: -10px;
            right: -9px;
            height: 20px;
            width: 20px;
            z-index: 10;
            font-size: medium;
            font-weight: bold; 
            color: rgb(255, 255, 255);
            border: rgb(255, 255, 255);
            border-radius: 70px;
            /* animation: pulse 1s ease-out infinite; */
        }

    
        /* .pulse {
            position: absolute;
            top: -10px;
            right: -9px;
            height: 20px;
            width: 20px;
            z-index: 10;
            border: 5px solid #fbff00;
            border-radius: 70px;
            animation: pulse 1s ease-out infinite;
        } */

        .marker {
            position: absolute;
            top: -0px;
            right: 10px;
            height: 20px;
            width: 20px;
            border-radius: 70px;
            background: rgb(255, 0, 0);
        }


        /* @keyframes pulse {
            0% {
                -webkit-transform: scale(0);
                opacity: 0.0;
            }

            25% {
                -webkit-transform: scale(0.1);
                opacity: 0.1;
            }

            50% {
                -webkit-transform: scale(0.5);
                opacity: 0.3;
            }

            75% {
                -webkit-transform: scale(0.8);
                opacity: 0.5;
            }

            100% {
                -webkit-transform: scale(1);
                opacity: 0.0;
            }
        } */
    </style>
</head>
{{-- {{   get_Default_language() }} --}}

{{-- @if (get_Default_language() == 'ar') --}}

<body id="body_master"
    class="hold-transition
        @if (Session::has('mode')) {{ Session::get('mode') . '-skin' }}
        @else
        dark-skin @endif
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
                    @yield('content')
                    {{-- @include('admin.layouts.footer'); --}}
                </section>
            </div>

        </div>
        {{-- @include('admin.layouts.asside') --}}
    </div>

    <script src="{{ URL::asset('assets/app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/template.js') }}"></script>
    {{-- <script src="{{URL::asset('assets/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script> --}}
    {{-- <script src="{{URL::asset('assets/assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script> --}}
    {{-- <script src="{{URL::asset('assets/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script> --}}
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
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
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
    {{-- @jquery --}}
    @toastr_js
    @toastr_render

    @method('scripts')
    <script>
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
    </script>
</body>

</html>
