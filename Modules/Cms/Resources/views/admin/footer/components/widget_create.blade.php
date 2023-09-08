@php
   //  $LanguageList = getLanguageList();
@endphp

<div class="modal center-modal fade" id="modal-center" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"></h5>
            <a type="button" class="close" data-dismiss="modal">
               <span aria-hidden="true">&times;</span>
            </a>
         </div>
         <form  id="create_footer_link"  >
            @csrf
       
         <div class="modal-body">
           
               <div class="modal-body">
              
                  <div class="row">


                     <div class="">
                        <div class="input-effect">
                           <input type="hidden" name="category" id="category">
                                                        
                           <span class="focus-border"></span>
                        </div>
                        @error('category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                     
                     <div class="col-lg-12 mt-30">
                        <label class="form-section">@lang('site.name')
                        </label>  <span class="text-danger">*</span>
                        <input class="form-control" type="text" type="text" name="name" id="name"
                               autocomplete="off" value="">

                        <span id="name_" class="text-danger"></span>
                     </div>

                     <div class="col-lg-12 mt-30">
                        <div class="input-effect">
                           <select class="selectize-multiple" name="page" id="page" >
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
            <a  onclick="submit_rediret('{{ route('footerSetting.footer.widget-store') }}','create_footer_link')" class="btn btn-rounded btn-primary float-right" data-original-title="" title=""><i
                  class="ti-check"></i>@lang('site.save')
            </a>
         </div>
         </form>
      </div>
   </div>
</div>
 