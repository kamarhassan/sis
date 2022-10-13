@extends('admin.layouts.master')



@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.lang name') </th>
                            <th>@lang('site.abbreviation') </th>
                            <th>@lang('site.direction') </th>
                            <th>@lang('site.status ') </th>
                            <th>@lang('site.options') </th>

                        </tr>
                    </thead>
                    <tbody>
                        @isset($lang)
                            @foreach ($lang as $key => $language)
                                <tr class="Row{{ $language->id }} " id="Row{{ $language->id }} ">
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $language->name }} </td>
                                    <td> {{ $language->code }} </td>
                                    <td> {{ $language->direction }} </td>
                                    <td> {{ $language->getActive() }} </td>

                                    <td>
                                        <a href="{{ route('admin.language.edit', $language->id) }}"
                                            class="btn  btn-warning btn-round fa fa-edit" title="@lang('site.edit')">
                                            {{-- @lang('site.edit') --}}
                                        </a>
                                        {{-- <a token="{{ csrf_token() }}" lang_id="{{ $language->id }}"
                                            class="delete_btn btn btn-close btn-danger btn-round fa fa-times" title="@lang('site.delete')"> --}}
                                            {{-- @lang('site.delete') --}}
                                        {{-- </a> --}}

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
    $(document).ready(function() {
    $('#example1').DataTable( {
        // "order": [ 0, 'asc' ]
        "order": [ '4', 'desc' ] // nb four is column status,
        responsive: true,
    } );
} );
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
