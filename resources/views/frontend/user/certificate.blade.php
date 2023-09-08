@extends('frontend.layouts.user-dashboard')
@section('title')
@endsection
@section('css')
    <style>
        /* .body{
              background-color: red
           } */
    </style>
@endsection
@section('user-content')
   
      

        <div class="row">
<div id="certeficate_templates"></div>
           
           {{-- {!! html_entity_decode($t) !!}  --}}
        
    </div>
@endsection


@section('script')
<script>
     $(document).ready(function() {
      $('#certeficate_templates').append(@json($t)).html();
   });
</script>
@endsection
