@extends('admin.layouts.master')
@section('title')
    @lang('site.attendance students')
@endsection
@section('css')
@endsection
@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form"></h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                            </ul> 
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="attendance" class="table table-hover">
                                <thead>

                                    <tr class="width-200">
                                        <th class="m-sm-1">#</th>
                                        <th class="m-sm-1">@lang('site.cours') </th>
                                        <th class="m-sm-1">@lang('site.status') </th>
                                        <th class="m-sm-1">@lang('site.actually start date') </th>
                                        <th class="m-sm-1">@lang('site.actually end date') </th>
                                        {{-- <th class="m-sm-1">@lang('site.actua"lly end date') </th>
                                        <th class="m-sm-1">@lang('site.end t"ime') </th> --}}
                                        <th class="m-sm-1">@lang('site.std count') </th>
                                        <th class="m-sm-1">@lang('site.take attendance') </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($cours)
                                        @foreach ($cours as $key => $cour)
                                            <tr id="Row{{ $cour['id'] }} " class="hover-success">
                                                <td onclick='test();'> {{ $cour['id'] }}</td>
                                                <td>{{ $cour['category_grade_level']['grade']['grade'] }} # {{ $cour['category_grade_level']['level']['level'] }}</td>
                                                {{-- <td>{{ $cour['teacher_name'] }} </td> --}}
                                                <td> {{ $cour['status'] }} </td>
                                                <td> {{ $cour['act_StartDa'] }} </td>
                                                <td> {{ $cour['act_EndDa'] }} </td>
                                                {{-- <td> {{ $cour['startTime'] }} </td>
                                                <td> {{ $cour['endTime'] }} </td> --}}
                                                <td> {{ $cour['count_std'] }} </td>
                                                <td>
                                                    <div class="row">
{{-- {{dd($is_teacher)}} --}}
                                                        @php

                                                            if ($is_teacher == false) {                                                       $attendance_route = route('admin.enable.disable.take.attendance', $cour['id']);
                                                                $marks_route = route('admin.marks.report.and.action', Crypt::encryptString($cour['id']));
                                                                $report_marks_route = '#';
                                                            } else {
                                                                $attendance_route = route('admin.attendance.general.info', $cour['id']);
                                                                $marks_route = route('admin.get.students.to.add.marks', Crypt::encryptString($cour['id']));
                                                                $report_marks_route = route('admin.get.report.students.to.add.marks', Crypt::encryptString($cour['id']));
                                                            }
                                                            
                                                            $generate_certfifcate = route('admin.generate.certificate.with.barcode',Crypt::encryptString($cour['id']));
                                                        @endphp


                                                        <a type="button" class="btn btn-outline-success " data-toggle="modal"
                                                            data-target="#modal-center-{{ $cour['id'] }}">
                                                            {{-- <i class="fa fa-plus-circle"></i> --}}
                                                            @lang('site.options')
                                                        </a>



                                                        <div class="modal   fade" data-backdrop="false"
                                                            id="modal-center-{{ $cour['id'] }}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">@lang('site.choose as you want')</h5>
                                                                        <a type="button" class="close" data-dismiss="modal">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">


                                                                            @can('teacher')
                                                                                <a href="{{ $marks_route }}"
                                                                                    class="btn fa fa-plus-circle"
                                                                                    title="@lang('site.add students marks')">
                                                                                    @lang('site.add students marks')
                                                                                </a>
                                                                                <a href="{{ $report_marks_route }}"
                                                                                class="btn fa fa-plus-circle"
                                                                                title="@lang('site.report students marks')">
                                                                                @lang('site.report students marks')
                                                                            </a>

                                                                            @endcan

                                                                            @can('generate certificate')
                                                                                <a href="{{ $generate_certfifcate }}"
                                                                                    class="btn mdi mdi-certificate"
                                                                                    title="@lang('site.generate certficate')">
                                                                                    @lang('site.generate certficate')
                                                                                </a>
                                                                            @endcan

                                                                            <a @can('enable or disable') href="{{ $attendance_route }}" @endcan
                                                                                @can('attendance students') href="{{ $attendance_route }}" @endcan
                                                                                class="btn text-warning fa fa-pencil-square  hover-primary"
                                                                                title="@lang('site.take attendance')">
                                                                                @lang('site.take attendance')
                                                                            </a>
                                                                            @can('report attendance')
                                                                                <a href="{{ route('admin.report.attendance', $cour['id']) }}"
                                                                                    class="btn text-warning fa fa-print hover-report   hover-primary"
                                                                                    title="@lang('site.attendance students')">
                                                                                    @lang('site.attendance students')"
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer modal-footer-uniform">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>








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
            </div>
        </div>
    </section>
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
                //  responsive: true,
                // scrollCollapse: true,
                paging: false,
                // ajax: '/test/0',

            });
        });
    </script>
@endsection
