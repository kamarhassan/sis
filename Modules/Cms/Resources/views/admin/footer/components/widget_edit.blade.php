<div class="modal center-modal fade" id="editModal" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">{{__('footer.Edit Link')}}</h5>
            <a type="button" class="close" data-dismiss="modal">
               <span aria-hidden="true">&times;</span>
            </a>
         </div>
         <form  id="update_footer_link"  >
            @csrf
            <input type="hidden" name="id" id="widgetEditId">
            <div class="modal-body">

               <div class="modal-body">

                  <div class="row">
                     <div class="col-lg-12 mt-30">
                     <div class="input-effect">
                        <select class="selectize-multiple" name="category"   id="editCategory">
                           <option data-display="{{__('footer.Widget Title')}}- *" value="">
                              --{{__('footer.Widget Title')}}--
                           </option>
                           <option value="1">{{ __('footer_section_one_title') }}</option>
                           <option value="2">{{ __('footer_section_two_title') }}</option>
                           <option value="3">{{ __('footer_section_three_title') }}</option>

                        </select>
                        <span class="focus-border"></span>
                     </div>
                     </div>   
                     
                     
                     <div class="">
                        <div class="input-effect">
{{--                           <input type="hidden" name="category" id="category">--}}

                           <span class="focus-border"></span>
                        </div>
                        @error('category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>

                     <div class="col-lg-12 mt-30">
                        <label class="form-section">@lang('site.name')
                        </label>  <span class="text-danger">*</span>
                        <input class="form-control" type="text" type="text" name="name" id="editname"
                               autocomplete="off" >

                        <span id="name_" class="text-danger"></span>
                     </div>

                     <div class="col-lg-12 mt-30">
                        <div class="input-effect">
                           <select class="selectize-multiple" name="page" id="editpage" >
                              <option data-display="{{__('footer.Select Page')}} " value="">
                                 --{{__('footer.Select Page')}}--
                              </option>

                              @foreach ($staticPageList as $page)
                                 <option
                                    value="{{ $page->slug }}">{{ $page->title }}</option>
                              @endforeach
                           </select>
                           <span class="focus-border"></span>
                        </div>
                        <span id="page_" class="text-danger"></span>
                     </div>


                  </div>


               </div>

            </div>
            <div class="modal-footer modal-footer-uniform">
               <a type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</a>
               <a  onclick="submit_rediret('{{ route('footerSetting.footer.widget-update') }}','update_footer_link')" class="btn btn-rounded btn-primary float-right" data-original-title="" title=""><i
                     class="ti-check"></i>Save changes
               </a>
            </div>
         </form>
      </div>
   </div>
</div>
 