<div class="col-md-12">

   <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
      <div class="card collapse-icon accordion-icon-rotate">


         <div id="heading11" class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion115" aria-expanded="true"
               aria-controls="accordion115" class="card-title lead">@lang('site.short desciprtion') <span
                  id="short_desc_"
                  class="text-danger">*</span></a>
         </div>
         <div id="accordion115" role="tabpanel" aria-labelledby="heading115" class="collapse show">
            <div class="card-body">
               <div class="col-md-12">
                         <textarea name="short_desc" id="short_desc" class="tinymce">
                               @isset($categorie['shorte_description'])
                               {{ $categorie['shorte_description'] }}
                            @endisset
                        </textarea>
                  <span id="short_desc_" class="text-danger"></span>
               </div>
            </div>
         </div>


         <div id="heading11" class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion11" aria-expanded="true"
               aria-controls="accordion11" class="card-title lead">@lang('site.cours description') <span id="desc_"
                                                                                                         class="text-danger">*</span></a>
         </div>
         <div id="accordion11" role="tabpanel" aria-labelledby="heading11" class="collapse">
            <div class="card-content">
               <div class="card-body">
                  <div class="col-md-12">
                             <textarea name="desc" id="desc" class="tinymce">
                                @isset($categorie['description'])
                                   {{ $categorie['description'] }}
                                @endisset
                                </textarea>
                     <span id="desc_" class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>


         <div id="heading12" class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion12" aria-expanded="false"
               aria-controls="accordion12" class="card-title lead collapsed">@lang('site.cours details') <span
                  id="details_" class="text-danger"></span></a>
         </div>
         <div id="accordion12" role="tabpanel" aria-labelledby="heading12" class="collapse" aria-expanded="false">
            <div class="card-content">
               <div class="card-body">
                  <div class="col-md-12">
                             <textarea name="details" id="details" class="tinymce">
                                @isset($categorie['details'])
                                   {{ $categorie['details'] }}
                                @endisset
                               </textarea>
                     <span id="details_" class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>


         <div id="heading13" class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion13" aria-expanded="false"
               aria-controls="accordion13" class="card-title lead collapsed">@lang('site.cours require knowledge') <span
                  id="requireKnwoledge_" class="text-danger"></span></a>
         </div>
         <div id="accordion13" role="tabpanel" aria-labelledby="heading13" class="collapse" aria-expanded="false">
            <div class="card-content">
               <div class="card-body">
                  <div class="col-md-12">
                             <textarea name="requireKnwoledge" id="requireKnwoledge" class="tinymce">       
                                @isset($categorie['requireKnwoledge'])
                                   {{ $categorie['requireKnwoledge'] }}
                                @endisset   
                            </textarea>
                     <span id="requireKnwoledge_" class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>


         <div id="heading14" class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion14" aria-expanded="false"
               aria-controls="accordion14"
               class="card-title lead collapsed ">@lang('site.course prerequisites')
               <span id="prerequests_" class="text-danger"></span></a>
         </div>
         <div id="accordion14" role="tabpanel" aria-labelledby="heading14" class="collapse"
              aria-expanded="false">
            <div class="card-content">
               <div class="card-body">
                  <div class="col-md-12">
                             <textarea name="prerequests" id="prerequests" class="tinymce"> 
                                @isset($categorie['prerequests'])
                                   {{ $categorie['prerequests'] }}
                                @endisset       
                            </textarea>
                     <span id="prerequests_" class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>


         <div id="heading15" class="card-header">
            <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion15" aria-expanded="false"
               aria-controls="accordion15" class="card-title lead collapsed ">@lang('site.target students')
               <span id="target_students_" class="text-danger">*</span></a>
         </div>
         <div id="accordion15" role="tabpanel" aria-labelledby="heading15" class="collapse"
              aria-expanded="false">
            <div class="card-content">
               <div class="card-body">
                  <div class="col-md-12">
                             <textarea name="target_students" id="target_students" class="tinymce"> 
                                @isset($categorie['target_students'])
                                   {{ $categorie['target_students'] }}
                                @endisset       
                            </textarea>
                     <span id="target_students_" class="text-danger"></span>
                  </div>
               </div>
            </div>
         </div>


      </div>
   </div>
</div>
