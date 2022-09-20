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
                            <p class="text-black-50">Register a new membership</p>
                        </div>
                        <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-black"><i
                                                    class="ti-user"></i></span>
                                        </div>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" autocomplete="name"  placeholder="@lang('site.lang name')" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-black"><i
                                                    class="ti-user"></i></span>
                                        </div>
                                        <input id="midname" type="text"
                                            class="form-control @error('midname') is-invalid @enderror" name="midname" placeholder="@lang('site.Middle Name')"
                                            value="{{ old('midname') }}" autocomplete="midname" autofocus>

                                        @error('midname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-black"><i
                                                    class="ti-user"></i></span>
                                        </div>
                                        <input id="lastname" type="text" placeholder="@lang('site.Last Name')"
                                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{ old('lastname') }}" autocomplete="name" autofocus>

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-black"><i
                                                    class="ti-email"></i></span>
                                        </div>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email" placeholder="@lang('site.E-mail')"
                                            value="{{ old('email') }}" autocomplete="email">

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
                                            <span class="input-group-text bg-transparent text-black"><i
                                                    class="ti-lock"></i></span>
                                        </div>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('site.password')"
                                            autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-black"><i
                                                    class="ti-lock"></i></span>
                                        </div>
                                        <input id="password-confirm" type="password" class="form-control" placeholder="@lang('site.retype password')"
                                            name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row">

                                    {{-- <div class="col-12">
                                  <div class="checkbox text-black">
                                    <input type="checkbox" id="basic_checkbox_1" >
                                    <label for="basic_checkbox_1">I agree to the <a href="#" class="text-warning"><b>Terms</b></a></label>
                                  </div>
                                </div> --}}
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info btn-rounded margin-top-10">
                                            {{ __('Register') }}</button>

                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

                            {{-- <div class="text-center text-black">
                          <p class="mt-20">- Register With -</p>
                          <p class="gap-items-2 mb-20">
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-facebook"></i></a>
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-twitter"></i></a>
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-google-plus"></i></a>
                              <a class="btn btn-social-icon btn-round btn-outline btn-black" href="#"><i class="fa fa-instagram"></i></a>
                            </p>	
                        </div> --}}

                            <div class="text-center">
                                <p class="mt-15 mb-0 text-black">Already have an account?<a href="{{ route('login') }}"
                                        class="text-danger ml-5"> Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
