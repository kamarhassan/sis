@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    {{-- add team|edit team|delete team --}}
    <div class="box">

       
        
        <div class="box" id="team-table-">
         <div class="box-body">
            
            @can('add team')
          
            <a href="{{route('admin.manage.team.add')}}" class="btn fa fa-plus">@lang('site.add team')</a>
        @endcan
      
              <div class="table-responsive ">
                  <table id="team-table" class="table table-hover">
                      <thead>
                          <tr>
                             
                              <th>#</th>
                              <th>@lang('site.instructor')</th>
                              <th>@lang('site.image')</th>
                              <th>@lang('site.short description')</th>
                              <th>@lang('site.role')</th>
                              <th>@lang('site.options')</th>
      
                          </tr>
                         
                      </thead>
                      <tbody>
                        @isset($teams)
                           @foreach ($teams as $team)
                           <tr id="Row{{ $team['id'] }}">
                              <td>{{$team['id']}}</td>
                              <td>{{$team['info']['name']}} #{{$team['info']['id']}} </td>
                              <td><img src=" {{asset($team['photo'])}}" style="width: 150px;height: 150px;"></td>
                              <td>{{$team['shortdescription']}}</td>
                              <td>{{$team['role']}}</td>
                              <td>
                                  
                                 @can('edit team')
                                 <a class="btn text-success fa fa-pencil hover  hover-primary"
                                             href="{{route('admin.manage.team.edit',$team['id'])}}"
                                             title="@lang('site.edit')">
                                  </a>
                             @endcan
                             @can('delete team')
                                 <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                     title="@lang('site.delete')"
                                     onclick="delete_by_id('{{ route('admin.manage.team.delete') }}',{{ $team['id']}},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                 </a>
                             </div>
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
@endsection


@section('script')  

<script>
$(document).ready(function () {
   $('#team-table').DataTable({
       // "order": [ 0, 'asc' ]
       "order": ['0', 'desc'], // nb four is column status,
       responsive: true,
       scrollY: "400px",
       // searching: false,
       // scrollX: true,
       scrollCollapse: true,
       paging: false,
   });
});
</script>
<script src="{{ URL::asset('assets\custome_js\delete.js') }}"></script>
<script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
