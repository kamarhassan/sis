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
    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/custome_style.css') }}">



    @yield('css')



    @toastr_css()


</head>


<body id="body_master"
    class="hold-transition 
    
   {{ Session::get('mode') }}
      {{-- light-skin --}}
           {{-- dark-skin  --}}
         sidebar-mini theme-primary fixed @if (get_Default_language() == 'ar') rtl @endif">




    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.navbar_container')

        <div class="content-wrapper">
            <div class="container-full">
                <section class="content">
                    @include('admin.layouts.spinner-loader.spinner')

                    <div id="content" hidden>

                        @yield('content')
                    </div>

                    @include('admin.layouts.spinner-loader.loader')
                </section>

            </div>

        </div>
        {{-- @include('admin.layouts.asside') --}}
    </div>

    <script src="{{ URL::asset('assets/app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/toastr/toastr.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/sweetalert2/sweetalert.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ URL::asset('assets/custome_js/open_new_tab.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/genralfunction.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}">
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/notification.js') }}"></script>

    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/template.js') }}"></script>

    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function() {
            $('#spinner_loading').css("display", "none");

            $('#content').removeAttr('hidden');
            // console.log( "ready!" );
            // console.clear();
        });

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('719ad0b49c92300764ea', {
        //     cluster: 'mt1'
        // });

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
    @yield('script')

</body>

</html>
