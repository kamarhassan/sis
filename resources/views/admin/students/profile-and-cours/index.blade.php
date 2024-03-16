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
{{--{{dd($std['cours'])}}--}}
@include('admin.students.profile-and-cours.sub-view.std-info')
@include('admin.students.profile-and-cours.sub-view.std-cours')

   {{-- @include('admin.') --}}


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
