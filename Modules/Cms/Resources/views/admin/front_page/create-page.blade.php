@extends('admin.layouts.master')
@section('title')
@lang('site.create page')
@endsection
@section('content')
    <div class="box">
        <form id="create_page">
            @csrf
            @isset($data['id'])
                <input type="hidden" name="id" value=" {{ $data['id'] }}">
            @endisset
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12  ">
                        <div class="primary_input mb-25">
                            <label class="form-section">@lang('site.page title')
                            </label> <span class="text-danger">*</span>
                            <input class="form-control" type="text" id="title_input" name="title" onkeyup="setSlug();"
                                autocomplete="off"
                                value="@isset($data['title']){{ $data['title'] }} @endisset">

                            <span id="title_" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-lg-12 ">
                        <div class="primary_input mb-25">
                            <label class="form-section">@lang('site.sub title') </label>
                            <input class=" form-control" type="text" name="sub_title" autocomplete="off"
                                value="@isset($data['sub_title']){{ $data['sub_title'] }} @endisset">

                            <span id="sub_title_" class="text-danger"></span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">




                <div class="col-lg-12  ">
                    <div class="primary_input mb-25">
                        <label class="form-section">@lang('site.slug')
                        </label> <span class="text-danger">*</span>
                        <input class="form-control" type="text" type="text" name="slug" id="slug"
                            autocomplete="off" value="@isset($data['slug']){{ $data['slug'] }} @endisset">

                        <span id="slug_" class="text-danger"></span>
                    </div>
                </div>


            </div>


        </form>



    </div>
    <div class="row">
        <div class="col-md-4">
            @isset($data['id'])
                @if ($data['id'] > 0)
                    <a onclick="submit_rediret('{{ route('cms.admin.page.update') }}' ,'create_page');" type="submit"
                        class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> @lang('site.save')
                    </a>
                @endisset
            @else
                <a onclick="submit_rediret('     {{ route('cms.admin.page.store') }}' ,'create_page');" type="submit"
                    class="btn btn-rounded btn-primary btn-outline">
                    <i class="ti-save-alt"></i> @lang('site.save')
                </a>
            @endif
        </div>
    </div>
@endsection






@section('script')
    <script src="{{ URL::asset('Modules/Cms/assets/custome_js/save_and_redirect.js') }}"></script>
    <script>
        function setSlug() {
            $('#slug').val(convertToSlug($('#title_input').val()));
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
