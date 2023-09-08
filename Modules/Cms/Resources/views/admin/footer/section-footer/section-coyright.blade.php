
   <div class="col-lg-12">


      <form method="POST" action="" id="copyright_form" accept-charset="UTF-8"
            class="form-horizontal" enctype="multipart/form-data">
         <div class="white-box  student-details header-menu">
            <div class="add-visitor">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="primary_input mb-35">
                        <input type="hidden" name="key" value="footer_copy_right">
                        <div class="row pt-0">
                         @csrf
                        </div>
                        <div class="tab-content">
                           {{-- @foreach ($LanguageList as $key => $language)
                               <div role="tabpanel"
                                   class="tab-pane fade @if (auth()->user()->language_code == $language->code) show active @endif  "
                                   id="footer_copy_right{{ $language->code }}">
                                   <textarea name="value[{{ $language->code }}]" placeholder="copy_right" class="lms_summernote" id="copy_right">{!! $setting->where('key', 'footer_copy_right')->first()->getTranslation('value', $language->code) ?? '' !!}</textarea>
                               </div>
                           @endforeach --}}
                           <textarea name="setting_value" id="setting_value" class="tinymce_copyright"> 
                                @isset($footer['footersectionsetting'][0]['value'])
                                 {{$footer['footersectionsetting'][0]['value']}} 
                              @endisset       
                            </textarea>
                           <span id="setting_value_" class="text-danger"></span>
                           
                           
                        </div>
                     </div>
                    
                  </div>
               </div>

               <div class="row mt-40">
                  <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                       data-original-title="" title="">
                     <a  onclick="submit_copyright('{{ route('footerSetting.footer.content-update') }}','copyright_form')" class="btn btn-rounded btn-primary float-right" data-original-title="" title=""><i
                           class="ti-check"></i>@lang('site.save')
                     </a>
                  </div>


               </div>

            </div>
         </div>
      </form>
   </div>

