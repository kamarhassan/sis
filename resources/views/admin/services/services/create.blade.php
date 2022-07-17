@extends('admin.layouts.master')

@section('css')
    @livewireStyles()
@endsection

@section('content')
    {{-- <div class="wrapper"></div>z --}}

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">@lang('site.services')</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-12 col-lg-5 col-xl-6">
                    <form id='services_form'>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h5>@lang('site.services') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="services_0" name="services[]" class="form-control">
                                                    <span class="text-danger" id="services.0"> </span>
                                                </div>
                                            </div>
                                        </div><!-- End col-md-5 -->
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i>
                                            </span>
                                        </div><!-- End col-md-5 -->
                                    </div> <!-- end Row -->
                                </div> <!-- // End add_item -->
                                <div class="text-xs-right">


                                    <a class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                                        onclick="services('{{ route('admin.Services.store') }}')">

                                        <span class=""> @lang('site.next step')</span>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="col-12 col-lg-5 col-xl-6">

                    <div class="table-responsive">
                        <table id="example1" class="table  table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.services') </th>
                                    <th>@lang('site.options') </th>
                                </tr>
                            </thead>
                            <tbody>
                                 @isset($grade)
                                    @foreach ($grade as $key => $grades)
                                        <tr class="Row{{ $grades->id }} ">
                                            @csrf
                                            <td> {{ $key + 1 }} </td>
                                            <td>
                                                <label id="label_{{ $grades->id }}">
                                                    <span> {{ $grades->grade }}</span>
                                                </label>
                                            </td>
                                            <td>
                                                <a token="{{ csrf_token() }}"
                                                    onclick="change_to_update({{ $grades->id }},'{{ $grades->grade }}','{{ route('admin.grades.update') }}', '{{ csrf_token() }}');"
                                                    class="btn fa fa-edit" title="@lang('site.edit')"
                                                    id="btn_editable_{{ $grades->id }}">

                                                </a>
                                                <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash"
                                                    title="@lang('site.delete')"
                                                    onclick="delete_by_id('{{ route('admin.grades.delete') }}',{{ $grades->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </section>
    </div>
    </div>


    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>@lang('site.services') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" id="services_number" name="services[]" class="form-control">
                                <span class="text-danger" id="services_number_error"> </span>
                            </div>
                        </div>

                    </div><!-- End col-md-5 -->
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 1;
            $(document).on("click", ".addeventmore", function() {
                // var field = document.getElementById("grade");// get element named grade from hidde form
                // field.id = "horse"; // using element properties
                // field.setAttribute("name", "grade["+counter+"]"); // rename grade to grade[index] to validate an array

                //  console.log()
                var whole_extra_item_add = $('#whole_extra_item_add').html();

                $(this).closest(".add_item").append(whole_extra_item_add);
                $("#services_number").attr("id", "services_" + counter);
                $("#services_number_error").attr("id", "services." + counter);

                // $(this).closest(".add_item").attr("id","whole_extra_item_add_"+counter);;

                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });

        });
    </script>

    <script src="{{ URL::asset('assets/custome_js/services.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/update.js') }}"></script>

    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script>
@endsection
