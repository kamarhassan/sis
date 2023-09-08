
     <div class="box" id="grade_box">
        <div class="box-header with-border">
            <h4 class="box-title">@lang('site.grades')</h4>
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
                                        <th>@lang('site.image') </th>
                                        <th>@lang('site.receipt description') </th>
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
                                                       <img src="{{ asset($grades->image)}}" alt="" width="165">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label id="label_duration{{ $grades->id }}">
                                                        <span> {{ $grades->description }}</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    @can('edit grades')
                                                        <a token="{{ csrf_token() }}"
                                                            onclick="category_to_update('{{ route('admin.get.category.information',$grades->id) }}', '{{ csrf_token() }}');"
                                                            class="btn fa fa-edit" title="@lang('site.edit')"
                                                            id="btn_editable_{{ $grades->id }}">
                                                        </a>
                                                    @endcan

                                                    @can('delete grades')
                                                        <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash"
                                                            title="@lang('site.delete')"
                                                            onclick="delete_by_id('{{ route('admin.grades.delete') }}',{{ $grades->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
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
                @endcan

           
          
        </div>
       
    </div>