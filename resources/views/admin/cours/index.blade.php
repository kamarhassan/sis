@extends('admin.layouts.master')



@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.cours') </th>
                            <th>@lang('site.status') </th>
                            <th>@lang('site.teacher name') </th>
                            <th>@lang('site.actually start date') </th>
                            <th>@lang('site.start time') </th>
                            <th>@lang('site.actually end date') </th>
                            <th>@lang('site.end time') </th>
                            <th>@lang('site.std count') </th>
                            <th>@lang('site.options') </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($cours)
                            @foreach ($cours as $key => $cour)
                                <tr id="Row{{ $cour->id }} " class="hover-success">
                                    <td onclick='test();'> {{ $key }}</td>
                                    <td>{{ $cour->grade }}, {{ $cour->level }} </td>
                                    <td> {{ $cour->status }} </td>
                                    <td> {{ $cour->name }} </td>
                                    <td> {{ $cour->act_StartDa }} </td>
                                    <td> {{ $cour->startTime }} </td>
                                    <td> {{ $cour->act_EndDa }} </td>
                                    <td> {{ $cour->endTime }} </td>
                                    <td>add students count</td>
                                    {{-- <td> {{ $cour->getActive() }} </td> --}}
                                    <td>

                                        @can('edit cours')
                                            <a href="{{ route('admin.cours.edit', $cour->id) }}" {{-- onclick="" --}}
                                                class="btn fa fa-edit" title="@lang('site.edit')"">

                                            </a>
                                        @endcan

                                        @can('delete cours')
                                            <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash hover-danger"
                                                title="@lang('site.delete')" onclick="">
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






    <script>
        var config = {
            routes: {
                delete: "{{ route('admin.language.delete') }}"
            }
        };
    </script>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                // "order": [ 0, 'asc' ]
                "order": ['0', 'desc'] // nb four is column status,
                responsive: true,
            });
        });
    </script>
    <script src="{{ URL::asset('assets/custome_js/cours_.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
