<div class="section mt-6 parallax" style="padding: 80px 0 60px;">
   <div class="parallax-bg"
        style="background: url('assets/Canvas/demos/course/images/icon-pattern.jpg') repeat;"></div>
   <div class="wave-top"
        style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x;"></div>
   <div class="container">
      <div class="heading-block border-bottom-0 mb-5 text-center">
         <h3>@lang('site.available class')</h3>
      </div>
      <div class="clear"></div>
      <div class="row mt-2">
         @isset($available_cours)
            @foreach ($available_cours as $item)
               <div class="col-md-4">
                  <div class="card course-card hover-effect  border-box">

                     <div class="card-body">
                        <h4 class="card-title" style="text-align: center">
                          

                              <div class="row">{{ $category['name']}}</div>
                              <div class="row"> [ {{$category['grade']['grade']}}
                                 - {{$category['level']['level']}} ]
                              </div>
                              <div class="row">@lang('site.start date') {{$item['act_StartDa']}}</div>
                              <div class="row">@lang('site.end date') {{$item['act_EndDa']}}</div>



                              <a href="{{ route('web.cours-details',[ $category['name'],$category['grade']['grade'] . '-' . $category['level']['level'], $item['id']]) }}">

                              <span  class="fa-solid fa-hand-point-right"> </span> @lang('site.Register Now')</a>
                        </h4>


                     </div>
                  </div>
               </div>

            @endforeach
         @endisset
      </div>
   </div>
</div>


<div class="wave-bottom"
     style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);">
</div>
</div>