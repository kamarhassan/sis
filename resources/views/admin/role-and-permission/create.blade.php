@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')

@endsection


@section('content')
    <div class="col-md-12 col-12">


        <!--
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
                                                            {{-- onclick="services('{{ route('admin.Services.store') }}','services_form')"> --}}> <span class=""> @lang('site.next step')</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            -->


        @isset($roles)
            <div class="box-body">
                <div class="table-responsive ">
                    <table id="example1" style="width: 100%" class="table table-hover display nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.role name')</th>

                                {{-- <th>@lang('site.guard')</th> --}}
                                <th>@lang('site.options')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                                <tr class="Row{{ $item['id'] }}">
                                    <td>
                                        <span class="text-warning"> {{ $item['id'] }}</span>
                                    </td>
                                    <td>
                                        <span class="text-warning"> {{ $item['name'] }}</span>
                                    </td>
                                    {{-- <td>
                                {{ $item['guard_name'] }}
                            </td> --}}
                                    <td>
                                        <a onclick="get_permission('{{ route('admin.setting.get.permission.for.role', $item['id']) }}','{{ csrf_token() }}');"
                                            class="btn text-success fa fa-pencil hover  hover-primary"
                                            title="@lang('site.edit')">
                                        </a>
                                        <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                            title="@lang('site.delete')"
                                            onclick="delete_by_id('{{ route('admin.students.delete_payment_receipt') }}','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                        </a>

                                        @include('admin.role-and-permission.edit-permission-for-role')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endisset

    @endsection


    @section('script')
        <script>


            $(document).ready(function() {

                var table = $('#example1').DataTable({
                    // order: [
                    //     [0, 'desc']
                    // ],
                    scrollY: "400px",
                    // scrollX: true,
                    // scrollCollapse: true,
                    paging: false,
                    // ajax: '/test/0',

                });
            });


           
        </script>
<script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/role_and_permission.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    @endsection
