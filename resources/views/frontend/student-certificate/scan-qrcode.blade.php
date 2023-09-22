@extends('frontend.layouts.master')

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
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div id="certeficate_templates"></div>
                <div class="card">

                    {!! $template !!}
                    {{-- {!! $certificate_barcode['certificate_barcode'] !!} --}}
                    {{-- {!! $certificate_barcode['certificate_barcode'] !!} --}}
                    {{-- {{$certificate_barcode['certificate_barcode'] }} --}}

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src=""></script>
    <script src="{{ URL::asset('assets/Canvas/js/components/bs-datatable.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#datatable1').dataTable([
                searching: false,
                paging: false,

            ]);
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".mark_table").append(@json($mark))
                .html(); // it class not an id beacuse if i have two table of mark 
        });
    </script>
@endsection
