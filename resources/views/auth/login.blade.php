@extends('frontend.layouts.master')
@section('title')

@endsection
@section('css')
@endsection

@section('content')
<div class="container">
   
    <div class="row align-items-center justify-content-md-center h-p100">	
			
        <div class="col-12">
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="content-top-agile p-10">
                        <h2 class="text-black">Get started with Us</h2>
                        <p class="text-black-50">Sign in to start your session</p>							
                    </div>
                    <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent text-black"><i class="ti-user"></i></span>
                                    </div>
                                    {{-- <input type="text" class="form-control pl-15 bg-transparent text-black plc-black" placeholder="Username"> --}}
                                
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="@lang('site.E-mail')" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text  bg-transparent text-black"><i class="ti-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('site.password')" autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>
                            </div>
                              <div class="row">
                                <div class="col-6">
                                  <div class="checkbox text-black">
                                 
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                  </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                 <div class="fog-pwd text-right">
                                    @if (Route::has('password.request'))
                                    <a class="text-black hover-info" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                   
                                  </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                                             
                                  <button type="submit" class="btn btn-info btn-rounded mt-10">
                                    {{ __('Login') }}
                                </button>

                                
                                </div>
                                <!-- /.col -->
                              </div>
                        </form>														

                        <div class="text-center text-black">
                          {{-- <p class="mt-20">- Sign With -</p>
                          <p class="gap-items-2 mb-20">
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-facebook"></i></a>
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-twitter"></i></a>
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-google-plus"></i></a>
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-instagram"></i></a>
                            </p>	
                        </div> --}}
                        
                        <div class="text-center">
                            <p class="mt-15 mb-0 text-black">Don't have an account? <a href="{{ route('register') }}" class="text-info ml-5">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
@section('script')

@endsection