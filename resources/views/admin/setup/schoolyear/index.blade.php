@extends('admin.layouts.master')
@section('title')
    @lang('site.school year')
@endsection
@section('css')
@endsection


@section('content')

    @can('add school year')
        <div class="box">
            <form id="schoolyear">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('site.start date') </label>
                            <input name="start_date" class="form-control" type="date" id="start_date"
                                onchange="Set_Month_ToEndDate('start_date', 'end_date');setschoolyear('finally_school_year','start_date', 'end_date');">
                            <span class="text-danger" id="start_date_"> </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('site.end date') </label>
                            <input name="end_date" class="form-control" type="date" id="end_date">
                            <span class="text-danger" id="end_date_"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('site.school year')</label><br>

                            <span class="text-danger" id="finally_school_year"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group"><br>
                            <a onclick="submit('{{ route('admin.schoolyear.save.edit') }}','schoolyear') "
                                class="btn btn-primary" value="@lang('site.save')">
                                @lang('site.save')
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    @endcan
    <div class="box" id="table_std">
        <div class="box-body">
            <div class="table-responsive ">
                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.school year')</th>
                            <th>@lang('site.school year start')</th>
                            <th>@lang('site.school year end')</th>
                            <th>@lang('site.current school year')</th>
                            <th>@lang('site.options')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($years)
                            @foreach ($years as $year)
                                <tr id="Row{{ $year->id }}" class=" mb-10 p-10 cursor_pointer hover-success">

                                    <td>{{ $year['id'] }}</td>
                                    <td>{{ $year['year'] }}</td>
                                    <td>{{ $year['start'] }}</td>
                                    <td>{{ $year['end'] }}</td>
                                    <td>

                                        @if ($year['currentyear'] != 0 || is_null($year['currentyear'])) 
                                            <form action="" id="changecurrentyear{{ $year['id'] }}">

                                                @csrf

                                                <input type="hidden" name="year" value="{{ $year['id'] }}">
                                                <div class="form-group">
                                                    <div class="box-controls pull-left">
                                                        <label
                                                            class="switch switch-border switch-success">
                                                            @lang('site.current school year')
                                                            <input type="checkbox" value="1" name="admin_status"
                                                                id="active{{ $year['id'] }}"
                                                                onchange="chnage_school_years('{{ route('admin.schoolyear.change.current.school.years') }}' ,'changecurrentyear{{ $year['id'] }}','{{ json_encode(swal_fire_msg_school_years()) }}');"
                                                                @if ($year['currentyear'] == 1) checked   @endif />
                                                            <span class="switch-indicator"></span>
                                                            <label for="switcheryColor4"
                                                                class="card-title ml-1">@lang('site.is not last year')</label>

                                                            <span class="text-danger" id="active_{{ $year['id'] }}"> </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif


                                    </td>

                                    <td>
                                        @can('edit school year')
                                            <a type="button" class="btn fa fa-edit" id="getschoolyear"
                                                onclick="getschoolyear('{{ route('admin.schoolyear.get.to.edit', $year['id']) }}');"
                                                title="@lang('site.edit')">

                                            </a>
                                        @endcan

                                        @can('delete school year')
                                            <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash hover-danger"
                                                title="@lang('site.delete')"
                                                onclick="delete_by_id('{{ route('admin.schoolyear.delete') }}',{{ $year->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                            </a>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                    </tbody>
                </table>
            </div>
        </div>


    </div>




    @can('edit school year')
        <div class="modal center-modal fade" id="modal-center" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <a type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">

                        <div class="box">
                            <form id="schoolyear_edit">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="schoolyearid" id="schoolyearid">
                                            <label>@lang('site.start date') </label>
                                            <input name="start_date" class="form-control" type="date" id="start_date_edit"
                                                onchange="Set_Month_ToEndDate('start_date_edit', 'end_date_edit');setschoolyear('finally_school_year_edit','start_date_edit', 'end_date_edit');">
                                            <span class="text-danger" id="start_date_"> </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.end date') </label>
                                            <input name="end_date" class="form-control" type="date" id="end_date_edit">
                                            <span class="text-danger" id="end_date_"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>@lang('site.shool year')</label><br>

                                            <span class="text-danger" id="finally_school_year_edit"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"><br>
                                            <a onclick="submit('{{ route('admin.schoolyear.save.edit') }}','schoolyear_edit') "
                                                class="btn btn-primary" value="@lang('site.save')">
                                                @lang('site.save')
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>






                    </div>
                    {{-- <div class="modal-footer modal-footer-uniform">
                        <a type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</a>
                        <a type="button" class="btn btn-rounded btn-primary float-right">Save changes</a>
                    </div> --}}
                </div>
            </div>
        </div>
    @endcan


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                scrollY: "400px",
                scrollCollapse: true,
                paging: false,
                responsive: true,

            });
        });
    </script>

    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/genralfunction.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>



    <script></script>
@endsection
