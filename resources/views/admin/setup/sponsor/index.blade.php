@extends('admin.layouts.master')
@section('title')
@lang('site.sponsor')
@endsection
@section('css')
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }
    </style>
@endsection

{{-- 'edit sponsore'
'delete sponsore' --}}

@section('content')
@can ('add sponsor') 
    
        @include('admin.setup.sponsor.add-sponsor')
        
@endcan
@canany(['edit sponsor','delete sponsor'])
    
@include('admin.setup.sponsor.sponsor-data')
@endcan

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>@lang('site.sponsor type') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" id="sponsor_type_number" name="sponsor_type[]" class="form-control">
                                <span class="text-danger" id="sponsor_type_number_error"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>@lang('site.sponsor name') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" id="sponsor_name_number" name="sponsor_name[]" class="form-control">
                                <span class="text-danger" id="sponsor_name_number_error"> </span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <h5>@lang('site.is active') <span class="text-danger"></span></h5>
                        <div class="form-group">
                            <div class="box-controls pull-left">
                                <label class="switch switch-border switch-success">
                                    <input type="checkbox" id="sponsor_active" value="1"
                                        name="sponsor_active[]" id="active" checked />
                                    <span class="switch-indicator"></span>
                                    <label for="switcheryColor4" class="card-title ml-1">@lang('site.is active')
                                    </label>
                                    <span class="text-danger" id="sponsor_active_number_error"> </span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>@lang('site.sponsor limit budget') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" id="sponsor_limit_number" name="sponsor_limit[]" class="form-control">
                                <span class="text-danger" id="sponsor_limit_number_error"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>@lang('site.sponsor limit students') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text"  name="sponsor_students_limit[]"
                                    class="form-control">
                                <span class="text-danger" id="sponsor_students_limit_number_error"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>@lang('site.sponsor default %') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text"  name="sponsor_default_percent[]"
                                    class="form-control">
                                <span class="text-danger" id="sponsor_default_percent_number_error"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->
                </div><!-- End col-md-5 -->
            </div>
        </div>
    </div>
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
    <script>
        $(document).ready(function() {


            var counter = 1;
            $(document).on("click", ".addeventmore", function() {
                // alert(counter);
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);

                $("#sponsor_type_number").attr("id", "sponsor_type_" + counter);
                $("#sponsor_type_number_error").attr("id", "sponsor_type_" + counter + "_");
           
                $("#sponsor_name_number").attr("id", "sponsor_name_" + counter);
                $("#sponsor_name_number_error").attr("id", "sponsor_name_" + counter + "_");

                $("#sponsor_limit_number").attr("id", "sponsor_limit_" + counter);
                $("#sponsor_limit_number_error").attr("id", "sponsor_limit_" + counter + "_");

                $("#sponsor_students_limit_number").attr("id", "sponsor_students_limit_" + counter);
                $("#sponsor_students_limit_number_error").attr("id", "sponsor_students_limit_" + counter +
                    "_");

                $("#sponsor_default_percent_number").attr("id", "sponsor_default_percent_" + counter);
                $("#sponsor_default_percent_number_error").attr("id", "sponsor_default_percent_" + counter + "_");


                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });






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
    <script src="{{ URL::asset('assets\custome_js\delete.js') }}"></script>
    <script src="{{ URL::asset('assets\custome_js\save_and_redirect.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script> --}}
@endsection
