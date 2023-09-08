<section id="slider" class="slider-element swiper_wrapper min-vh-100 include-header" data-loop="true" data-speed="1000"
         data-autoplay="5000">
   <div class="slider-inner">

      <div class="swiper-container swiper-parent">
         <div class="swiper-wrapper">
            @isset($slider)
               @foreach ($slider as $img_sli)

                  <div class="swiper-slide dark">
                     <div class="container">
                        <div class="slider-caption">
                           @isset($img_sli['description'])
                              <p class="mb-4" data-animate="fadeInUp"
                                 data-delay="100">{{$img_sli['description']}}
                              </p>
                           @endisset
                           @isset($img_sli['link'])
                              <div>
                                 <a href="{{$img_sli['link']}}" data-animate="fadeInUp" data-delay="200"
                                    class="button button-large button-white button-light">{{$img_sli['link_label']}} </a>

                              </div>
                           @endisset
                        </div>
                     </div>
                     <div class="swiper-slide-bg" style="background-image: url('{{$img_sli['image']}}');"></div>
                  </div>
               @endforeach
            @endisset

         </div>
         <div class="slider-arrow-left"><i class="uil uil-angle-left-b"></i></div>
         <div class="slider-arrow-right"><i class="uil uil-angle-right-b"></i></div>
         <div class="slide-number">
            <div class="slide-number-current"></div>
            <span>/</span>
            <div class="slide-number-total"></div>
         </div>
      </div>

   </div>
</section>