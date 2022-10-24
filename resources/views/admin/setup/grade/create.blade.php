@extends('admin.layouts.master')

@section('css')
    @livewireStyles()
@endsection

@section('content')
    <div class="col-md-12 col-12">
        @can('create grades')
            <div class="box box-slided-up">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('site.add services')</h4>
                    </div>
                    <ul class="box-controls pull-right">
                        {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                        <li><a class="box-btn-slide text-warning" href="#"></a></li>

                    </ul>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <form id='grades_form'>
                                @csrf
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="grades_0" name="grades[]" class="form-control">
                                                    <span class="text-danger" id="grades_0_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>@lang('site.nb of hours total for cours') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="total_hours_0" name="total_hours[]"
                                                        class="form-control">
                                                    <span class="text-danger" id="total_hours_0_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h5>@lang('site.duration') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="period_by_mounth_0" name="period_by_mounth[]"
                                                        class="form-control">
                                                    <span class="text-danger" id="period_by_mounth_0_"> </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <div class="row">
                                <div class="text-xs-right">
                                    <a class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                                        onclick="submit('{{ route('admin.grades.store') }}','grades_form');">
                                        <span class=""> @lang('site.next step')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- @canany(['edit setting services', 'delete setting services'])
@include('admin.services.services.services-data')

        @include('admin.services.services.edit') 

    @endcan --}}


          
        @endcan
        @canany(['edit grades', 'delete grades'])
            @include('admin.setup.grade.grade-data-table')
         
        @endcan




        @can('create grades')
        <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <div class="form-row">
                        <div class="col-md-3">

                            <div class="form-group">
                                <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="grades_number" name="grades[]" class="form-control">
                                    <span class="text-danger" id="grades_number_error"> </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>@lang('site.nb of hours total for cours') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="total_hours_number" name="total_hours[]" class="form-control">
                                    <span class="text-danger" id="total_hours_number_error"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <h5>@lang('site.duration') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="period_by_mounth_number" name="period_by_mounth[]"
                                        class="form-control">
                                    <span class="text-danger" id="period_by_mounth_number_error"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                            <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                        </div><!-- End col-md-2 -->
                    </div><!-- End col-md-5 -->
                </div>
            </div>
        </div>
        @endcan




    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 1;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                $("#grades_number").attr("id", "grades_" + counter);
                $("#grades_number_error").attr("id", "grades_" + counter + "_");

                $("#total_hours_number").attr("id", "total_hours_" + counter);
                $("#total_hours_number_error").attr("id", "total_hours_" + counter + "_");

                $("#period_by_mounth_number").attr("id", "period_by_mounth_" + counter);
                $("#period_by_mounth_number_error").attr("id", "period_by_mounth_" + counter + "_");

                // $(this).closest(".add_item").attr("id","whole_extra_item_add_"+counter);;

                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });

            // $('#spinner_loading').css("display", "none");

            // $('#services-table-').removeAttr('hidden');

            var table = $('#example1').DataTable({
                scrollY: "400px",
                // scrollX: true,
                scrollCollapse: true,
                paging: false,
                // responsive: true,
                // ajax: '/test/0',

            });
        });
    </script>

    <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/update.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script> --}}
@endsection
