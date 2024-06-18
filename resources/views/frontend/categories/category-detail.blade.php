@extends('frontend.layouts.master')
@section('title')
@endsection
@section('meta')
   
   
   <meta property="og:title" content="{{ $category['name'] }}">
   <meta property="og:image" content="{{ asset($category['global_image']) }}" type="image/x-icon">
   <meta  property="og:description" content="{{ $category['shorte_description'] }}">
   <meta property="og:image:width" content="1200"> <!-- Optional, specify the image width in pixels -->
   <meta property="og:image:height" content="630">

   <link rel="icon" href="{{ $category['name'] }}" type="image/x-icon">
@endsection

@section('css')
   <style>
      .customecenter {
         padding: 70px 0;
         border: 3px solid green;
         text-align: center;
      }
      .img_categorie {
         position: fixed; /* Fix the wrapper to the viewport */
         top: 0;
         left: 0;
         /*width: 100vw;*/
         /*height: 100vh;*/
         display: flex; /* Make the wrapper a flex container */
         justify-content: center; /* Center content horizontally */
         align-items: center
      }
   </style>
   {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
       integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
@endsection

@section('content')
   <div class="row justify-content-center">
      <div class="col-md-9">
{{--         {{dd($category)}}--}}
      
         @include('frontend.categories.category-details-sub-blade.category-tab')
         @include('frontend.categories.category-details-sub-blade.available-class')
         @include('frontend.categories.category-details-sub-blade.tag')


      </div>

      @endsection


      @section('script')
         {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script> --}}
         <script></script>
@endsection
