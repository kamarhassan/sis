@extends('admin.layouts.master')
@section('css')
    <style>
             /* .dz-max-files-reached {
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
        */
        .spanner{
          position:absolute;
          top: 50%;
          left: 0;
          /* background: #2a2a2a; */
          width: 100%;
          display:block;
          text-align:center;
          height: 300px;
          color: rgb(245, 39, 39);
          transform: translateY(-50%);
          z-index: 1000;
          visibility: hidden;
        }
        
        .overlay{
          position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);

          visibility: hidden;
        }
        
        .loader,
        .loader:before,
        .loader:after {
          border-radius: 50%;
          width: 2.5em;
          height: 2.5em;
          -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
          -webkit-animation: load7 1.8s infinite ease-in-out;
          animation: load7 1.8s infinite ease-in-out;
        }
        .loader {
          color: #ff0000;
          font-size: 10px;
          margin: 80px auto;
          position: relative;
          text-indent: -9999em;
          -webkit-transform: translateZ(0);
          -ms-transform: translateZ(0);
          transform: translateZ(0);
          -webkit-animation-delay: -0.16s;
          animation-delay: -0.16s;
        }
        .loader:before,
        .loader:after {
          content: '';
          position: absolute;
          top: 0;
        }
        .loader:before {
          left: -3.5em;
          -webkit-animation-delay: -0.32s;
          animation-delay: -0.32s;
        }
        .loader:after {
          left: 3.5em;
        }
        @-webkit-keyframes load7 {
          0%,
          80%,
          100% {
            box-shadow: 0 2.5em 0 -1.3em;
          }
          40% {
            box-shadow: 0 2.5em 0 0;
          }
        }
        @keyframes load7 {
          0%,
          80%,
          100% {
            box-shadow: 0 2.5em 0 -1.3em;
          }
          40% {
            box-shadow: 0 2.5em 0 0;
          }
        }
        
        .show{
          visibility: visible;
        }
        
        .spanner, .overlay{
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }
        
        .spanner.show, .overlay.show {
            opacity: 1
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
