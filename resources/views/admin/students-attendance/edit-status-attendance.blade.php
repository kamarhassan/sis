@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }
    </style>
@endsection


@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="box">
                <div class="d-flex justify-content-center text-primary">
                    <div class="col-md-3">
                        <span>@lang('site.total hours attendance')</span>
                    </div>
                    <div class="col-md-3">
                        <span>{{ $total_attendance_hours }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="d-flex justify-content-center text-primary">
                    <div class="row">
                        <form id="attendance_reset_enable_disable_all">
                            @csrf
                            <input type="hidden" name="cours_id" id="cours_id" value="{{ $cours_id }}">
                            <a class="btn glyphicon glyphicon-refresh hover-danger" title="@lang('site.reset')"
                                onclick="reset_attendance_all('{{ route('admin.reset.all.status.attendance', $cours_id) }}','attendance_reset_enable_disable_all','{{ json_encode(attendance_swal_fire_msg()) }}')">
                                reset                                all
                            </a><a class="btn glyphicon glyphicon-refresh hover-danger" title="@lang('site.reset')"
                                onclick=" change_status_all('{{ route('admin.enable.all.status.attendance', $cours_id) }}','attendance_reset_enable_disable_all');">
                                enable all
                            </a>
                            <a class="btn glyphicon glyphicon-refresh hover-danger" title="@lang('site.reset')"
                                onclick=" change_status_all('{{ route('admin.disable.all.status.attendance', $cours_id) }}','attendance_reset_enable_disable_all');">
                                disable all
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="box" id="spinner_loading">
        <div class="d-flex justify-content-center text-primary">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <div class="box" id="admin_table" hidden>

        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">

            <div class="table-responsive">
                <table id="example1" class="table table-hover">
                    <thead>

                        <tr>
                            <th>@lang('site.date')</th>
                            <th>@lang('site.days')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.attendance hour')</th>
                            <th>@lang('site.options')</th>
                            {{--  <th>@lang('site.nbumber of cours')</th>
                            <th>@lang('site.students photo')</th> --}}
                        </tr>

                    </thead>
                    <tbody>
                        @isset($data)
                            @foreach ($data as $datas)
                                <tr class="bg-light mb-10 p-10 cursor_pointer hover-success">
                                    <td>{{ $datas['date'] }}</td>
                                    <td>{{ $datas['day'] }}</td>
                                    <td>
                                        @if ($datas['status'] == 1)
                                            <span style="color:darkturquoise">@lang('site.is active')</span>
                                        @else
                                            <span class="text-danger">@lang('site.is not active')</span>
                                        @endif
                                    </td>
                                    <td><span id="attendance_hours_{{ $datas['date'] }}">
                                            {{ $datas['attendance_hours'] }}</span></td>
                                    {{-- <td>{{$datas['']}}</td> --}}

                                    <td>
                                        <div class="row">

                                            <form id="attendance_{{ $datas['cours_id'] }}">
                                                @csrf
                                                <input type="hidden" name="cours_id" id="cours_id"
                                                    value="{{ $datas['cours_id'] }}">
                                                <input type="hidden" name="date" id="date"
                                                    value="{{ $datas['date'] }}">

                                                <a class="btn glyphicon glyphicon-refresh hover-danger"
                                                    title="@lang('site.reset')"
                                                    onclick="reset_attendance('{{ route('admin.reset.old.attendance', [$datas['cours_id'], $datas['date']]) }}','{{ 'attendance_' . $datas['cours_id'] }}','{{ json_encode(attendance_swal_fire_msg()) }}');">
                                                </a>

                                                <div class="box-controls pull-left">
                                                    <label class="switch switch-border switch-success">
                                                        <input type="checkbox" value="1" name="active" id="active"
                                                            onchange="change_status('{{ route('admin.edit.status.attendance', [$datas['cours_id'], $datas['date']]) }}','{{ 'attendance_' . $datas['cours_id'] }}');"
                                                            @if ($datas['status'] == 1) checked @endif />
                                                        <span class="switch-indicator"></span>
                                                        <label for="switcheryColor4" class="card-title ml-1">

                                                        </label>
                                                        <span class="text-danger" id="active_"> </span>
                                                </div>
                                        </div>

                                        </form>
                </div>
                </td>
                </tr>
                @endforeach
            @endisset

            </tbody>
            </table>
        </div>
    </div>




    </div>
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
    <script>
        $(document).ready(function() {
            $('#spinner_loading').css("display", "none");

            $('#admin_table').removeAttr('hidden');

            var table = $('#example1').DataTable({
                scrollY: "400px",
                // searching: false,
                // scrollX: true,
                scrollCollapse: true,
                paging: false,
                info: false,
                responsive: true,
                // ajax: '/test/0',

            });
        });
    </script>
    <script src="{{ URL::asset('assets/custome_js/attendance.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script> --}}
@endsection
