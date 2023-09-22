<!DOCTYPE html>
<html id="mode" class="loading dark" lang="{{ LaravelLocalization::getCurrentLocaleNative() }}"
    data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ logo() }}">

    <title>@yield('title')</title>


    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/vendors_css.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/app-assets/css/custome_style.css') }}">

 
    <style>
     
    </style>
    @yield('css')



    @toastr_css()

   
</head>


<body id="body_master"
    class="hold-transition 
   
      light-skin
           {{-- dark-skin  --}}
         sidebar-mini theme-primary fixed ">




    <div class="wrapper">
        @include('frontend.layouts.User.header')
        @include('frontend.layouts.User.nav-bar')
       

        <div class="content-wrapper">
            <div class="container-full">
                <section class="content"   >  

                    <div id="content" >
                  
                        @yield('content')
                     </div>
                     
                     
                </section>

            </div>

        </div>
        {{-- @include('admin.layouts.asside') --}}
    </div>

    <script src="{{ URL::asset('assets/app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ URL::asset('assets/custome_js/open_new_tab.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/chanethememode.js') }}"></script>

    {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
    <script src="{{ URL::asset('assets/app-assets/js/template.js') }}"></script>

    <script src="{{ URL::asset('assets/app-assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ URL::asset('assets/assets/sweetalert2/sweetalert.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/toastr/toastr.js') }}"></script>

    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function() {
            $('#spinner_loading').css("display", "none");

            $('#content').removeAttr('hidden');
            // console.log( "ready!" );
            // console.clear();
        });
     
    </script>
    @yield('script')
</body>

</html>
