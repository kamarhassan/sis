@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/switchery.min.css') }}"> --}}
@endsection


@section('content')
    <div class="row">




        <span class="text-danger" id="grade_"> </span>
        <div class="col-md-3 bg-brick-white">
            {{-- certificates --}}
            <form id="searche_certificate_by_barcode">
                @csrf
                <div class="form-group">
                    <label for="">
                        @lang('site.searche barcode')
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent text-black"><span
                                    class="fa fa-barcode"></span></span>
                        </div>
                        <input id="barcode" type="text" class="form-control @error('barcode') is-invalid @enderror"
                            name="barcode" autofocus>

                    </div>
                    <span id="barcode_" class="text-danger"> </span>
                </div>

                {{-- <div class="form-group">
                    <label>@lang('site.cours') <span class="text-danger">*</span> </label>
                    <select name="template" id="template" class="selectize-multiple">
                        <option value="">-------------------------------</option>
                        @foreach ($certificates as $certificate)
                            <option value="{{ $certificate['id'] }}">
                                {{ $certificate['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <span id="template_" class="text-danger"> </span>
                <div class="row">
                    <div class="col-12 text-center">
                        <a onclick="searche_by_barcode('{{ route('web.get.certificate.by.barcode') }}' ,'searche_certificate_by_barcode');"
                            class="btn btn-info btn-rounded margin-top-10">
                            @lang('site.searche')
                        </a>

                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <div id="certificate"></div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/custome_js/front.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script> --}}
@endsection
