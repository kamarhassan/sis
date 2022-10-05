@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
    <style>
        .modal {
            display: block !important;
            /* I added this to see the modal, you don't need this */
        }

        /* Important part */
        .modal-dialog {
            overflow-y: initial !important
        }

        .modal-body {
            height: 80vh;
            overflow-y: auto;
        }
    </style>
@endsection


@section('content')
    <div class="row float-right">
        <a type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#modal-center">
            {{-- <i class="fa fa-plus-circle"></i> --}}
            @lang('permission.add new role')
        </a>
    </div>
    

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
                    searching: false,
                    info: false,
                    scrollY: "400px",
                    // scrollX: true,
                    // scrollCollapse: true,
                    paging: false,
                    // ajax: '/test/0',

                });
            });
        </script>
        <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
        <script src="{{ URL::asset('assets/custome_js/role_and_permission.js') }}"></script>
        <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
        <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    @endsection
