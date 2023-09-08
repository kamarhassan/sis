@extends('admin.layouts.master')
@section('title')
@lang('site.cours info')
@endsection
@section('css')
@endsection
@section('content')

@include('admin.cours.info-sub-blade.cours-data')
 
<div class="col-12">
   <div class="box box-default">
       <div class="box-body">
           <ul class="nav nav-tabs justify-content-center" role="tablist">
               <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#by_from" role="tab"><span><i
                               class="ion-person"></i></span> <span
                           class="hidden-xs-down ml-15">@lang('site.students')</span></a> </li>
               <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#cours_fee"
                       role="tab"><span><i class="fa fa-file-excel-o"></i></span> 
                       <span class="hidden-xs-down ml-15">@lang('site.cours fees')</span></a>
               </li>
           </ul>
           <div class="tab-content tabcontent-border">
               <div class="tab-pane active" id="by_from" role="tabpanel">
                   @include('admin.cours.info-sub-blade.students-data')
               </div>
               <div class="tab-pane " id="cours_fee" role="tabpanel">
                  @include('admin.cours.info-sub-blade.cours_fee')
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
@section('script')
    <script>
        function to(route) {
         window.location.href=route;
        }
        $(document).ready(function() {
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



