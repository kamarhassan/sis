@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>

        <div class="box-body">
            <div id="example"></div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        var dataset = @json($dataset);
        var header = @json($header_column);
        // var colummns_type = @json($colummns_type);
        // function t() {
        //     const data = [
        //         ['', 'Tesla', 'Volvo', 'Toyota', 'Ford'],
        //         ['2019', 10, 11, 12, 13],
        //         ['2020', 20, 11, 14, 13],
        //         ['2021', 30, 15, 12, 13]
        //     ];

        //     const container = document.getElementById('example');
        //     const hot = new Handsontable(container, {
        //         data: dataset,
        //         rowHeaders: true,
        //         colHeaders: true,
        //         height: 'auto',
        //         licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
        //     });
        // }

        $(document).ready(function() {
            // console.log(colummns_type);
            colummns_type = {
                data: '2022-10-07',
                type: 'numeric'
            };

            const container = document.getElementById('example');
            const hot = new Handsontable(container, {
                data: dataset,
                rowHeaders: true,
                // colHeaders: true,            
                colHeaders: header,
                columns: {
                    data: '2022-10-07',
                    type: 'numeric'
                },
                height: 'auto',
                fixedColumnsStart: 1,
                // readOnly: true,
                licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
            });
        });
    </script>
@endsection
