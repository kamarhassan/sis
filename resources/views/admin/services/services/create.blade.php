@extends('admin.layouts.master')
@section('title')
@lang('site.services')
@endsection
@section('css')
    @livewireStyles()
@endsection

@section('content')



    <div class="col-md-12 col-12">
        <div class="box box-slided-up">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h4 class="box-title">@lang('site.add services')</h4>
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
                        <form id='services_form'>
                            @csrf
                            <div class="add_item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>@lang('site.services') <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" id="services_0" name="services[]"
                                                    class="form-control">
                                                <span class="text-danger" id="services_0_"> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>@lang('site.fee value') <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" id="fee_0" name="fee[]" class="form-control">
                                                <span class="text-danger" id="fee_0_"> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>@lang('site.currency name') <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                @isset($currency)
                                                    <select name="currency[]" id="currency_0" class="form-control select2"
                                                        style="width: 100%;">
                                                        <option value="">--------------</option>
                                                        @foreach ($currency as $currencys)
                                                            <option value="{{ $currencys->id }}">
                                                                {{ $currencys->symbol }} <- {{ $currencys->currency }}
                                                                    </option>
                                                        @endforeach
                                                    </select>
                                                @endisset
                                                <span class="text-danger" id="currency_0_"> </span>

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
                                    onclick="services('{{ route('admin.Services.store') }}','services_form')">
                                    <span class=""> @lang('site.next step')</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @include('admin.services.services.services-data')
        @include('admin.services.services.edit')



        <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                    <div class="form-row">
                        <div class="col-md-3">

                            <div class="form-group">
                                <h5>@lang('site.services') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="services_number" name="services[]" class="form-control">
                                    <span class="text-danger" id="services_number_error"> </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>@lang('site.fee value') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="fee_number" name="fee[]" class="form-control">
                                    <span class="text-danger" id="fee_number_error"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <h5>@lang('site.currency name') <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    @isset($currency)
                                        <select name="currency[]" id="currency_number" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">--------------</option>
                                            @foreach ($currency as $currencys)
                                                <option value="{{ $currencys->id }}">
                                                    {{ $currencys->symbol }} <- {{ $currencys->currency }} </option>
                                            @endforeach
                                        </select>
                                    @endisset
                                    <span class="text-danger" id="currency_number_error"> </span>
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

    @endsection

    @section('script')
        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 1;
                $(document).on("click", ".addeventmore", function() {
                    var whole_extra_item_add = $('#whole_extra_item_add').html();

                    $(this).closest(".add_item").append(whole_extra_item_add);


                    $("#services_number").attr("id", "services_" + counter);
                    $("#services_number_error").attr("id", "services_" + counter + "_");

                    $("#fee_number").attr("id", "fee_" + counter);
                    $("#fee_number_error").attr("id", "fee_" + counter + "_");

                    $("#currency_number").attr("id", "currency_" + counter);
                    $("#currency_number_error").attr("id", "currency_" + counter + "_");

                    $("#status_number").attr("id", "status_" + counter);
                    $("#status_number_error").attr("id", "status_" + counter + "_");

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
                    paging: false,
                    // ajax: '/test/0',

                });
            });
        </script>

        <script src="{{ URL::asset('assets/custome_js/services.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/update.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
        </script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
    @endsection
