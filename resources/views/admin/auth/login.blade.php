<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{URL::asset('assets/images/favicon.ico')}}">

    <title>Sunny Admin - Log in </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{URL::asset('assets/app-assets/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{URL::asset('assets/app-assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/app-assets/css/skin_color.css')}}">

</head>
<body class="hold-transition theme-primary bg-gradient-primary">

<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">

        <div class="col-12">
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="content-top-agile p-10">
                        <h2 class="text-white">Get started with Us</h2>
                        <p class="text-white-50">Sign in to start your session</p>
                    </div>
                    <div>
                    {{-- @include('admin.alerts.error')
                    @include('admin.alerts.success') --}}
                    </div>
                    <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"value="{{ old('email') }}"  autocomplete="email" autofocus >

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password')
                                        is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="{{__('schoolms.Enter Your Password')}}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="checkbox text-white">

                                        <input type="checkbox" id="basic_checkbox_1"   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="basic_checkbox_1">{{__('schoolms.Remember Me')}}</label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="fog-pwd text-right">
                                        {{--                                        <a href="javascript:void(0)" class="text-white hover-info">--}}
                                        {{--                                            <i class="ion ion-locked">--}}
                                        {{--                                                --}}
                                        {{--                                            </i> Forgot pwd?--}}
                                        {{--                                        </a>--}}
                                        {{--                                        <br>--}}
                                        @if (Route::has('password.request'))
                                            <a class="text-white hover-info" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif


                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>


                                </div>
                                <!-- /.col -->
                            </div>
                        </form>


                        {{--                        <div class="text-center text-white">--}}
                        {{--                            <p class="mt-20">- Sign With -</p>--}}
                        {{--                            <p class="gap-items-2 mb-20">--}}
                        {{--                                <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>--}}
                        {{--                                <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>--}}
                        {{--                                <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>--}}
                        {{--                                <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>--}}
                        {{--                            </p>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="text-center">--}}
                        {{--                            <p class="mt-15 mb-0 text-white">Don't have an account? <a href="register.html" class="text-info ml-5">Sign Up</a></p>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Vendor JS -->

<script src="{{URL::asset('assets/app-assets/js/vendors.min.js')  }}"></script>
<script src="{{URL::asset('assets/app-assets/assets/icons/feather-icons/feather.min.js')}}"></script>

</body>
</html>
