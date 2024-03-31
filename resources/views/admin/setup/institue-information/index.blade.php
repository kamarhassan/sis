@extends('admin.layouts.master')
@section('title')
    @lang('site.institue information')
@endsection
@section('css')
    @livewireStyles()
@endsection

@section('content')



    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>

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

                            @can('add institue information')
                                <a href="{{ route('admin.InstitueInformation.new') }}" class="fa fa-plus"
                                    title="@lang('site.add institue information')">
                                    <span>@lang('site.add institue information')</span> </a>
                            @endcan

                            <table id="example1" class="table table-striped table-bordered sourced-data">
                                <thead>
                                    <tr class="width-200">
                                        <th>#</th>
                                        <th> @lang('site.name') </th>
                                        <th> @lang('site.phone') </th>
                                        <th> @lang('site.email') </th>
                                        <th> @lang('site.city') </th>
                                        <th> @lang('site.building') </th>
                                        <th> @lang('site.options') </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($institueinformations)
                                        @foreach ($institueinformations as $key => $institueinformation)
                                            <tr class="Row{{ $institueinformation->id }}"
                                                id="Row{{ $institueinformation->id }}">

                                                <td>{{ $institueinformation['id'] }}</td>
                                                <td>{{ $institueinformation['name'] }}</td>
                                                <td>{{ $institueinformation['phone'] }}</td>
                                                <td>{{ $institueinformation['email'] }}</td>
                                                <td>{{ $institueinformation['city'] }}</td>
                                                <td>{{ $institueinformation['building'] }}</td>
                                                <td>


                                                    @can('edit institue information')
                                                        
                                                        <a href="{{ route('admin.InstitueInformation.edit.InstitueInformation', $institueinformation['id']) }}"
                                                             title="@lang('site.edit')"       class="btn fa fa-edit">
                                                          
                                                        </a>
                                                    
                                                    @endcan

                                                    @can('delete institue information')
                                                        <a token="{{ csrf_token() }}"    class="btn fa fa-trash  hover-danger"
                                                            title="@lang('site.delete')"
                                                            onclick="delete_by_id('{{ route('admin.InstitueInformation.delete.InstitueInformation') }}',{{ $institueinformation['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">

 
                                                        </a>
                                                        
                                                    @endcan
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
@endsection

@section('script')
    <script>
        var table = $('#example1').DataTable({
            scrollY: 400,
            // searching: false,
            // scrollX: true,
            scrollCollapse: false,
            paging: false,
            info: false,
            responsive: true,
            // ajax: '/test/0',

        });
    </script>
    <script src="{{ URL::asset('assets\custome_js\delete.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/tables/datatable/dataTables.keyTable.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ URL::asset('assets/app-assets/js/scripts/tables/datatables-extensions/datatable-keytable.js') }}"
        type="text/javascript"></script>
    <script src="{{ URL::asset('assets/datatable/datatables.min.js') }}" type="text/javascript"></script>
@endsection
