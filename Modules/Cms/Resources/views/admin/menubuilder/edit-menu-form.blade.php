<div id="collapse_{{$element->id}}" class="collapse"
     aria-labelledby="heading_{{$element->id}}"
     data-parent="#accordion_{{$element->id}}">
   <div class="card-body">
      <section class="admin-visitor-area student-details header-menu">
         <form enctype="multipart/form-data" class="elementEditForm">
            @csrf
            <div class="row pt-0">
{{--               @if(isModuleActive('Org') || isModuleActive('FrontendMultiLang'))--}}
{{--                  <ul class="nav nav-tabs no-bottom-border  mt-sm-md-20 mb-10 ml-3"--}}
{{--                      role="tablist">--}}
   {{--                     @foreach ($LanguageList as $key => $language)--}}
{{--                        <li class="nav-item">--}}
{{--                           <a class="nav-link  @if (auth()->user()->language_code == $language->code) active @endif"--}}
{{--                              href="#element{{$element->id.$language->code}}"--}}
{{--                              role="tab"--}}
{{--                              data-toggle="tab">{{ $language->native }}  </a>--}}
{{--                        </li>--}}
{{--                     @endforeach--}}
{{--                  </ul>--}}
{{--               @endif--}}
            </div>
            <div class="row">
               <input type="hidden" name="id" class="id"
                      value="{{$element->id}}">
               <input type="hidden" name="type" class="type"
                      value="{{$element->type}}">
               <div class="col-lg-12">
                  <div class="tab-content">
{{--                     @foreach ($LanguageList as $key => $language)--}}
{{--                        <div role="tabpanel"--}}
{{--                             class="tab-pane fade @if (auth()->user()->language_code == $language->code) show active @endif  "--}}
{{--                             id="element{{$element->id.$language->code}}">--}}

{{--                           <div class="primary_input mb-25">--}}
{{--                              <label class="primary_input_label"--}}
{{--                                     for="title">--}}
{{--                                 {{__('Navigation Label')}} <span--}}
{{--                                    class="text-danger">*</span></label>--}}
{{--                              <input--}}
{{--                                 class="primary-input form-control title"--}}
{{--                                 type="text"--}}
{{--                                 name="title[{{$language->code}}]"--}}
{{--                                 autocomplete="off"--}}
{{--                                 value="{{$element->getTranslation('title',$language->code)}}"--}}
{{--                                 placeholder="{{__('Navigation Label')}}"--}}
{{--                                 {{$element->type =='tag'?'readonly':'' }} required>--}}
{{--                           </div>--}}
{{--                        </div>--}}
{{--                     @endforeach--}}
                  </div>
               </div>
               @if($mega_menu==0 || ($mega_menu==1 && $level!=2))
                  <div class="col-lg-6">
                     <div class="primary_input mb-25">
                        <label class="primary_input_label" for="link">
                           Link
                        </label>
                        <input class="primary-input form-control link"
                               type="text" name="link" autocomplete="off"
                               value="{{$element->link}}"
                               placeholder="Link">
                     </div>
                  </div>
               @endif
               @if($mega_menu==0 || ($mega_menu==1 && $level==1))
                  <div class="col-xl-6 mt-30">
                     <div class="primary_input">
                        <div class="row">
                           <div class="col-lg-12">


                              <label class="primary_checkbox d-flex mr-12"
                                     style="width: 100%;">
                                 <input type="checkbox" name="is_newtab"
                                        id="is_newtab_{{$element->id}}"

                                        value="1" {{$element->is_newtab == 1? 'checked':''}}>
                                 <span
                                    class="checkmark mr-2"></span> {{ __('Open link in a new tab') }}
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="col-xl-6 {{!empty($element->parent_id)?'d-none':''}}">
                     <div class="primary_input">
                        <label class="primary_input_label mb-25"
                               for="">{{ __('frontendmanage.Mega Menu') }}</label>
                        <div class="row">
                           <div class="col-lg-6 mb-25">
                              <div
                                 class="input-effect custom-transfer-account">

                                 <label
                                    class="primary_checkbox d-flex mr-12">
                                    <input type="radio" class="mega_menu"
                                           name="mega_menu"
                                           value="1"
                                       {{$element->mega_menu == 1?'checked':''}} >
                                    <span
                                       class="checkmark mr-2"></span> {{ __('common.Yes') }}
                                 </label>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-25">


                              <div
                                 class="input-effect custom-transfer-account">

                                 <label
                                    class="primary_checkbox d-flex mr-12">
                                    <input type="radio"
                                           name="mega_menu" class="mega_menu"
                                           value="0"
                                       {{$element->mega_menu != 1?'checked':''}}>
                                    <span
                                       class="checkmark mr-2"></span> {{ __('common.No') }}
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-6 no-mega-menu {{$element->mega_menu==1?'d-none':''}}">
                     <div class="primary_input">
                        <label class="primary_input_label mb-25"
                               for="">{{ __('Show Direction') }}</label>
                        <div class="row">
                           <div class="col-lg-6 mb-25">
                              <div
                                 class="input-effect custom-transfer-account">

                                 <label
                                    class="primary_checkbox d-flex mr-12">
                                    <input type="radio"
                                           name="from_bank_name"
                                           value="1"
                                       {{$element->show == 1?'checked':''}} >
                                    <span
                                       class="checkmark mr-2"></span> {{ __('Left') }}
                                 </label>
                              </div>
                           </div>
                           <div class="col-lg-6 mb-25">


                              <div
                                 class="input-effect custom-transfer-account">

                                 <label
                                    class="primary_checkbox d-flex mr-12">
                                    <input type="radio"
                                           name="from_bank_name"
                                           value="0"
                                       {{$element->show == 0?'checked':''}}>
                                    <span
                                       class="checkmark mr-2"></span> {{ __('Right') }}
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-6 yes-mega-menu  {{$element->mega_menu!=1?'d-none':''}}">
                     <div class="primary_input">

                        <div class="row">
                           <div class="col-lg-12 mb-25">
                              <div
                                 class="input-effect custom-transfer-account">
                                 <div class="primary_input mb-25">

                                    <select class="primary_select mb-25" name="mega_menu_column"
                                            id="mega_menu_column{{$element->id}}">
                                       <option
                                          value="">{{__('common.Select')}} {{__('frontendmanage.Column')}}</option>
                                       @for($i=1;$i<=12;$i++)
                                          <option
                                             value="{{$i}}"
                                             {{$element->mega_menu_column==$i?'selected':''}}
                                          >{{$i}}  {{__('frontendmanage.Column')}}</option>
                                       @endfor
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               @endif
               <div class="col-lg-12 text-center">
                  <div class="d-flex justify-content-center pt_20">
                     <button type="button"
                             class="editBtn btn-warning primary-btn fix-gr-bg"><i
                           class="ti-check"></i>
                        {{ __('update') }}
                     </button>
                  </div>
               </div>

            </div>
         </form>
      </section>
   </div>
</div>
