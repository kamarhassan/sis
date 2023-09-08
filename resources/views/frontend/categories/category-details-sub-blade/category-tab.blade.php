<div class="row">
   <div class="col-lg-4 text-center">
      <h3 class="">{{ $category['name'] }}</h3>
   </div>
   <div class="col-lg-4"><img src="{{ asset($category['global_image']) }}" alt=""></div>

</div>

<br><br>
<ul class="nav canvas-tabs tabs nav-tabs mb-3" id="canvas-tab" role="tablist">
   <li class="nav-item" role="presentation">
      <button class="nav-link active" id="cours_details" data-bs-toggle="pill" data-bs-target="#details_tab"
              type="button" role="tab" aria-controls="canvas-home"
              aria-selected="true">@lang('site.cours details')
      </button>
   </li>
   <li class="nav-item" role="presentation">
      <button class="nav-link" id="require_kwnoldege" data-bs-toggle="pill" data-bs-target="#profile2"
              type="button" role="tab" aria-controls="canvas-profile"
              aria-selected="false">@lang('site.cours require knowledge')
      </button>
   </li>
   <li class="nav-item" role="presentation">
      <button class="nav-link" id="cours_prerequests" data-bs-toggle="pill"
              data-bs-target="#cours_prerequests_tab" type="button" role="tab" aria-controls="canvas-contact"
              aria-selected="false">@lang('site.cours prerequests')
      </button>
   </li>
   <li class="nav-item" role="presentation">
      <button class="nav-link" id="cours_description" data-bs-toggle="pill"
              data-bs-target="#cours_description_tab" type="button" role="tab" aria-controls="canvas-contact"
              aria-selected="false">@lang('site.cours description')
      </button>
   </li>
   <li class="nav-item" role="presentation">
      <button class="nav-link" id="target_students" data-bs-toggle="pill"
              data-bs-target="#target_students_tab" type="button" role="tab" aria-controls="canvas-contact"
              aria-selected="false">
         @lang('site.target students')
      </button>
   </li>
   
   <li class="nav-item" role="presentation">
      <button class="nav-link" id="canvas-about-tab" data-bs-toggle="pill" data-bs-target="#about2"
              type="button" role="tab" aria-controls="canvas-about"
              aria-selected="false">@lang('site.images callery')
      </button>
   </li>
</ul>
<div id="canvas-TabContent" class="tab-content">
   <div class="tab-pane fade show active" id="details_tab" role="tabpanel" aria-labelledby="cours_details"
        tabindex="0">
      <p>{!! $category['details'] !!}</p>
   </div>
   <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="require_kwnoldege"
        tabindex="0">
      <p>{!! $category['requireKnwoledge'] !!}</p>
   </div>
   <div class="tab-pane fade" id="cours_prerequests_tab" role="tabpanel" aria-labelledby="cours_prerequests"
        tabindex="0">
      <p>{!! $category['prerequests'] !!}</p>
   </div>
   <div class="tab-pane fade" id="cours_description_tab" role="tabpanel" aria-labelledby="cours_description"
        tabindex="0">
      <p>{!! $category['description'] !!}</p>
   </div>
   <div class="tab-pane fade" id="target_students_tab" role="tabpanel" aria-labelledby="target_students"
        tabindex="0">
      <p>{!! $category['target_students'] !!}</p>
   </div>
  
   <div class="tab-pane fade" id="about2" role="tabpanel" aria-labelledby="pills-about-tab"
        tabindex="0">
      <div class="masonry-thumbs grid-container row row-cols-4" data-big="4" data-lightbox="gallery">
         @isset($category['callery'])
            @foreach ($category['callery'] as $callery)
               <a class="grid-item" href="{{ asset($callery) }}" data-lightbox="gallery-item">
                  <img src="{{ asset($callery) }}" alt="Gallery Thumb 1">
               </a>
            @endforeach
         @endisset

      </div>
   </div>
</div>

<div class="line"></div>
