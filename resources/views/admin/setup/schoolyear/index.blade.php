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
                            <label>@lang('site.shool year')</label><br>

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
                            <th>@lang('site.start')</th>
                            <th>@lang('site.end')</th>
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
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/genralfunction.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/moment.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script> --}}

    <script>
        function getschoolyear(route_) {
            $.ajax({
                type: 'Get',
                url: route_,

                success: function(data) {
                    // $('#modal-center').replaceWith(data);
                  
                    if (data.status == 'success') {
                        $('#start_date_edit').val(data.schoolyear['start'])
                        $('#end_date_edit').val(data.schoolyear['end'])
                        $('#schoolyearid').val(data.schoolyear['id'])
                        $('#finally_school_year_edit').text(data.schoolyear['year'])

                        $('#modal-center').modal('show');
                    } 
                   

                },
                error: function reject(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        let t = key.replace('.0', '_' + id);
                        $('#' + t + '__').text(val[0]).html;
                    })
                }
            });


            
        }

        function setschoolyear(finally_school_year_id_label,start_date_id,end_date_id) {
            $('#'+finally_school_year_id_label).text($('#'+start_date_id).val().split('-')[0] + ' - ' + $('#'+end_date_id).val().split('-')[
                0]);
        }
    </script>
@endsection
