@extends('admin.layouts.master')
@section('title')
@lang('site.cms footer')
@endsection
@section('css')
   <link rel="stylesheet" type="text/css"
         href="{{ URL::asset('Modules/Cms/assets/selectize/css/selects/selectize.css') }}">
   <link rel="stylesheet" type="text/css"
         href="{{ URL::asset('Modules/Cms/assets/selectize/css/selects/selectize.default.css') }}">
   <link rel="stylesheet" type="text/css"
         href="{{ URL::asset('Modules/Cms/assets/selectize/css/selectize/selectize.css') }}">

@endsection
@section('content')

   @php

      $footer = render_footer_front();
   //footersectionsetting
   @endphp
{{--   {{$footer['footersectionsetting']}}--}}
   <div class="col-12">
      <div class="box box-default">


         <div class="box-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs justify-content-center" role="tablist">
               <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home12" role="tab"><span><i
                           class="ion-home"></i></span> <span
                        class="hidden-xs-down ml-15">@lang('site.copyright')</span></a></li>
               <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile12" role="tab"><span><i
                           class="ion-person"></i></span> <span
                        class="hidden-xs-down ml-15">{{$footer['footersectionsetting'][1]['value']}}</span></a></li>
               <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages12" role="tab"><span><i
                           class="ion-email"></i></span> <span
                        class="hidden-xs-down ml-15">{{$footer['footersectionsetting'][2]['value']}}</span></a></li>
               <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting12" role="tab"><span><i
                           class="ion-settings"></i></span> <span
                        class="hidden-xs-down ml-15">{{$footer['footersectionsetting'][3]['value']}}</span></a></li>
               <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about12" role="tab"><span><i
                           class="ion-person"></i></span> <span
                        class="hidden-xs-down ml-15">{{$footer['footersectionsetting'][4]['value']}}</span></a></li>
            </ul>

            <div class="tab-content tabcontent-border">


               <div class="tab-pane active" id="home12" role="tabpanel">
                  <div class="p-15">

                     @include('cms::admin.footer.section-footer.section-coyright')

                  </div>
               </div>
               <div class="tab-pane" id="profile12" role="tabpanel">
                  <div class="p-15">

                     @include('cms::admin.footer.section-footer.section-one')

                  </div>
               </div>
               <div class="tab-pane" id="messages12" role="tabpanel">
                  <div class="p-15">


                     @include('cms::admin.footer.section-footer.section-two')
                  </div>
               </div>
               <div class="tab-pane" id="setting12" role="tabpanel">
                  <div class="p-15">


                     @include('cms::admin.footer.section-footer.section-three')
                  </div>
               </div>
               <div class="tab-pane" id="about12" role="tabpanel">
                  <div class="p-15">


                     @include('cms::admin.footer.section-footer.section-four')
                  </div>
               </div>

            </div>
         </div>
      @include('cms::admin.footer.components.widget_create')
      <!-- /.box-body -->
      </div>
      <!-- /.box -->
   </div>

   @include('cms::admin.footer.components.widget_edit')
   @include('cms::admin.footer.components.scripts')
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
   <script>
       function edit_category(a) {
           $('#category').val(a);
       }


       function showEditModal(page) {

          
        
          // $("#widget_description").summernote("code", page.description);
           $('#editname').val(page.name);
           $('#widgetEditId').val(page.id);
           
           $('#editCategory')[0].selectize.setValue(page.category);
             $('#editpage')[0].selectize.setValue(page.slug);
           // selectize.setValue(page.category);
           
           $("#editPage").val(page.page);
           // $('#editPage').niceSelect('update');
           if (page.is_static == 1) {
               // $('#editPageFieldDiv').css("display", "none");
               $('#editCategoryFieldDiv').removeClass("col-lg-12").addClass("col-lg-12");
           } else {
               // $('#editPageFieldDiv').css("display", "inherit");
               $('#editCategoryFieldDiv').removeClass("col-lg-12").addClass("col-lg-12");
           }

       }
       
   </script>
    
   <script src="{{ URL::asset('Modules/Cms/assets/tinymce/tinymce/tinymce.js') }}"></script>
   <script src="{{ URL::asset('Modules/Cms/assets/tinymce/editor-tinymce.js') }}"></script>
   
   <script src="{{ URL::asset('Modules/Cms/assets/custome_js/save_and_redirect.js') }}"></script>
   <script src="{{ URL::asset('Modules/Cms/assets/custome_js/delete.js') }}"></script>
   <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
   <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/select/form-selectize.js') }}"></script>
   
   <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
   <script>
       $(document).ready(function () {
          
           $('#section-one').DataTable({
               // "order": [ 0, 'asc' ]
               "order": ['0', 'desc'], // nb four is column status,
               responsive: true,
               scrollY: "400px",
               // searching: false,
               scrollX: true,
               scrollCollapse: false,
               paging: false,
           });
        
           $('#section-two').DataTable({
               // "order": [ 0, 'asc' ]
               "order": ['0', 'desc'], // nb four is column status,
               responsive: true,
               scrollY: "400px",
               // searching: false,
               scrollX: true,
               scrollCollapse: false,
               paging: false,
           });
           $('#section-three').DataTable({
               // "order": [ 0, 'asc' ]
               "order": ['0', 'desc'], // nb four is column status,
               responsive: true,
               scrollY: "400px",
               // searching: false,
               scrollX: true,
               scrollCollapse: false,
               paging: false,
           });
       });
   </script>
 
@endsection
