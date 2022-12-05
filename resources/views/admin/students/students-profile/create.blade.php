@extends('admin.layouts.master')
@section('css')
    <style>
        .dz-max-files-reached {
            background-color: red
        }

        

        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="col-12">
        <div class="box box-default">
            <div class="box-body">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#by_from" role="tab"><span><i
                                    class="ion-person"></i></span> <span
                                class="hidden-xs-down ml-15">@lang('site.insert student by fill form')</span></a> </li>
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#by_import"
                            role="tab"><span><i class="fa fa-file-excel-o"></i></span> <span
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

    <script src="{{ URL::asset('assets/custome_js/import_std.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/dropzone/dropzone.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
@endsection
