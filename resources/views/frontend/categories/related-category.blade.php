

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
   {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/app-assets/css-rtl/plugins/animate/animate.css') }}"> --}}
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
            <h3>@lang('site.related categories')</h3>
         </div>
         <div class="clear"></div>
         <div class="row mt-2">
            @isset($related_category_by_tag)
               @foreach ($related_category_by_tag as $item)
                  <div class="col-md-4 mb-5">
                     <div class="card course-card hover-effect border-0">
                  
                        <a href="{{ route('show.categorie.details_by_id', $item['id']) }}"><img class="card-img-top" src="{{ asset($item['global_image']) }}"
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


















