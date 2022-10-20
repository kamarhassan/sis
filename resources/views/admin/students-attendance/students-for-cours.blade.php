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
            <div class="row">
                <div class="col-md-6">
                    <label>@lang('site.date') </label>
                    <form id="attendance_form">
                        @csrf
                        <input type="hidden" name="techear_id" id="" value="{{ $teacher_id }}">
                        <input type="hidden" name="cours_id" id="" value="{{ $cours->id }}">
                        <input type="hidden" name="min_date" id="" value="{{ $cours->act_StartDa }}">
                        <input type="hidden" name="max_date" id="" value="{{ $cours->act_EndDa }}">
                        <div class="form-group">
                            <input name="attendance_date" class="form-control" type="date" id="attendance_date"
                                onchange="get_students_by_date('{{ route('admin.take.students.for.cours') }}','attendance_form');"
                                min="{{ $cours->act_StartDa }}" max="{{ $cours->act_EndDa }}">
                            <span class="text-danger" id="attendance_date_new_or_update_"></span>
                            <span class="text-danger" id="attendance_date_"></span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <label>@lang('site.nb of hours total for cours') </label>
                    <div class="form-group">
                        <input name="total_hours" class="form-control" type="number" id="total_hours">
                    </div>
                <span id="total_hours_details_" class="text-danger"></span>
                </div>
            </div>



        </div>
        <div class="box" id="spinner_loading" hidden>
            <div class="d-flex justify-content-center text-primary">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="box" id="data_attendance_box" hidden>
        <form id="update_or_new_attendance">
            @csrf
            <input type="hidden" name="techear_id" id="" value="{{ $teacher_id }}">
            <input type="hidden" name="cours_id" id="" value="{{ $cours->id }}">
            <input type="hidden" name="attendance_date_new_or_update" id="attendance_date_new_or_update" value="">
            <input type="hidden" name="total_hours_details" id="total_hours_details" value="">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="data_attendance" class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('site.cours')</th>
                                <th>@lang('site.take attendance')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <div id="btn_submit">
                                <a onclick="submit('{{ route('admin.create.or.update.attendance') }}','update_or_new_attendance')"
                                    class="btn text-success fa fa-pencil hover  hover-primary">
                                    <span>@lang('site.save')</span></a>

                            </div>
                        </tfoot>
                    </table>
                </div>
            </div>

        </form>
    </div>
    </div>
@endsection


@section('script')
    <script>
        // $(document).ready(function() {
        //     // $('#spinner_loading').css("display", "none");

        //     // $('#attendance').removeAttr('hidden');
        //     var table = $('#attendance').DataTable({
        //         // order: [
        //         //     [0, 'desc']
        //         // ],
        //         "ordering": false,
        //         "info": false,
        //          
        //         paging: false,

        //     });
        // });
    </script>
    <script src="{{ URL::asset('assets/custome_js/attendance.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
