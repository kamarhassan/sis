@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/vendors/css/forms/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/css/plugins/forms/selectize/selectize.css') }}">
    {{-- <link rel="stylesheet" type="text/css"
href="{{ URL::asset('assets/app-assets/vendors/css/file-uploaders/dropzone.min.css') }}"> --}}


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
        .spanner {
            position: absolute;
            top: 50%;
            left: 0;
            /* background: #2a2a2a; */
            width: 100%;
            display: block;
            text-align: center;
            height: 300px;
            color: rgb(245, 39, 39);
            transform: translateY(-50%);
            z-index: 1000;
            visibility: hidden;
        }

        .overlay {
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

        .show {
            visibility: visible;
        }

        .spanner,
        .overlay {
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        .spanner.show,
        .overlay.show {
            opacity: 1
        }
    </style>
@endsection

@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body card-dashboard">
                            @include('admin.students.students_registration-by-teahcer.by-form')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')

    <script src="{{ URL::asset('assets/custome_js/get_info_user.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/import_std.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript">
    </script>



    <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/scripts/forms/form-repeater.js') }}" type="text/javascript">
    </script>
@endsection
