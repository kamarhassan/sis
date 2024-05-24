@extends('admin.layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    @lang('site.admin report action')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/handsontable/handsontable.full.min.css') }}">
@endsection

@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content collpase show">

                        <div class="row">
                            @can('enable or disable marks')
                                <div class="col-md-2">

                                    <a href="#"
                                        onclick="submit('{{ route('disable.enable.take.marks') }}','admin_action_to_marks');"
                                        class="hover hover-primary">@lang('site.disable or enable take marks')<i class="ti ti-reload">
                                        </i>
                                    </a>
 

                                    @if ($status == 1)
                                        <div class="box-body ribbon-box">
                                            <div class="ribbon ribbon-success">@lang('site.is active for insert marks')</div>
                                        </div>
                                    @else
                                        <div class="box-body ribbon-box">
                                            <div class="ribbon ribbon-success">@lang('site.is not active for insert marks')</div>
                                        </div>
                                    @endif
                                </div>
                            @endcan
                            @can('reset marks')
                                <div class="col-md-2"><a href="#"
                                        onclick="reset_marks_by_id('{{ route('reset.marks') }}','{{ Crypt::encryptString($header_marks_id) }}','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                        class="hover hover-primary">@lang('site.reset marks') <i class="ti ti-reload">
                                        </i>
                                    </a>
                                </div>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-content collpase show">
                        <div class="card-body card-dashboard">
                            <form id='admin_action_to_marks'>
                                @csrf
                                <input type="hidden" name="header_marks_id" id=""
                                    value="{{ Crypt::encryptString($header_marks_id) }}">
                                <input type="hidden" name="cours_id" id=""
                                    value="{{ Crypt::encryptString($cours_id) }}">
                            </form>

                            <div id="handsontable" class="hot handsontable htColumnHeaders"></div>


                            <br>
                            <span id="error_marks" class="text-danger">
                                <div id="erro_show"></div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/handsontable/handsontable.full.min.js') }}"></script>

    <script>
        var head = @json($header_marks);
        var dataset = @json($studentsdata);
        var columns = @json($columns);

        var columnsToColor = @json($columnsToColor);


        $(document).ready(function() {
            var columnsdata = [];
            var datatype = null;
            var isreadonly = null;
            var key = 0;

            columns.forEach((element) => {

                columnsdata.push({
                        data: element.data,
                        type: element.type,
                        readOnly: element.readOnly,
                        validator: (value, callback, max = element.marks) => {
                            if (value > max || value < 0) {
                                callback(false);

                            } else {
                                callback(true);
                            }
                        }
                    }


                )
            });

            console.table(columnsToColor);


            const save = document.querySelector('#save');
            const container = document.getElementById('handsontable');
            const hyperformulaInstance = HyperFormula.buildEmpty({
                licenseKey: 'internal-use-in-handsontable',
            });
            const hot = new Handsontable(container, {

                data: dataset,
                colHeaders: true,
                colHeaders: head,
                rowHeaders: true,
                renderAllRows: true,
                height: 'auto',
                columns: columnsdata,
                fixedColumnsStart: 2,
                cells: function(row, col, prop) {
                    var cellProperties = {};

                    if (columnsToColor.indexOf(col) !== -
                        1) { // Check if the column should have background color
                        cellProperties.renderer = function(instance, td, row, col, prop, value,
                            cellProperties) {
                            Handsontable.renderers.TextRenderer.apply(this, arguments);
                            td.style.backgroundColor = 'lightblue'; // Set the background color
                        };
                    }

                    return cellProperties;
                },
                formulas: {
                    engine: hyperformulaInstance,
                    sheetName: 'Sheet1'
                },
                readOnly: true,
                hiddenColumns: {
                    indicators: true
                },
                //  contextMenu: true,

                licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
            });

            save.addEventListener('click', () => {
                // save all cell's data
                var url = '{{ route('admin.post.students.and.marks') }}';
                SubmitHandsonTable(url, hot.getData(), '{{ csrf_token() }}', {{ $cours_id }})
            });




        });


        function columns_marks_data_type(headmarks) {

            var columnsdata = [];
            var datatype = null;
            var isreadonly = null;
            var key = 0;
            headmarks.forEach((element) => {
                console.log(element.data); // 100, 200, 300
                columnsdata[key++] = [
                    data => element.data,
                    type => element.type,
                    readOnly => element.readOnly,
                    validator => (value, callback, max = element.marks) => {
                        if (value > max || value < 0) {
                            callback(false);

                        } else {
                            callback(true);
                        }
                    }
                ]
            });

            return columnsdata;
        }
    </script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
@endsection
