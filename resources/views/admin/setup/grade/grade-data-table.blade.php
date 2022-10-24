
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">@lang('site.add new grade')</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                @canany(['edit grades', 'delete grades'])
                   
                        <div class="table-responsive">
                            <table id="example1" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.grade') </th>
                                        <th>@lang('site.nb of hours total for cours') </th>
                                        <th>@lang('site.duration') </th>
                                        <th>@lang('site.options') </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($grade)
                                        @foreach ($grade as $key => $grades)
                                            <tr class="Row{{ $grades->id }}" id="Row{{ $grades->id }}">
                                                @csrf
                                                <td> {{ $key + 1 }} </td>
                                                <td>
                                                    <label id="label_grade{{ $grades->id }}">
                                                        <span> {{ $grades->grade }}</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    
                                                    <label id="label_hours{{ $grades->id }}">
                                                        <span> {{ $grades->total_hours }}</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label id="label_duration{{ $grades->id }}">
                                                        <span> {{ $grades->duration }}</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    @can('edit grades')
                                                        <a token="{{ csrf_token() }}"
                                                            onclick="change_to_update({{ $grades->id }},'{{ $grades->grade }}','{{ route('admin.grades.update') }}', '{{ csrf_token() }}');"
                                                            class="btn fa fa-edit" title="@lang('site.edit')"
                                                            id="btn_editable_{{ $grades->id }}">
                                                            {{-- @lang('site.edit') --}}
                                                        </a>
                                                    @endcan

                                                    @can('delete grades')
                                                        <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash"
                                                            title="@lang('site.delete')"
                                                            onclick="delete_by_id('{{ route('admin.grades.delete') }}',{{ $grades->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                                        </a>
                                                    @endcan
                                                    {{-- <a token="{{ csrf_token() }}" lang_id="{{ $grades->id }}"
                                                      class="delete_btn btn btn-close btn-danger btn-round fa fa-times"
                                                      title="@lang('site.delete')"
                                                      onclick=" delete_by_id_test('{{ json_encode(swal_fire_msg()) }}');">
  
  
                                                  </a> --}}

                                                </td>

                                            </tr>
                                        @endforeach
                                    @endisset


                                </tbody>

                            </table>
                        </div>

                    </div>
                @endcan

           
          
        </div>
       
    </div>