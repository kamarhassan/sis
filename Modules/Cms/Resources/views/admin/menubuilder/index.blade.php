@extends('admin.layouts.master')
@section('title')
@lang('site.menu builder')
@endsection
@section('css')
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }
    </style>

    {{--   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}"> --}}
    {{--   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}"> --}}
    {{--   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/selectize/css/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/selectize/css/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/selectize/css/selectize/selectize.css') }}">
 
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/nestable/jquery.nestable.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/nestable/headermenu.css') }}">



    {{--   <link href="{{asset('public/backend/vendors/nestable/')}}" rel="stylesheet"> --}}
    {{--   <link href="{{asset('public/backend/css/headermenu.css')}}" rel="stylesheet"> --}}
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30">
                            @lang('site.add header menu')
                        </h3>
                    </div>
                    @include('cms::admin.menubuilder.menu_create')

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('site.menu')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="menuList">
                    @include('cms::admin.menubuilder.menu-and-reorder')
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="headermenu_reordering_url" value="{{ route('cms.headermenu.reordering') }}">
    <input type="hidden" id="headermenu_delete_url" value="{{ route('cms.headermenu.delete') }}">
    <input type="hidden" id="headermenu_edit_url" value="{{ route('cms.headermenu.edit-element') }}">
    <input type="hidden" id="headermenu_add_url" value="{{ route('cms.headermenu.add-element') }}">
    <input type="hidden" id="header_token" value="{{ csrf_token() }}">
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
    <script src="{{ URL::asset('cms/assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/custome_js/save_and_redirect.js') }}"></script>


    <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/select/form-selectize.js') }}"></script>
    {{-- <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/select/form-selectize.min.js') }}"></script> --}}

    <script src="{{ URL::asset('Modules/Cms/assets/sweetalert/sweetalert.js') }}"></script>


    <script src="{{ URL::asset('Modules/Cms/assets/nestable/jquery.nestable.min.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/nestable/headermenu.js') }}"></script>
@endsection
