@extends('admin.layouts.master')
@section('title')
   @lang('site.slider')
@endsection
@section('css')
@endsection

@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-content collpase show">
                        <div class="card-body card-dashboard">

                            @can('add slider')
                                <a href="{{ route('admin.slider.new') }}" class="fa-plus" title="@lang('site.add slider')">
                                    <span>@lang('site.add slider')</span> </a>
                            @endcan

                            <table id="example1" class="table table-striped table-bordered sourced-data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> @lang('site.image') </th>
                                        {{-- <th> @lang('site.link_label') </th> --}}
                                        {{-- <th> @lang('site.link') </th> --}}
                                        <th> @lang('site.status') </th>
                                        {{-- <th> @lang('site.description') </th> --}}
                                        <th> @lang('site.options') </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @isset($sliders)
                                        @foreach ($sliders as $key => $slider)
                                            <tr class="Row{{ $slider->id }}"
                                                id="Row{{ $slider->id }}">
                                                <td>{{ $slider['id'] }}</td>
                                                <td> <img src="{{ asset($slider['image']) }}" width="150px" height="150px" alt=""> </td>
                                                <td>@if ($slider['status']==1) 
                                                    <span class="text-success">
                                                        @lang('site.is active')
                                                    </span>
                                                    @else 
                                                    <span class="text-danger">
                                                        @lang('site.is not active')
                                                    </span>
                                                   
                                                   
                                                @endif</td>
                                                {{-- <td>{{ $slider['link_label'] }}</td> --}}
                                                {{-- <td>{{ $slider['link'] }}</td> --}}
                                                {{-- <td>{{ $slider['description'] }}</td> --}}
                                                <td>
                                                   <div class="row">
<div class="col-sm-1">
@can('edit slider')
<a href="{{route('admin.slider.edit.slider', $slider['id'])}}" class="glyphicon glyphicon-edit" title="@lang('site.edit')">
</a>
</div>
@endcan
<div class="col-sm-1">

   @can('delete slider')
   <a token="{{ csrf_token() }}" class="glyphicon glyphicon-trash hover hover-danger"
   title="@lang('site.delete')"
   onclick="delete_by_id('{{route('admin.slider.delete.slider')}}',{{ $slider['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
</a>
</div>
                                                   @endcan
                                                </div>
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
    <script src="{{ URL::asset('assets\custome_js\delete.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/tables/datatable/dataTables.keyTable.min.js') }}"
        type="text/javascript"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/scripts/tables/datatables-extensions/datatable-keytable.js') }}"
        type="text/javascript"></script> --}}
    {{-- <script src="{{ URL::asset('assets/datatable/datatables.min.js') }}" type="text/javascript"></script> --}}
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
@endsection
