@extends('admin.layouts.master')
@section('css')
    <style>
        .dz-max-files-reached {
            background-color: red
        }

        ;
    </style>
@endsection
@section('content')
    {{-- <div class="wrapper"></div>z --}}

    <div class="col-12">
        <div class="box box-default">


            <div class="box-body">

                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#by_from" role="tab"><span><i
                                    class="ion-person"></i></span> <span
                                class="hidden-xs-down ml-15">@lang('site.insert student by fill form')</span></a> </li>
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#by_import" role="tab"><span><i
                                    class="fa fa-file-excel-o"></i></span> <span
                                class="hidden-xs-down ml-15">@lang('site.insert student by import')</span></a>
                    </li>
                </ul>
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane " id="by_from" role="tabpanel">
                        @include('admin.students.students-profile.by-form')
                    </div>
                    <div class="tab-pane active" id="by_import" role="tabpanel">
                        @include('admin.students.students-profile.by-import')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        // imoprt_students_file
        // my-awesome-dropzone
        // Dropzone.options.imoprtStudentsFile = {
        //     maxFiles: 1,
        //     accept: function(file, done) {
        //         console.log("uploaded");
        //         done();
        //     },
        //     init: function() {
        //         this.on("maxfilesexceeded", function(file) {
        //             alert("No more files please!");
        //         });
        //     }
        // };
    </script>
    <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/dropzone/dropzone.js') }}"></script>
@endsection
