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
                            <div class="col-md-2"><a href="#"
                                    onclick="submit('{{ route('disable.enable.take.marks') }}','admin_action_to_marks');"
                                    class="hover hover-primary">disble edit or insrt <i class="ti ti-reload"></i></a></div>
                            <div class="col-md-2"><a href="#"
                                    {{-- onclick="delete('{{ route('reset.marks') }}','admin_action_to_marks');" --}}
                                      onclick="reset_marks_by_id('{{ route('reset.marks') }}','{{ Crypt::encryptString($header_marks_id) }}','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                    class="hover hover-primary">reset</a></div>
                            {{-- <div class="col-md-2"><a onclick="submit('{{ route('admin.store.marks.cours') }}','admin_action_to_marks');">print</a></div> --}}
                            {{-- <div class="col-md-2"><a href="#"
                                    onclick="submit('{{ route('export.marks') }}','admin_action_to_marks');"
                                    class="hover hover-primary">export</a></div> --}}
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

                            {{-- <button  class="button button--primary button--blue">Save data</button> --}}

                            {{-- <a id="save" type="submit" class="btn btn-close btn-success btn-round fa fa-save">
                                <i class="ft-check"></i> @lang('site.save')
                                
                            </a> --}}
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
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
@endsection
