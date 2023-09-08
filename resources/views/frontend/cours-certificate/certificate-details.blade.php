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
   

   

   <div class="section mt-6 parallax" style="padding: 80px 0 60px;">
      <div class="parallax-bg" style="background: url('assets/Canvas/demos/course/images/icon-pattern.jpg') repeat;">
      </div>
      <div class="wave-top"
           style="position: absolute; top: 0; left: 0; width: 100%; background-image: url('assets/Canvas/demos/course/images/wave-3.svg'); height: 12px; z-index: 2; background-repeat: repeat-x;">
      </div>
      <div class="container">
         <div class="heading-block border-bottom-0 mb-5 text-center">
            <h3>@lang('site.cours available for this certificate')</h3>
         </div>
         <div class="clear"></div>
         <div class="row mt-2">
            @isset($categories)
               @foreach ($categories as $item)
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
 

@endsection


@section('script')
   
@endsection
