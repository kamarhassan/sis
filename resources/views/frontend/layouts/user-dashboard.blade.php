@extends('frontend.layouts.master')
@section('title')
@endsection
@section('user-css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3 bg-white">
            <div class="container d-flex justify-content-center">
                <div class="card p-4">
                    <div class=" image d-flex flex-column justify-content-center align-items-center"> <button
                            class="btn btn-secondary"> <img src="https://i.imgur.com/wvxPV9S.png" height="100"
                                width="100" /></button>
                        <span class="name mt-3">{{ Auth::user()->name }}</span>
                    </div>
                    <div class=" d-flex mt-2"> <a href="{{ route('web.user.cours') }}" class="btn1 ">@lang('site.my cours and classes')</a>
                    </div>
                    <div class=" d-flex mt-2"> <a href="#" class="btn1 ">@lang('site.profile')</a> </div>

               
                    
                </div>
            </div>
        </div>



        <div class="col-md-8">@yield('user-content')</div>
    </div>
@endsection


@section('script')
    @yield('user-script')
@endsection
