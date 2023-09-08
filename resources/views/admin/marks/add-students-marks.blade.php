@extends('admin.layouts.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
   @lang('site.add students marks')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/handsontable/handsontable.full.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/vendors/css/tables/handsontable/handsontable.full.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/css-rtl/plugins/tables/handsontable.css') }}"> --}}
@endsection

@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content collpase show">
                        <div class="card-body card-dashboard">


                            <div id="handsontable" class="hot handsontable htColumnHeaders"></div>

                            {{-- <button  class="button button--primary button--blue">Save data</button> --}}
                            @if ($status_of_insert_and_update_marks == 1)
                                <a id="save" type="submit" class="btn btn-close btn-success btn-round fa fa-save">
                                    <i class="ft-check"></i> @lang('site.save')

                                </a>
                            @endif
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


    {{-- <script src="{{ URL::asset('assets/app-assets/vendors/js/tables/handsontable/handsontable.full.js') }}"
        type="text/javascript"></script>

    <script src="{{ URL::asset('assets/app-assets/js/scripts/tables/handsontable/handsontable-cell-types.js') }}"
        type="text/javascript"></script> --}}



    <script>
        var head = @json($header_marks);
        var dataset = @json($studentsdata);
        var columns = @json($columns);






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

            console.table(columnsdata);


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
                fixedColumnsStart: 1,
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
@endsection
