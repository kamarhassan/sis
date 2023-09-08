@extends('admin.layouts.master')
@section('title')
    @lang('site.cms footer')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/selectize/css/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('Modules/Cms/assets/selectize/css/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Modules/Cms/assets/selectize/css/selectize/selectize.css') }}">
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
    </style>
@endsection
@section('content')
    <div class="box">
        <div class="box-body">
            <form action="" id="blogs">
                @csrf

                @isset($blog['id'])
                    <input type="hidden" name="id" value="{{ $blog['id'] }}">
                @endisset
                <div class="row">

                    <div class="col-md-8 ">
                        <div class="primary_input mb-25">
                            <label class="form-section">@lang('site.name')
                            </label> <span class="text-danger">*</span>
                            <input class="form-control" type="text" name="title" onkeyup="setSlug();" id="title"
                                autocomplete="off"
                                value="@isset($blog['title']){{ $blog['title'] }} @endisset">

                            <span id="title_" class="text-danger"></span>
                        </div>
                    </div>
                    @isset($blog['status'])
                        <div class="col-md-4">
                            <label class="form-section">@lang('site.status') </label>
                            <div class="form-group">

                                <div class="box-controls pull-left">
                                    <label class="switch switch-border switch-success">
                                        <span class="text-success">@lang('site.is active') </span>
                                        <input type="checkbox" value="1" name="status" id="active"
                                            @if ($blog['status'] == 1) checked @endif />
                                        <span class="switch-indicator"></span>
                                        <label for="switcheryColor4" class="card-title ml-1"> </label>
                                        <span class="text-danger">@lang('site.is not active')</span>
                                        <span class="text-danger" id="active_"> </span>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
                <div class="col-lg-12  ">
                    <div class="primary_input mb-25">
                        <label class="form-section">@lang('site.description')
                        </label> <span class="text-danger">*</span>


                        <textarea name="description" id="description" class="tinymce">
                              @isset($blog['description'])
{{ $blog['description'] }}
@endisset
                        </textarea>

                        <span id="description_" class="text-danger"></span>
                    </div>
                </div>



                <div class="row col-lg-12">

                    <div class="col-lg-4  ">
                        <div class="primary_input mb-25">
                            <label class="form-section">@lang('site.slug')
                            </label> <span class="text-danger">*</span>
                            <input class="form-control" type="text" name="slug" id="slug" autocomplete="off"
                                value="@isset($blog['slug']){{ $blog['slug'] }} @endisset">

                            <span id="slug_" class="text-danger"></span>
                        </div>
                    </div>




                    <div class="col-lg-4">
                       <label class="form-section">@lang('site.blog category') </label>
                        <div class="input-effect">
                            <select class="selectize-multiple" name="category" id="category">
                                <option value="">------------------------ </option>
                                @isset($blogcategory)
                                    @foreach ($blogcategory as $blogcate)
                                        <option value="{{ $blogcate['id'] }}" @if (isset($blog['category_id']) && $blogcate['id'] == $blog['category_id']) selected @endif>
                                            {{ $blogcate['title'] }}
                                        </option>
                                    @endforeach
                                @endisset

                            </select>

                            <span class="focus-border"></span>
                        </div>
                        <span id="category_" class="text-danger"></span>
                    </div>







                    <div class="col-lg-4">
                       <label class="form-section">@lang('site.tags')</label>
                        <div class="primary_input mb-25">
                            <input type="text" name="tags" class="form-control" data-role="tagsinput"
                                placeholder="add tags"
                                value=" @isset($blog['tags'])
                                   @foreach ($blog['tags'] as $tag)
                                      {{ $tag }} ,
                                   @endforeach
                                @endisset">

                            <span id="slug_" class="text-danger"></span>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="email-addr">@lang('site.global image for cours')</label><span class="text-danger">*</span>
                        <fieldset class="form-group">
                            <div class="custom-file">
                                <input type="file" name="global_image" class="custom-file-input"
                                    id="global_image_file_id"
                                    onchange="set_image_to_preview(this,'global_image_prev','global_image_id');">
                                <label class="custom-file-label" for="global_image_id">Choose file</label>
                            </div>
                        </fieldset>
                        <span class="text-danger" id="global_image_"></span>
                    </div>
                    <div class="form-group col-md-6">
                        @isset($blog['thumbnail'])
                            <div class="img_cont" id="global_image_view">
                                <img id="global_image" src="{{ asset($blog['thumbnail']) }}" alt="your image"
                                    width="150px" height="150px" />
                                <a onclick="delete_from_callery_by_id('{{ route('admin.categories.delete.image') }}',{{ $blog['id'] }},'','global_image_view','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                    class="btn_remove"><i class="fa fa-close"></i></a>
                            </div>
                        @endisset
                        <div class="img_cont" id="global_image_id" hidden>
                            <img id="global_image_prev" src="" alt="your image" width="150px"
                                height="150px" />
                            <a onclick="resetInput('global_image_file_id','global_image_id')" class="btn_remove"><i
                                    class="fa fa-close"></i></a>
                        </div>
                       
                    </div>
                </div>


                <div class="col-md-12" id="for_callery">
                    <label for="email-addr">@lang('site.gallery for cours')</label>
                    <fieldset class="form-group">
                        <div class="custom-file">

                            <input type="file" name="callery[]" multiple
                                onchange="previewMultipleImage(event,'calleries','all_img_callery')" id="calleries">

                            <label class="custom-file-label" for="calleries">Choose file</label>

                            {{-- <img id="callery" src="" alt="your image" width="150" height="150" hidden /> --}}
                        </div>
                    </fieldset>
                    <div class="row col-md-12" id="all_img_callery_">
                        @isset($blog['image'])
                            @foreach ($blog['image'] as $key => $item)
                                <div class=" form-group img_cont" id="global_image_{{ $key }}">
                                    <img id="global_image_" src="{{ asset($item) }}" alt="your image" width="150px"
                                        height="150px" />
                                    <a onclick="delete_from_callery_by_id('{{ route('admin.categories.delete.image_from_callery') }}',{{ $blog['id'] }},'{{ $item }}','global_image_{{ $key }}','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                        class="btn_remove">
                                        <i class="fa fa-close"></i></a>
                                </div>
                            @endforeach
                        @endisset
                        <div class="row col-md-12" id="all_img_callery">

                        </div>


                        <span class="text-danger" id="callery_"></span>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            @isset($blog['id'])
                                @if ($blog['id'] > 0)
                                    <a onclick="submit_blogs('{{ route('cms.blogs.update') }}' ,'blogs');" type="submit"
                                        class="btn btn-rounded btn-primary btn-outline">
                                        <i class="ti-save-alt"></i> @lang('site.save')
                                    </a>
                                @endisset
                            @else
                                <a onclick="submit_blogs('{{ route('cms.blogs.store') }}' ,'blogs');" type="submit"
                                    class="btn btn-rounded btn-primary btn-outline">
                                    <i class="ti-save-alt"></i> @lang('site.save')
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- 
                <div class="tags-default"> --}}
                    {{-- </div> --}}
            </form>
        </div>
    </div>
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js"></script> --}}
@endsection

@section('script')
    <script src="{{ URL::asset('Modules/Cms/assets/tinymce/tinymce/tinymce.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/tinymce/editor-tinymce.js') }}"></script>

    <script src="{{ URL::asset('Modules/Cms/assets/custome_js/save_and_redirect.js') }}"></script>

    <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/selectize/js/select/form-selectize.js') }}"></script>


    <script>
        function setSlug() {
            $('#slug').val(convertToSlug($('#title').val()));
        }


        $(document).on("click", ".deleteBtn", function(e) {
            e.preventDefault();
            let url = $(this).data('url');
            console.log(url);
            $('#deleteItem').find('form').attr('action', url);
        });


        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        }
    </script>
@endsection
