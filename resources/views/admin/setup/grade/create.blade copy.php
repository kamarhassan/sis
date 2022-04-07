@extends('admin.layouts.master')
@section('css')
    @livewireStyles()
@endsection
@section('content')
    {{-- <div class="wrapper"></div>z --}}
@php
 $counter=0;
@endphp

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">@lang('site.add new grade')</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="{{ route('admin.grades.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="grades[].{{ $counter}}" class="form-control">
                                                </div>
                                            </div>
                                            @error('grades[].{{ $counter}}')
                                            <span class="text-danger">{{$message}} </span>
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
                    </form>
                </div>
                <!-- /.col -->
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
                            <h5>@lang('site.grade') <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="grades[].{{ $counter  }}" class="form-control">
                            </div>
                        </div>
                        @error('grades[].{{ $counter}}')
                        <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div><!-- End col-md-5 -->
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->
                </div>
            @endsection

            @section('script')
                <script type="text/javascript">
                    $(document).ready(function() {
                        var counter = 0;
                        $(document).on("click", ".addeventmore", function() {
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
            @endsection
@php
    $counter = @jeson
@endphp
