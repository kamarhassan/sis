@extends('admin.layouts.master')
@section('title')
   @lang('site.grade')
@endsection
@section('css')
   <style>
       
      .img_cont {
         position: relative;
         width: 385px;
         max-width: 385px;
      }

      .img_cont img {
         width: 385px;
         height: 165auto;
      }

      .img_cont .btn_remove {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         -ms-transform: translate(-50%, -50%);
         background-color: transparent;
         color: rgb(255, 0, 0);
         font-size: 16px;
         padding: 12px 24px;
         border: none;

         cursor: pointer;
         border-radius: 5px;
         text-align: center;
         opacity: 0.7;
      }

      .img_cont .btn_remove:hover {
         background-color: rgb(255, 0, 0);
         opacity: 1;
         /* background-image: ft-trash-2; */

      }
   </style>

@endsection

@section('content')
   <div class="col-md-12 col-12">
      @can('create grades')
         <div class="box box-slided-up">
            <div class="box-header with-border">
               <div class="box-header with-border">
                  <h4 class="box-title">@lang('site.add new grade')</h4>
               </div>
               <ul class="box-controls pull-right">
                  {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                  <li><a class="box-btn-slide text-warning" href="#"></a></li>

               </ul>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="col-12">
                     <form id='grades_form'>
                        @csrf
                        <div class="add_item">
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="text" id="grades_0" name="grades[]" class="form-control">
                                       <span class="text-danger" id="grades_0_"> </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <h5>@lang('site.background image') <span class="text-danger"></span></h5>
                                    <div class="controls">
                                       <input type="file" id="image_0" name="image[]"
                                              class="form-control">
                                       <span class="text-danger" id="image_0_"> </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h5>@lang('site.short description') <span class="text-danger"></span></h5>
                                    <div class="controls">
                                                    <textarea id="description_0" name="description[]"
                                                              class="form-control">
                                                    </textarea>
                                       <span class="text-danger" id="description_0_"> </span>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-md-2" style="padding-top: 25px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i>
                                            </span>
                              </div>
                           </div>

                        </div>
                     </form>
                     <div class="row">
                        <div class="text-xs-right">
                           <a class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                              onclick="submit('{{ route('admin.grades.store') }}','grades_form');">
                              <span class=""> @lang('site.next step')</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         
      @endcan
      
      @canany(['edit grades', 'delete grades'])
         @include('admin.setup.grade.grade-data-table')
         @include('admin.setup.grade.edit-modal')
      @endcan
        



      @can('create grades')
         <div style="visibility: hidden;">
            <div class="whole_extra_item_add" id="whole_extra_item_add">
               <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                  <div class="form-row">
                     <div class="col-md-3">


                        <div class="form-group">
                           <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                           <div class="controls">
                              <input type="text" id="grades_number" name="grades[]" class="form-control">
                              <span class="text-danger" id="grades_number_error"> </span>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <h5>@lang('site.background image') <span class="text-danger"></span></h5>
                           <div class="controls">
                              <input type="file" id="image_number" name="image[]" class="form-control">
                              <span class="text-danger" id="image_number_error"> </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <h5>@lang('site.short description') <span class="text-danger"></span></h5>
                           <div class="controls">
                                  
                                 
                                 <textarea id="description_number" name="description[]"
                                           class="form-control">
                             </textarea>


                              <span class="text-danger" id="description_number_error"> </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                     </div><!-- End col-md-2 -->
                  </div><!-- End col-md-5 -->
               </div>
            </div>
         </div>
      @endcan


   </div>
@endsection
@section('script')
   <script type="text/javascript">
       $(document).ready(function () {
           var counter = 1;
           $(document).on("click", ".addeventmore", function () {
               var whole_extra_item_add = $('#whole_extra_item_add').html();
               $(this).closest(".add_item").append(whole_extra_item_add);
               $("#grades_number").attr("id", "grades_" + counter);
               $("#grades_number_error").attr("id", "grades_" + counter + "_");

               $("#image_number").attr("id", "image_" + counter);
               $("#image_number_error").attr("id", "image_" + counter + "_");

               $("#description_number").attr("id", "description_" + counter);
               $("#description_number_error").attr("id", "description_" + counter + "_");

               // $(this).closest(".add_item").attr("id","whole_extra_item_add_"+counter);;

               counter++;
           });
           $(document).on("click", '.removeeventmore', function (event) {
               $(this).closest(".delete_whole_extra_item_add").remove();
               counter -= 1
           });


           var table = $('#example1').DataTable({
               scrollY: "400px",
               scrollCollapse: true,
               paging: false,
           });
       });

       function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#category_image_')
                       .attr('src', e.target.result)
                       .width(385)
                       .height(165);

               };

               reader.readAsDataURL(input.files[0]);
           }
       }


   </script>

   <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/update.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
   </script>
   <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
   {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script> --}}
@endsection
