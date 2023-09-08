@extends('admin.layouts.master')
@section('title')
@lang('site.attendance reports')
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/handsontable/handsontable.full.min.css') }}">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        @if ($dataset != null && $header_column != null && $header_name != null )
            <div class="box-body">
                <div id="example">
                </div>
            </div>
        @endif
    </div>
@endsection


@section('script')
<script src="{{ URL::asset('assets/handsontable/handsontable.full.min.js') }}"></script>

<script src="{{ URL::asset('assets/custome_js/attendance.js') }}"></script>
    <script>
        var dataset = @json($dataset);
        var header = @json($header_column);
        var header_name = @json($header_name);   
        $(document).ready(function() {
            attendance_report(dataset,header,header_name)
        });
    </script>
@endsection
