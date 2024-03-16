@extends('admin.layouts.master')
@section('title')
   @lang('site.cours')
@endsection
@section('css')
   <style>
      .hoverable:hover {
         cursor: pointer;
      }
   </style>
@endsection
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
                  <th>@lang('site.student name') </th>
                  <th>@lang('site.students email') </th>
                  <th>@lang('site.students birthday') </th>
                  {{--                  <th>@lang('site.actually start date') </th>--}}
{{--                  <th>@lang('site.options')</th>--}}

               </tr>
               </thead>
               <tbody>
               @isset($std)
                  @foreach ($std as $key => $stduents)
                     <tr id="Row{{ $stduents->id }}" class="hover-success hoverable">
                        <td><a href="{{route('admin.students.profile',$stduents->id )}}"
                               class="btn text-primary glyphicon glyphicon-info-sign hover-warning"
                               title="@lang('site.info')"
                               onclick="">{{----}}
                           </a>
                           <a href="{{route('admin.students.edit.information',$stduents->id )}}"
                               class="btn text-primary glyphicon glyphicon-user hover-warning"
                               title="@lang('site.profile')"
                               onclick="">{{----}}
                           </a>
                        </td>
                        <td>{{ $stduents->name }} # {{ $stduents->id }}</td>
                        <td>{{ $stduents->email }}</td>
                        <td> {{ $stduents->birthday }}</td>


                     </tr>
                  @endforeach
{{--                                    {{ $std->links() }}--}}
               @endisset


               </tbody>
               <tfoot>
               <tr>
                  <td>
                     {{ $std->links() }}
                  </td>
               </tr>

               </tfoot>
            </table>

         </div>
      </div>

   </div>







@endsection
@section('script')
   <script>
       function to(route) {
           window.location.href = route;
       }

       $(document).ready(function () {
           $('#example1').DataTable({
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
   <script src="{{ URL::asset('assets/custome_js/cours_.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
