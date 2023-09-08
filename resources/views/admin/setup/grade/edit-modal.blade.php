<div class="modal bs-examplemodal-lg  center-modal" id="modal-center" tabindex="-1" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
         
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
      </div>
      

         <div class="row">
            <div class="col-12">
               <form id='grades_form_update'>
                  @csrf
                  <div class="add_item">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                              <input type="hidden" name="category_id"
                                     @isset($data['id']) value="{{$data['id']}}" @endisset>
                              <div class="controls">
                                 <input type="text" id="grades" name="grades" class="form-control"
                                        @isset($data['grade']) value="{{$data['grade']}} " @endisset>
                                 <span class="text-danger" id="grades_"> </span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <h5>@lang('site.background image') <span class="text-danger"></span></h5>
                              <div class="controls">
                                 <input type="file" id="image" name="image" onchange="readURL(this);"
                                        class="form-control">
                                 <span class="text-danger" id="image_"> </span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <h5>@lang('site.background image') <span class="text-danger"></span></h5>
                              <div class="controls img_cont" id="category_image_div">
                                 <img id="category_image_" @isset($data['image']) src="{{asset($data['image'])}}"
                                      @endisset
                                      alt="">
                                 @isset($data['image'])
                                    <a onclick="delete_category_img('{{ route('admin.grades.delete.image') }}',{{ $data['id']}},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                       class="btn_remove"><i
                                          class="fa fa-close"></i></a>
                                 @endisset
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <h5>@lang('site.short description') <span class="text-danger"></span></h5>
                              <div class="controls">
                                     <textarea id="description" name="description" class="form-control">
                                          @isset($data['description']) {{$data['description']}} @endisset 
                                     </textarea>
                                 <span class="text-danger" id="description_"> </span>
                              </div>
                           </div>
                        </div>


                     </div>

                  </div>
               </form>
               <div class="row">
                  <div class="text-xs-right">
                     <a class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                        onclick="submit('{{ route('admin.grades.update') }}','grades_form_update');">
                        <span class=""> @lang('site.next step')</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

