@extends('admin.layouts.master')
@section('title')
    @lang('site.fee type')
@endsection
@section('css')
@endsection

@section('content')
    <div class="col-md-12 col-12">
        @can('create fee type')
            <div class="box box-slided-up">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('site.add fee type')</h4>
                    </div>
                    <ul class="box-controls pull-right">
                        <li><a class="box-btn-close" href="#"></a></li>
                        <li><a class="box-btn-slide text-warning" href="#"></a></li>
                        {{-- <li><a class="box-btn-fullscreen" href="#"></a></li> --}}
                    </ul>
                </div>


                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <form id='fee_type_form'>
                                @csrf
                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>@lang('site.fee type') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="fee_0" name="fee[]" class="form-control">
                                                    <span class="text-danger" id="fee_0_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>@lang('site.fee order') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="order_0" name="order[]" class="form-control">
                                                    <span class="text-danger" id="order_0_"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3">
                                          <div class="form-group">
                                              <h5>@lang('site.fee primary price') <span class="text-danger">*</span></h5>
                                              <div class="controls">
                                                  <input type="text" id="primary_price_0" name="primary_price[]"
                                                      class="form-control">
                                                  <span class="text-danger" id="primary_price_0_"> </span>
                                              </div>
                                          </div>
                                      </div> --}}
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
                                        onclick="submit('{{ route('admin.setting.fee.store') }}','fee_type_form')">
                                        <span class=""> @lang('site.next step')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan


        {{-- @include('admin.services.services.services-data') --}}
        @canany(['edit fee type', 'delete fee type'])
            @include('admin.setup.feetype.fee_type-data')
        @endcan
        {{-- edit fee type|create fee type|delete fee type   --}}
        @can('edit fee type')
            @include('admin.setup.feetype.edit')
        @endcan
        <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <div class="form-row">
                        <div class="col-md-3">

                            <div class="form-group">
                                <h5>@lang('site.fee type') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="fee_number" name="fee[]" class="form-control">
                                    <span class="text-danger" id="fee_number_error"> </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>@lang('site.fee order') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="order_number" name="order[]" class="form-control">
                                    <span class="text-danger" id="order_number_error"> </span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                               <h5>@lang('site.fee primary price') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="primary_price_number" name="primary_price[]" class="form-control">
                                    <span class="text-danger" id="primary_price_number_error"> </span>
                                </div>
                            </div>
                        </div> --}}



                        <div class="col-md-2" style="padding-top: 25px;">
                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                            <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                        </div><!-- End col-md-2 -->
                    </div><!-- End col-md-5 -->
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 1;
                $(document).on("click", ".addeventmore", function() {
                    var whole_extra_item_add = $('#whole_extra_item_add').html();
                    $(this).closest(".add_item").append(whole_extra_item_add);
                    $("#fee_number").attr("id", "fee_" + counter);
                    $("#fee_number_error").attr("id", "fee_" + counter + "_");

                    $("#order_number").attr("id", "order_" + counter);
                    $("#order_number_error").attr("id", "order_" + counter + "_");


                    // $("#primary_price_number").attr("id", "primary_price_" + counter);
                    // $("#primary_price_number_error").attr("id", "primary_price_" + counter + "_");

                    // $("#status_number").attr("id", "status_" + counter);
                    // $("#status_number_error").attr("id", "status_" + counter + "_");
                    // $(this).closest(".add_item").attr("id","whole_extra_item_add_"+counter);;

                    counter++;
                });
                $(document).on("click", '.removeeventmore', function(event) {
                    $(this).closest(".delete_whole_extra_item_add").remove();
                    counter -= 1
                });



                $('#spinner_loading').css("display", "none");

                $('#services-table-').removeAttr('hidden');

                var table = $('#services-table').DataTable({
                    scrollY: "400px",
                    // scrollX: true,
                    scrollCollapse: true,
                    responsive: true,
                    paging: false,
                    // ajax: '/test/0',

                });
            });
        </script>

        <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/update.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
    @endsection
