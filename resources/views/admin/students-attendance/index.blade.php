@extends('admin.layouts.master')
@section('title')
    @lang('site.attendance students')
@endsection
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="attendance" class="table table-hover">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>@lang('site.cours') </th>
                            {{-- <th>@lang('site.teacher name') </th> --}}
                            <th>@lang('site.status') </th>
                            <th>@lang('site.actually start date') </th>
                            <th>@lang('site.actually end date') </th>
                            <th>@lang('site.actually end date') </th>
                            <th>@lang('site.end time') </th>
                            <th>@lang('site.std count') </th>
                            <th>@lang('site.take attendance') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($cours)
                            @foreach ($cours as $key => $cour)
                                <tr id="Row{{ $cour['id'] }} " class="hover-success">
                                    <td onclick='test();'> {{ $cour['id'] }}</td>
                                    <td>{{ $cour['grade'] }} # {{ $cour['level'] }}</td>
                                    {{-- <td>{{ $cour['teacher_name'] }} </td> --}}
                                    <td> {{ $cour['status'] }} </td>
                                    <td> {{ $cour['act_StartDa'] }} </td>
                                    <td> {{ $cour['act_EndDa'] }} </td>
                                    <td> {{ $cour['startTime'] }} </td>
                                    <td> {{ $cour['endTime'] }} </td>
                                    <td> {{ $cour['count_std'] }} </td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('admin.attendance.general.info', $cour['id']) }}"
                                                class="btn text-warning glyphicon glyphicon-pencil  hover-primary"
                                                title="@lang('site.print')">
                                            </a>
                                            @role('super admin')
                                                <a href="{{ route('admin.report.attendance', $cour['id']) }}"
                                                    class="btn text-warning glyphicon glyphicon-print hover-report   hover-primary"
                                                    title="@lang('site.print')">
                                                </a>
                                            @endrole
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


@section('script')
    <script>
        $(document).ready(function() {
            // $('#spinner_loading').css("display", "none");

            // $('#attendance').removeAttr('hidden');
            var table = $('#attendance').DataTable({
                order: [
                    [0, 'desc']
                ],
                // scrollY: "400px",
                // scrollX: true,
                responsive: true,
                // scrollCollapse: true,
                paging: false,
                // ajax: '/test/0',

            });
        });
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
