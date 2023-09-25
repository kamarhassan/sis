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
    
        var header_name = @json($header_name)
        
        $(document).ready(function() {
            // attendance_report(dataset,header,header_name)


            const container = document.getElementById('example');
            const hyperformulaInstance = HyperFormula.buildEmpty({
                // to use an external HyperFormula instance,
                // initialize it with the `'internal-use-in-handsontable'` license key
                licenseKey: 'internal-use-in-handsontable',
            });
            const hot = new Handsontable(container, {
                data: dataset,
                rowHeaders: true,
              
                colHeaders: header_name,
                height: 'auto',
                fixedColumnsStart: 1,
                formulas: {
                    engine: hyperformulaInstance,
                    sheetName: 'Sheet1'
                },
                readOnly: true,
                licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
            });
        
        
        
        });
    </script>
@endsection
