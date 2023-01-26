@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/app-assets/css/plugins/loaders/loaders.min.css') }}">
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }



        table.dataTable td {
            word-break: break-word;
        }
    </style>
@endsection


@section('content')
    <div id="spinner_loading">
        <div class="loader-wrapper">
            <div class="loader-container">
                <div class="ball-clip-rotate-multiple loader-success">
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    <div id="admin_table" hidden>
        <section id="html">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body card-dashboard">
                                <p class="card-text">
                                    @can('create certificate')
                                        <a href="{{ route('admin.certificate.new') }}" class="btn la la-plus"> </a>
                                    @endcan
                                </p>
                                <table id="example1" class="table table-striped table-bordered sourced-data">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.certificate name')</th>
                                            <th>@lang('site.grade')</th>
                                            <th>@lang('site.nb of hours total for cours')</th>
                                            <th>@lang('site.duration')</th>
                                            <th>@lang('site.levels')</th>
                                            <th>@lang('site.options')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($certificate)
                                            @foreach ($certificate as $certificate_)
                                                <tr id="Row{{ $certificate_['id'] }}">
                                                    <td>{{ $certificate_['name'] }}</td>
                                                    <td>{{ $certificate_['grade']['grade'] }}</td>
                                                    <td>{{ $certificate_['grade']['total_hours'] }}</td>
                                                    <td>{{ $certificate_['grade']['duration'] }}</td>
                                                    <td>
                                                        @isset($certificate_['levels'])
                                                            @foreach ($certificate_['levels'] as $level)
                                                                {{ $level['level'] }}  ,
                                                            @endforeach
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        {{-- edit certificate |create certificate |delete certificate' --}}
                                                        @can('edit certificate')
                                                            <a href="{{ route('admin.certificate.edit.certificate', $certificate_['id']) }}"
                                                                class="ft-edit" title="@lang('site.edit')">
                                                            </a>
                                                        @endcan
                                                        @can('delete certificate')
                                                            <a title="@lang('site.delete')"
                                                                class="btn text-danger ft-trash-2 hover-danger"
                                                                onclick="delete_by_id('{{ route('admin.certificate.delete.certificate') }}',{{ $certificate_['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
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
                </div>
            </div>
        </section>

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
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/get_cours_cours_std.js') }}"></script>

    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script> --}}
@endsection
