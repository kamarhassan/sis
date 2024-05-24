@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
@endsection


@section('content')
   <div class="section bg-transparent" style="padding: 60px 0 40px;">
      <div class="container">


         <div class="clear"></div>

         <div class="row">


            @isset($teams)
               @foreach ($teams as $team)
{{--                  {{dd($team['info'])}}--}}
                  <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="feature-box hover-effect shadow-sm fbox-center fbox-bg fbox-light fbox-lg fbox-effect">
                        <div class="fbox-icon" style=" width: 230px; height: 200px;">
                           <i><img src="{{asset($team['photo'])}}" class="border-0 bg-transparent shadow-sm"
                                   style="z-index: 2;" alt="Image"></i>
                        </div>
                        <div class="fbox-content">
                           <h3 class="mb-4 text-transform-none ls-0"><a href="#" class="text-dark">
                                 <strong>@isset($team['info']['name']){{$team['info']['name']}}@endisset</strong></a><br>
                              <small class="subtitle text-transform-none color"></small></h3>
                           <p class="text-dark">@isset($team['shortdescription']){{$team['shortdescription']}}@endisset</p>
                        </div>
                     </div>
                  </div>
               @endforeach
            @endisset


         </div>
      </div>
   </div>
@endsection


@section('script')
@endsection
