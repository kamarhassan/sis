@extends('admin.layouts.master')

@section('css')
    @livewireStyles()
@endsection

@section('content')
    {{-- <div class="wrapper"></div>z --}}

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">@lang('site.add new level')</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
<div class="row">
  <div class="col-12 col-lg-5 col-xl-6">
                    <form method="post" action="{{ route('admin.level.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h5>@lang('site.levels') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="level[]" class="form-control">
                                                </div>
                                            </div>
                                            @error('levelss[]')
                                                <span class="text-danger">{{ $message }} </span>
                                            @enderror
                                        </div><!-- End col-md-5 -->
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i>
                                            </span>
                                        </div><!-- End col-md-5 -->
                                    </div> <!-- end Row -->
                                </div> <!-- // End add_item -->
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="@lang('site.save')">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-5 col-xl-6">
                    <div class="table-responsive">
                        <table id="example1" class="table  table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.level') </th>
                                    <th>@lang('site.options') </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($level)
                                    @foreach ($level as $key => $levels)
                                        {{-- <form method="post" id="levels_data" action="{{ route('admin.grades.update') }}"> --}}
                                        <tr class="Row{{ $levels->id }} ">

                                            @csrf
                                            <td> {{ $key + 1 }} </td>
                                            <td>
                                                <label id="label_{{ $levels->id }}">
                                                    <span> {{ $levels->level }}</span>
                                                </label>
                                            </td>
                                            <td>
                                                <a token="{{ csrf_token() }}"
                                                    onclick="change_to_update_level({{ $levels->id }},'{{ $levels->level }}','{{ route('admin.level.update') }}', '{{ csrf_token() }}');"
                                                    class="btn fa fa-edit" title="@lang('site.edit')"
                                                    id="btn_editable_{{ $levels->id }}">
                                                    {{-- @lang('site.edit') --}}
                                                </a>

                                                <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash"
                                                    title="@lang('site.delete')"
                                                    onclick="delete_by_id('{{ route('admin.level.delet') }}',{{ $levels->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">


                                                </a>
                                                {{-- <a token="{{ csrf_token() }}" lang_id="{{ $grades->id }}"
                                                    class="delete_btn btn btn-close btn-danger btn-round fa fa-times"
                                                    title="@lang('site.delete')"
                                                    onclick=" delete_by_id_test('{{ json_encode(swal_fire_msg()) }}');">


                                                </a> --}}

                                            </td>

                                        </tr>
                                    @endforeach
                                @endisset


                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->




    <div style="visibility: hidden;">

        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" id="grade" name="level[]" class="form-control">
                            </div>
                        </div>
                        @error('grades[]')
                            <span class="text-danger">{{ $message }} </span>
                        @enderror
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
                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });

        });
    </script>

    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/update.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}">
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/toastr.js') }}"></script> --}}
@endsection
