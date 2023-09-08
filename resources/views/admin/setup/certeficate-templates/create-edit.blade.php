@extends('admin.layouts.master')
@section('title')
@lang('site.add new templates')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/tinymce/tinymce.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/switchery.min.css') }}">

    <style>
        .img_cont {
            position: relative;
            width: 150px;
            max-width: 400px;
        }

        .img_cont img {
            width: 150px;
            height: auto;
        }

        .img_cont .btn_remove {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: transparent;
            color: rgb(255, 0, 0);
            font-size: 16px;
            padding: 12px 24px;
            border: none;

            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            opacity: 0.7;
        }

        .img_cont .btn_remove:hover {
            background-color: rgb(255, 0, 0);
            opacity: 1;
            /* background-image: ft-trash-2; */

        }

        .my-editor {
            background-image: url('path/to/your/image.jpg');
            /* specify the path to your background image */
            background-size: cover;
            /* specify the desired background size */
        }
    </style>
@endsection
@section('content')
    <section id="form-repeater">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form id="certeficate_template" class="form row">
                                @csrf
                                <input type="hidden" name="id"
                                    value="@isset($certificate) {{ Crypt::encryptString($certificate['id']) }}}}@endisset">

                                <div class="col-md-3">
                                    <span>@lang('site.certeficate name') <span class="text-danger">*</span></span>

                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="@isset($certificate) {{ $certificate['name'] }} @endisset">
                                    </div>
                                    <span id="name_" class="text-danger"></span >
                                </div>

                                <div class="col-md-4">
                                    <span>@lang('site.status') <span class="text-danger">*</span></span>
                                    <div class="demo-checkbox">
                                        <fieldset>
                                             <div class="float-left">
                                                <input type="checkbox" value="1" @isset($certificate)  @if( $certificate['isactive']==1) checked @endif  @endisset class="switchBootstrap fee_"
                                                    id="md_checkbox_" data-on-text="Enable" data-off-text="Disable" name="isactive"/>
                                            </div>
                                            <label for=""
                                                class="font-medium-2 text-bold-600 mr-1 text-success"></label>
                                            <label for="md_checkbox_"></label>
                                        </fieldset>

                                    </div>
                                </div>  {{----}}
                                {{-- <div class="col-md-4">
                                    <span>@lang('site.can anyone search using the barcode of the certificate?') <span class="text-danger">*</span></span>
                                    <div class="demo-checkbox">
                                        <fieldset>
                                          <div class="float-left">
                                             <input type="checkbox" value="1" @isset($certificate)  @if( $certificate['availabletosearche']==1) checked @endif  @endisset class="switchBootstrap fee_"
                                                 id="md_checkbox_" data-on-text="Enable" data-off-text="Disable" name="availabletosearche" />
                                         </div>
                                          
                                            <label for=""
                                                class="font-medium-2 text-bold-600 mr-1 text-success"></label>
                                            <label for="md_checkbox_"></label>
                                        </fieldset>

                                    </div>
                                </div>   --}}
                                {{-- <div class="form-group col-md-4">
                                    <label for="email-addr">@lang('site.background image')</label>
                                    <fieldset class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="global_image" class="custom-file-input"
                                                id="global_image_file_id"
                                                onchange="readURL(this,'global_image_prev','global_image_id');">
                                            <label class="custom-file-label" for="global_image_id">Choose file</label>

                                        </div>
                                    </fieldset>
                                    @isset($categorie['global_image'])
                                        <div class="img_cont" id="global_image_view">
                                            <img id="global_image" src="{{ asset($categorie['global_image']) }}"
                                                alt="your image" width="150px" height="150px" />
                                            <a onclick="delete_from_callery_by_id('{{ route('admin.categories.delete.image') }}',{{ $categorie['id'] }},'','global_image_view','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                                class="btn_remove"><i class="fa fa-close"></i></a>
                                        </div>
                                    @endisset
                                </div> --}}

                                <br>

                                <table class="table-responsive">
                                    <tr>
                                        <td style="width: 25%"> @lang('site.list of variable can be used for certificate') @lang('site.use it with "{}" ') </td>
                                        <td style="width: 75%"> <span class="text-warning">
                                                @foreach (certifcate_variable() as $key => $value)
                                                    {{ $value }}  ,
                                                @endforeach
                                            </span></td>
                                    </tr>

                                </table>

                                <div class="col-md-12">
                                    <span for="">@lang('site.build your templates here') <span class="text-danger">*</span></span>
                                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                        <div class="card collapse-icon accordion-icon-rotate">


                                            <div id="accordion115" role="tabpanel" aria-labelledby="heading115"
                                                class="collapse show">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <textarea name="certeficate_template_editor" id="certeficate_template_editor" class="tinymce">
                                                         @isset($certificate) 
                                                       {{$certificate['template']}}
                                                    @endisset
                                                                </textarea>
                                                        <span id="certeficate_template_editor_" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @php $array_id_tiny[] =  'certeficate_template_editor'   @endphp

                            <a onclick="submit_certeficate('{{ route('admin.certificate.templates.create.update') }}', 'certeficate_template') ;"
                                class="btn btn-outline-success no-border"><i class="fa fa-check">@lang('site.save')</i></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>


    <script src="{{ URL::asset('assets/tinymce/tinymce/tinymce.js') }}"></script>
    <script src="{{ URL::asset('assets/tinymce/editor-tinymce.js') }}"></script>


    <script src="{{ URL::asset('assets/switcher/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/switcher/js/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/switcher/js/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/switcher/js/switch.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('assets/custome_js/categories.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/categories.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script type="text/javascript"></script>
@endsection
