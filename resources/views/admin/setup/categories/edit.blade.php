@extends('admin.layouts.master')
@section('title')
@lang('site.categories edit')
@endsection
@section('css')

<link rel="stylesheet" type="text/css"
href="{{ URL::asset('assets/tinymce/tinymce.min.css') }}">


<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css')}}">

 

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
    <section id="form-repeater">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form"></h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="repeater-default">
                                <div data-repeater-list="car">
                                    <div data-repeater-item>
                                        <form id="categorie" class="form row">
                                            @csrf
                                            @isset($categorie)
                                                
                                            <input type="hidden" name="id" value="{{$categorie['id']}}"  id="">
                                            @endisset
                                            <div class="col-md-12">
                                                <h4 class="form-section"><i class="fa fa-envelope"></i>@lang('site.general information of cours')
                                                </h4>
                                            </div>

                                            @include('admin.setup.categories.create.name-duration-cetrificate')

                                            <div class="col-md-12">
                                                <h4 class="form-section"><i class="fa fa-envelope"></i> @lang('site.file and attache')
                                                </h4>
                                            </div>
                                            @include('admin.setup.categories.create.attache-global_image-url_vid_imbeded')

                                         <div class="col-md-12">
                                                <h4 class="form-section"><i class="fa fa-envelope"></i> @lang('site.file and attache')
                                                </h4>
                                            </div>
                                            @include('admin.setup.categories.create.description-require_knowldge-detail-prerequest')  

                                        </form>

                                        <a onclick="submit_categories('{{ route('admin.categories.post.edit.categories') }}', 'categorie') "
                                            class="btn btn-outline-success no-border"><i
                                                class="fa fa-check">@lang('site.save')</i></a>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     

    </section>

    {{-- <a href="{{route('admin.certificate.store.certificate')}}" class="la-check">sdc</a> --}}
@endsection


@section('script')
 
<script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
<script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>


<script src="{{ URL::asset('assets/tinymce/tinymce/tinymce.js') }}"></script>
<script src="{{ URL::asset('assets/tinymce/editor-tinymce.js') }}"></script>


{{-- 


<script src="{{ URL::asset('assets/app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript">
</script>
<script src="{{ URL::asset('assets/app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript">
</script>
 --}}


<script src="{{ URL::asset('assets/custome_js/categories.js') }}"></script>
<script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
<script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
@endsection
