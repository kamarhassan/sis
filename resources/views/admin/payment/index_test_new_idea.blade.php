@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            {{-- <h3 class="box-title">Individual column searching</h3> --}}
        </div>
        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-hover">
                    <thead>

                        <tr>
                            <th>@lang('site.options')</th>
                            <th>@lang('site.student name')</th>
                            <th>@lang('site.id')</th>
                            <th>@lang('site.registration date')</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($std_registartion as  $students_info)
                        {{-- {{dd($students_info)}} --}}
                            <tr>
                                <td>
                                    <ul>
                                        <li class="list-unstyled">
                                            <a onclick="get_cours_of_std({{ $students_info['user_id'] }},'{{route('admin.students.get_cours_std', $students_info['user_id'])}}','{{ csrf_token() }}');"  class="btn fa fa-credit-card hover-warning text-light"
                                                title="@lang('site.save')"> @lang('site.pay')</a>
                                            </li>

                                    </ul>
                                    {{-- <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light"
                                        title="@lang('site.save')"></a>
                                    <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light"
                                        title="@lang('site.save')"></a> --}}

                                </td>
                                {{-- <td>{{ $students_info->student[0]->name }}</td> --}}
                                <td>{{ $students_info['student'][0]['name'] }}</td>
                                <td>{{ $students_info['user_id'] }}</td>
                                <td>{{ $students_info['created_at']->format('d/m/Y') }}</td>


                                {{-- <td>{{ $students_info->user_id }}</td>
                                <td>{{ $students_info->created_at->format('d/m/Y') }}</td> --}}
                                {{-- <td>{{ $students_info->cours->grade->grade }} -
                                    {{ $students_info->cours->level->level }} # {{ $students_info->cours->id }}</td> --}}
                                {{-- <td>{{ $students_info->cours_fee_total }}</td>
                                <td>{{ $students_info->remaining }}</td> --}}



                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
        {{-- @endif --}}


        {{-- @if ((new \Jenssegers\Agent\Agent())->isMobile())
            @foreach ($std_registartion as $students_info)
                <div class="box">
                    <div class="box-body">
                        <div class="col-xs-12 col-md-2"><label>@lang('site.options')</label> </div>

                        <div class="col-xs-12 col-md-1"><label>@lang('site.user_id') : </label>
                            <label>{{ $students_info->user_id }}</label>
                        </div>

                        <div class="col-xs-12 col-md-2"><label>@lang('site.student name')</label>
                            <label> {{ $students_info->student[0]->name }}</label>
                        </div>

                        <div class="col-xs-12 col-md-1"><label>@lang('site.start date')</label>
                            <label> {{ $students_info->created_at->format('d/m/Y') }}</label>
                        </div>

                        <div class="col-xs-12 col-md-4"><label>@lang('site.cours')</label>
                            <label> {{ $students_info->cours->grade->grade }} -
                                {{ $students_info->cours->level->level }} # {{ $students_info->cours->id }}</label>
                        </div>

                        <div class="col-xs-12 col-md-1"><label>@lang('site.fee amount')</label>
                            <label>{{ $students_info->cours_fee_total }} </label>
                        </div>

                        <div class="col-xs-12 col-md-1"><label>@lang('site.remaining')</label></div>
                        <label> {{ $students_info->remaining }}</label>
                    </div>
                </div>@endforeach
    </div>

    @endif --}}




        <!-- /.box-header -->




    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                scrollY: "400px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,

            });
        });
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
    <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script>
@endsection
