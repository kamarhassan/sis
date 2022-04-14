@extends('admin.layouts.master')



@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-hover  ">
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
                                <td> {{ $key + 1 }} </td>
                                <td>{{ $cour->grade }}, {{ $cour->level }} </td>
                                <td> {{ $cour->status }} </td>
                                <td> {{ $cour->teachername }} </td>
                                <td> {{ $cour->act_StartDa }} </td>
                                <td> {{ $cour->startTime }} </td>
                                <td> {{ $cour->act_EndDa}} </td>
                                <td> {{ $cour->endTime }} </td>
                                <td>add students count</td>
                                {{--<td> {{ $cour->getActive() }} </td>--}}
                                <td>
                                    <a token="{{ csrf_token() }}"
                                       onclick=""
                                       class="btn fa fa-edit" title="@lang('site.edit')"
{{--                                       id="btn_editable_{{ $grades->id }}"--}}
                                    >
                                        {{-- @lang('site.edit') --}}
                                    </a>

                                    <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash"
                                       title="@lang('site.delete')"
                                       onclick="">


                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    @endisset


                    </tbody>

                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>






    <script>
        // global app configuration object
        var config = {
            routes: {
                delete: "{{ route('admin.language.delete') }}"
            }
        };
    </script>
    {{-- <script type="text/javascript">
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
                alert('saxs');

              var lanID =  $(this).attr('lang_id');
            $.ajax({
                alert('saxs');
                type: 'post',
                 url: "{{route('admin.language.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :lanID
                },
                 // success: function (data) {
                //     if(data.status == true){
                //         $('#success_msg').show();
                //     }
                //     $('.offerRow'+data.id).remove();
                // }, error: function (reject) {
                // }@
            {{-- });
        });
    </script> --}}

@endsection
{{-- @section('script')
<script >
// (document).ready(function() {
//     $('#example1').DataTable( {
//         "order": [[ 3, "desc" ]]
//     } );
// } );
</script> --}}
{{-- @endsection --}}
@section('script')
    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                // "order": [ 0, 'asc' ]
                "order": ['4', 'desc'] // nb four is column status
            });
        });
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
