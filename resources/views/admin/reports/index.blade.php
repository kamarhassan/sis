@extends('admin.layouts.master')
@section('title')
    @lang('site.reports')
@endsection
@section('css')
@endsection
@section('content')
    <div>



        <div class="col-md-12 col-12">
            <div class="box">
                <div class="box-header with-border">
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
                    <ul class="box-controls pull-right">
                        {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                        <li><a class="box-btn-slide text-white" href="#"></a></li>
                        {{-- <li><a class="box-btn-fullscreen" href="#"></a></li> --}}
                    </ul>
                </div>

                <div class="box-body col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="btn  glyphicon glyphicon-print hover-report text-report" title=""
                                type="submit" onclick="get_report('{{ route('admin.daily.report') }}');"> <span>
                                    @lang('site.daily reports')</span>
                            </a>

                        </div>

                        <div class="col-md-4">
                            <a class="btn  glyphicon glyphicon-print hover-report text-report" title=""
                                type="submit" onclick="get_report('{{ route('admin.service.by.type.report') }}');">
                                <span> @lang('site.Receipt Report Service Sold By Type')</span>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a class="btn  glyphicon glyphicon-print hover-report text-report" title=""
                                type="submit" onclick="get_report('{{ route('admin.unpaid.account.summary.report') }}');">
                                <span>
                                    @lang('site.Receipt Report unpaid accounting summary')</span>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a class="btn  glyphicon glyphicon-print hover-report text-report" title=""
                                type="submit" onclick="get_report('{{ route('admin.unpaid.account.details.report') }}');">
                                <span>
                                    @lang('site.Receipt Report unpaid account details')</span>
                            </a>

                        </div>

                         <div class="col-md-4">
                            <a class="btn  glyphicon glyphicon-print hover-report text-report" title=""
                                type="submit" onclick="get_report('{{ route('admin.cours.account.summary.report') }}');"> <span>
                                    @lang('site.Receipt Report course accounting summary')</span>
                            </a>

                        </div>

                       <div class="col-md-4">
                            <a class="btn  glyphicon glyphicon-print hover-report text-report" title=""
                                type="submit"  onclick="get_report('{{ route('admin.cours.account.details.report') }}');"> <span>
                                    @lang('site.Receipt Report cours accounting details')</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row-fluid" id='data-report' hidden>
            @include('admin.reports.report-table')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/custome_js/reports.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/data-table-responsive/datatable-responsive.js') }}"></script>
@endsection
