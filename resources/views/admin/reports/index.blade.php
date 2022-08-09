@extends('admin.layouts.master')
@section('title')
    @lang('site.reports')
@endsection
@section('css')
@endsection
@section('content')
    <form id="report">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('site.start date') </label>
                    <input name="start_date" class="form-control" type="date" id="example-date-input">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('site.end date') </label>
                    <input name="end_date" class="form-control" type="date" id="example-date-input">

                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


    </form>
    <a class="btn  glyphicon glyphicon-arrow-left hover-success text-warning-light" title="@lang('site.save')"
        type="submit" onclick="get_report('{{ route('admin.daily.report') }}');"> <span> @lang('site.daily reports')</span>
    </a>
    <a class="btn  glyphicon glyphicon-arrow-left hover-success text-warning-light" title="@lang('site.save')"
        type="submit" onclick="get_report('{{ route('admin.distrubtion.report') }}');"> <span> @lang('site.distrubtion')</span>
    </a>
    <div class="row-fluid" id='data-report' hidden>
        @include('admin.reports.report-table')
    </div>
@endsection

@section('script')



<script src="{{ URL::asset('assets/custome_js/reports.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/data-table-responsive/datatable-responsive.js') }}"></script>
@endsection
