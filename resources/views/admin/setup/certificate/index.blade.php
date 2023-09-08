@extends('admin.layouts.master')
@section('title')
@lang('site.certificate')
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
  

    <div id="admin_table" >
        <section id="html">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-content collpase show">
                            <div class="card-body card-dashboard">

                                <div class="row">
                                    <div class="col-md-4">
                                        @can('create certificate')
                                            <a href="{{ route('admin.certificate.new') }}" class="btn fa fa-plus">
                                                @lang('site.add new certeficate') </a>
                                        @endcan
                                    </div>
                                    <div class="col-md-4">{{-- @can('create certificate template') --}}
                                        <a href="{{ route('admin.certificate.templates.all') }}" class="btn fa fa-plus">
                                            @lang('site.create certificate template') </a>
                                        {{-- @endcan --}}
                                    </div>
                                </div>


                                <table id="example1" class="table table-striped table-bordered sourced-data">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.certificate name')</th>
                                            <th>@lang('site.grade')</th>
{{--                                            <th>@lang('site.nb of hours total for cours')</th>--}}
{{--                                            <th>@lang('site.duration')</th>--}}
                                            <th>@lang('site.levels')</th>
                                            <th>@lang('site.options')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($certificate)
                                            @foreach ($certificate as $certificate_)
                                                <tr id="Row{{ $certificate_['id'] }}"
                                                    class="mb-10 p-10 cursor_pointer hover-success">
                                                    <td>{{ $certificate_['name'] }}</td>
                                                    <td> 
                                                       @isset($certificate_['categorie'])
                                                          @foreach ($certificate_['categorie'] as $categorie)
                                                            
                                                             <span class="badge badge-success-light badge-lg"> {{$categorie['name'] }} </span>
                                                          @endforeach
                                                       @endisset
                                                    </td>
{{--                                                    <td>{{ $certificate_['grade']['total_hours'] }}</td>--}}
{{--                                                    <td>{{ $certificate_['grade']['duration'] }}</td>--}}
                                                    <td>
                                                      
                                                       
                                                    </td>
                                                    <td>
                                                        {{-- edit certificate |create certificate |delete certificate' --}}
                                                        @can('edit certificate')
                                                            <a href="{{ route('admin.certificate.edit.certificate', $certificate_['id']) }}"
                                                                class="btn text-warning   hover-danger fa fa-edit"
                                                                title="@lang('site.edit')">
                                                            </a>
                                                        @endcan
                                                        @can('delete certificate')
                                                            <a title="@lang('site.delete')"
                                                                class="btn text-danger fa fa-trash-o hover-danger"
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

            });
        });
    </script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/get_cours_cours_std.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script> --}}
@endsection
