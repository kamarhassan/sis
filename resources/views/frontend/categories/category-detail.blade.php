@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
   <style>
      .customecenter {
         padding: 70px 0;
         border: 3px solid green;
         text-align: center;
      }
   </style>
   {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
       integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
@endsection

@section('content')
   <div class="row justify-content-center">
      <div class="col-md-9">
         @if (Session::has('error'))

          

            <div class="style-msg errormsg">
               <div class="sb-msg"><i class="bi-x-lg"></i><strong>{{ Session::get('error') }}</strong></div>
            </div>






         @endif
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
