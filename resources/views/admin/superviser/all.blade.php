@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }
    </style>
@endsection


@section('content')

    <div class="box" id="spinner_loading">
        <div class="d-flex justify-content-center text-primary">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <div class="box" id="admin_table" hidden>

        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">

            <div class="table-responsive">
                <table id="example1" class="table table-hover">
                    <thead>

                        <tr>
                            <th>@lang('site.admin name')</th>
                            <th>@lang('site.E-mail')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.role name')</th>
                            <th>@lang('site.options')</th>
                            {{--  <th>@lang('site.nbumber of cours')</th>
                            <th>@lang('site.students photo')</th> --}}
                        </tr>

                    </thead>
                    <tbody>
                        @isset($admin_with_role)
                            @foreach ($admin_with_role as $admin_info)
                                <tr id="Row{{ $admin_info['id'] }}" class="bg-light mb-10 p-10 cursor_pointer hover-success">
                                    <td>{{ $admin_info['name'] }}</td>
                                    <td>{{ $admin_info['email'] }}</td>
                                    <td>
                                        @if ($admin_info['admin_status'] == 1)
                                            <span class="text-success">
                                                @lang('site.is active')
                                            </span>
                                        @else
                                            <span class="text-danger"> @lang('site.is not active') </span>
                                        @endif
                                    </td>

                                    <td>
                                        @isset($admin_info['roles'])
                                            @foreach ($admin_info['roles'] as $item)
                                                {{ $item['name'] }}
                                            @endforeach
                                            {{-- {{ $admin_info['roles'][0]['name'] }} --}}
                                        @endisset
                                    </td>
                                    <td>
                                        @can('edit supervisor')
                                            <a href="{{ route('admin.supervisor.edit', $admin_info['id']) }}" class="btn fa fa-edit"
                                                title="@lang('site.edit')">
                                            </a>
                                        @endcan
                                        @can('delete supervisor')
                                            <a title="@lang('site.delete')" class="btn  glyphicon glyphicon-trash hover-danger"
                                                onclick="delete_by_id('{{ route('admin.supervisor.delete.supervisor') }}',{{ $admin_info['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">

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
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
    <script>
        $(document).ready(function() {
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
    <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
@endsection
