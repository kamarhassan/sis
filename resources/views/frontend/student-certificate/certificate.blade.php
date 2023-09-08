
@extends('frontend.layouts.User.user-daschoard-master')

@section('title')
@endsection
@section('css')
    <style>
        /* .body{
                      background-color: red
                   } */
    </style>
@endsection
@section('content')
    <div class="row">
        <div id="certeficate_templates"></div>
        <div class="card">

        {!! $template !!}
        {!! $certificate_barcode['certificate_barcode'] !!}
     {{-- {!! $certificate_barcode['certificate_barcode'] !!} --}}
       {{-- {{$certificate_barcode['certificate_barcode'] }} --}}
 
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
             $(".mark_table").append(@json($mark)).html(); // it class not an id beacuse if i have two table of mark 
        });
    </script>
@endsection
