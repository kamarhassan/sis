@extends('frontend.layouts.master')
@section('title')
@endsection

@section('css')
   <style>
      .mydivoutermulti {
         position: relative;
         background: #f90;
         width: 130px;
         height: 95px;
         float: left;
         margin-right: 15px;
      }

      .buttonoverlapmulti {
         position: absolute;
         z-index: 2;
         top: 33px;
         display: none;
         left: 19px;
         width: 92px;
      }

      .mydivoutermulti:hover .buttonoverlapmulti {
         display: block;
      }
   </style>
   <style>
      /* Container for the slider */
      .slider {
         position: relative;
         width: 100%;
         max-width: 800px;
         margin: 0 auto;
         overflow: hidden;
      }

      /* Each slide */
      .slide {
         position: relative;
      }

      /* Image inside each slide */
      .slide img {
         width: 100%;
         height: auto;
      }

      /* Slide content (text and button) */
      .slide-content {
         position: absolute;
         top: 80%;
         left: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
         color: white;
      }

      /* Title and description text */
      .slide-content h2,
      .slide-content p {
         margin: 0;
      }

      /* Button style */
      .button_slider {
         display: inline-block;
         padding: 10px 20px;
         background-color: #007BFF;
         color: white;
         text-decoration: none;
         margin-top: 10px;
      }

   </style>
   {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/app-assets/css-rtl/plugins/animate/animate.css') }}"> --}}
   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/settings.css') }}" media="screen">
   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/layers.css') }}">

   <link rel="stylesheet" href="{{ URL::asset('assets/Canvas/include/rs-plugin/css/navigation.css') }}">

   <link rel="stylesheet"
         href="{{ URL::asset('assets/Canvas/include/rs-plugin/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
   <link rel="stylesheet"
         href="{{ URL::asset('assets/Canvas/include/rs-plugin/fonts/font-awesome/css/font-awesome.css') }}">


@endsection

@section('content')


   @include('frontend.layouts.slider')







   <div class="section mt-6 parallax" style="padding: 80px 0 60px;">
      <div class="parallax-bg"
           style="background: url('assets/Canvas/demos/course/images/icon-pattern.jpg') repeat;"></div>

      <!-- Wave Shape Divider
                ============================================= -->
      <div class="wave-top"
           style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x;">
      </div>
      <div class="container">
         <div class="heading-block border-bottom-0 mb-5 text-center">
            <h3>@lang('site.Most Popular Classes')</h3>
         </div>
         <div class="clear"></div>
         <div class="row mt-2">
            @isset($cours)
               @foreach ($cours as $item)
                  <div class="col-md-4 mb-5 ">
                     <div class="card course-card hover-effect  border-box">

                        <div class="card-body">
                           <h4 class="card-title fw-bold mb-2">
                              <a href="{{ route('web.cours-details',[ $item['category_grade_level']['name'],$item['category_grade_level']['grade']['grade'] . '-' . $item['category_grade_level']['level']['level'], $item['id']]) }}">
                                 {{$item['category_grade_level']['name']}}
                                 [ {{$item['category_grade_level']['grade']['grade']}}
                                 - {{$item['category_grade_level']['level']['level']}} ]</a></h4>
                           <div class="rating-stars mb-2"><i class="bi-star-fill"></i><i class="bi-star-fill"></i><i
                                 class="bi-star-fill"></i><i class="bi-star-fill"></i><i class="bi-star-half"></i>
                              <span>4.7</span>
                           </div>
                           <p class="card-text text-black-50 mb-1"> @isset($item['description'])
                              <p> {{ $item['description'] }}</p>
                           @endisset
                        </div>
                     </div>
                  </div>
               @endforeach
            @endisset
         </div>
         <div class="wave-bottom"
              style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);">
         </div>
      </div>
      <div class="wave-bottom"
           style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);">
      </div>
   </div>



   <div class="section mt-6 parallax" style="padding: 80px 0 60px;">
      <div class="parallax-bg" style="background: url('assets/Canvas/demos/course/images/icon-pattern.jpg') repeat;">
      </div>
      <div class="wave-top"
           style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x;">
      </div>
      <div class="container">
         <div class="heading-block border-bottom-0 mb-5 text-center">
            <h3>@lang('site.cours')</h3>
         </div>
         <div class="clear"></div>
         <div class="row mt-2">
            @isset($categories_cours)
               @foreach ($categories_cours as $item)
                  <div class="col-md-4 mb-5">
                     <div class="card course-card hover-effect border-0">

                        <a href="{{ route('show.categorie.details_by_id', $item['id']) }}"><img class="card-img-top"
                                                                                                src="{{asset( $item['global_image']) }}"
                                                                                                style="width: 400px;height: 300px"
                                                                                                alt="Card image cap">
                        </a>
                        <div class="card-body">
                           <h4 class="card-title fw-bold mb-2"><a href="{{ $item['route'] }}">{{ $item['name'] }}</a>
                           </h4>
                           <div data-readmore="true"
                                data-readmore-trigger-open="Read More <i class='fa-solid fa-chevron-down'></i>"
                                data-readmore-trigger-close="Read Less <i class='fa-solid fa-chevron-up'></i>">

                              <p> {!! $item['shorte_description'] !!}</p>
                              <a href="#"
                                 class="btn btn-link text-primary read-more-trigger read-more-trigger-center"></a>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            @endisset
         </div>
      </div>
      <div class="wave-bottom"
           style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);">
      </div>
   </div>

   <div class="section mt-6 parallax" style="padding: 80px 0 60px;">
      <div class="parallax-bg" style="background: url('assets/Canvas/demos/course/images/icon-pattern.jpg') repeat;">
      </div>
      <div class="wave-top"
           style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x;">
      </div>
      <div class="container">
         <div class="heading-block border-bottom-0 mb-5 text-center">
            <h3>@lang('site.certificate')</h3>
         </div>
         <div class="clear"></div>
         <div class="row mt-2">
            @isset($certificate)
               @foreach ($certificate as $item)
                  <div class="col-md-2 mb-5">
                     <div class="card course-card hover-effect border-0">

                        <a href="{{route('certificate.detail',[$item['name'],Crypt::encryptString($item['id'])])}}"
                           class="badge bg-color bg h-bg-dark h-text-light all-ts py-2 px-3"
                           style="background-color:#83B341 ">{{ $item['name'] }}
                        </a>
   

                     </div>
                  </div>
               @endforeach
            @endisset
         </div>
      </div>
      <div class="wave-bottom"
           style="position: absolute; top: auto; bottom: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x; transform: rotate(180deg);">
      </div>
   </div>

@endsection


@section('script')
   <script src="{{URL::asset('assets/Canvas/js/jquery.js')}}"></script>


   <!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
   <script src="{{URL::asset('assets/Canvas/include/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
   <script src="{{URL::asset('assets/Canvas/include/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

   <!-- SLIDER REVOLUTION EXTENSIONS  -->
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.actions.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.carousel.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.migration.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.navigation.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.parallax.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
   <script
      src="{{URL::asset('assets/Canvas/include/rs-plugin/js/extensions/revolution.extension.video.min.js')}}"></script>



   <script>
       var revapi222,
           tpj;

       (function () {
           if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded", onLoad); else onLoad();

           function onLoad() {
               if (tpj === undefined) {
                   tpj = jQuery;
                   if ("off" == "on") tpj.noConflict();
               }

               if (tpj("#rev_slider_222_1").revolution == undefined) {
                   revslider_showDoubleJqueryError("#rev_slider_222_1");
               } else {
                   revapi222 = tpj("#rev_slider_222_1").show().revolution({
                       sliderType: "standard",
                       jsFileLocation: "{{URL::asset('assets/Canvas/include/rs-plugin/js/')}}",
                       sliderLayout: "fullwidth",
                       dottedOverlay: "none",
                       delay: 10000,
                       navigation: {
                           keyboardNavigation: "off",
                           keyboard_direction: "horizontal",
                           mouseScrollNavigation: "off",
                           mouseScrollReverse: "default",
                           onHoverStop: "off",
                           touch: {
                               touchenabled: "on",
                               touchOnDesktop: "off",
                               swipe_threshold: 75,
                               swipe_min_touches: 1,
                               swipe_direction: "horizontal",
                               drag_block_vertical: false
                           }
                           ,
                           arrows: {
                               style: "metis",
                               enable: true,
                               hide_onmobile: true,
                               hide_under: 778,
                               hide_onleave: false,
                               tmp: '',
                               left: {
                                   h_align: "left",
                                   v_align: "center",
                                   h_offset: 0,
                                   v_offset: 0
                               },
                               right: {
                                   h_align: "right",
                                   v_align: "center",
                                   h_offset: 0,
                                   v_offset: 0
                               }
                           }
                           ,
                           bullets: {
                               enable: true,
                               hide_onmobile: false,
                               style: "hermes",
                               hide_onleave: false,
                               direction: "horizontal",
                               h_align: "center",
                               v_align: "bottom",
                               h_offset: 0,
                               v_offset: 20,
                               space: 5,
                               tmp: ''
                           }
                       },
                       responsiveLevels: [1240, 1024, 778, 480],
                       visibilityLevels: [1240, 1024, 778, 480],
                       gridwidth: [1240, 1024, 778, 480],
                       gridheight: [700, 700, 700, 700],
                       lazyType: "none",
                       parallax: {
                           type: "scroll",
                           origo: "slidercenter",
                           speed: 400,
                           speedbg: 0,
                           speedls: 0,
                           levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                       },
                       shadow: 0,
                       spinner: "spinner5",
                       stopLoop: "off",
                       stopAfterLoops: -1,
                       stopAtSlide: -1,
                       shuffle: "off",
                       autoHeight: "off",
                       hideThumbsOnMobile: "off",
                       hideSliderAtLimit: 0,
                       hideCaptionAtLimit: 0,
                       hideAllCaptionAtLilmit: 0,
                       debugMode: false,
                       fallbacks: {
                           simplifyAll: "off",
                           nextSlideOnWindowFocus: "off",
                           disableFocusListener: false,
                       }
                   });
               }
               ; /* END OF revapi call */

               if (typeof ExplodingLayersAddOn !== "undefined") ExplodingLayersAddOn(tpj, revapi222);
           }; /* END OF ON LOAD FUNCTION */
       }()); /* END OF WRAPPING FUNCTION */
   </script>
@endsection
