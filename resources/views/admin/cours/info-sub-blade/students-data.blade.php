

<div class="box">
  

   <div class="box-body">
       <div class="table-responsive">
           <table id="example1" class="table table-hover">
               <thead>
                   <tr>
                      <th>#</th>
                    <th>@lang('site.student name')</th>
                    <th>@lang('site.phone')</th>
                    <th>@lang('site.E-mail')</th>
                    <th>@lang('site.registration date')</th>
                    <th>@lang('site.sponsore')</th>
                    <th>@lang('site.options')</th>
                 
                   </tr>
               </thead>
               <tbody>
                   @isset($cours['students'])
                       @foreach ($cours['students'] as $key => $std)
                           <tr id="Row{{$std['id']}}" class="hover-success hoverable"
                               onclick="">
                             <td>{{$std['id']}}</td>
                             <td>{{$std['name']}}</td>
                             <td>{{$std['phonenumber']}}</td>
                             <td>{{$std['email']}}</td>
                             
                             <td>{{$std['regisrtaion']}}</td>
                             <td>{{$std['sponsorship_id']}}</td>
                             {{-- <td></td> --}}
                               <td>
                                 {{-- students_only --}}
                                   {{-- @can('edit cours') --}}
                                       <a href="{{route('admin.edit-registration',[$std['id'],$cours['id']])}}" {{-- onclick="" --}}
                                           class="btn fa fa-edit" title="@lang('site.edit')">

                                       </a>
                                   {{-- @endcan --}}

                                   {{-- @can('delete cours') --}}
                                       <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash hover-danger"
                                           title="@lang('site.delete')"
                                            onclick="delete_by_id('{{ route('admin.delete-std-registration') }}',{{$std['pivot']}},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"> 
                                       </a>
                                   {{-- @endcan --}}
                               </td>
                           </tr>
                       @endforeach
                   @endisset


               </tbody>

           </table>
       </div>
   </div>

</div>

