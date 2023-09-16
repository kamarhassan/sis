@extends('admin.layouts.master')
@section('title')
   @lang('site.add general marks')
@endsection
@section('css')
    @livewireStyles()
@endsection

@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content collpase show">
                        <div class="card-body card-dashboard">

                            <form id='marks_form'>
                                @csrf
                                <div class="add_item">
                                    <div class="row">
                                        <input type="hidden" name="cours_id" value="{{ $cours_id }}">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="marks_name">@lang('site.marks name') <span class="text-danger">*</span>
                                                </label>
                                                <br>
                                                <input name="marks_name[]" type="text" class="form-control"
                                                    id="marks_name">
                                                <span class="text-danger" id="marks_name_0_"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="marks">@lang('site.Marks') <span class="text-danger">*</span>
                                                </label>
                                                <br>
                                                <input name="marks[]" type="number" class="form-control" id="marks">
                                                <span class="text-danger" id="marks_0_"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="marks_percent">@lang('site.percent')<span
                                                        class="text-danger">*</span> </label>
                                                <br>
                                                <input name="percent[]" type="number" class="form-control"
                                                    id="marks_percent">
                                                <span class="text-danger" id="percent_0_"></span>
                                            </div>
                                        </div> 
                                       <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="marks_percent">@lang('site.is group')  </label>
                                                <br>
                                                <input name="group[]" type="number" class="form-control"
                                                    id="group">
                                                <span class="text-danger" id="group_0_"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-top: 25px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <div class="col-md-3">
                                <a class="btn btn-float bbt btn-square btn-outline-success fa fa-plus-circle"
                                    title="@lang('site.save')"
                                    onclick="submit('{{ route('admin.store.marks.cours') }}','marks_form');">
                                    <span class=""> @lang('site.save')</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="marks_name">@lang('site.marks name') <span class="text-danger">*</span>
                            </label>
                            <br>
                            <input name="marks_name[]" type="text" class="form-control" id="marks_name_number">
                            <span class="text-danger" id="marks_name_number_error"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="marks">@lang('site.Marks') <span class="text-danger">*</span>
                            </label>
                            <br>
                            <input name="marks[]" type="number" class="form-control" id="marks_number">
                            <span class="text-danger" id="marks_number_error"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="marks_percent">@lang('site.percent') <span class="text-danger">*</span> </label>
                            <br>
                            <input name="percent[]" type="number" class="form-control" id="marks_percent_number">
                            <span class="text-danger" id="marks_percent_number_error"></span>
                        </div>
                    </div>
                   <div class="col-md-1">
                      <div class="form-group">
                         <label for="marks_percent">@lang('site.is group')  </label>
                         <br>
                         <input name="group[]" type="number" class="form-control"
                                id="group_number">
                         <span class="text-danger" id="group_number_error"></span>
                      </div>
                   </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus"></i> </span>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var counter = 1;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);

                $("#marks_name_number").attr("id", "marks_name_" + counter);
                $("#marks_name_number_error").attr("id", "marks_name_" + counter + "_");

                $("#marks_number").attr("id", "marks_" + counter);
                $("#marks_number_error").attr("id", "marks_" + counter + "_");

           

                $("#marks_percent_number").attr("id", "percent_" + counter);
                $("#marks_percent_number_error").attr("id", "percent_" + counter + "_");
                
                
                $("#group_number").attr("id", "percent_" + counter);
                $("#group_number_error").attr("id", "percent_" + counter + "_");





                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });
        });
    </script>



    <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
@endsection
