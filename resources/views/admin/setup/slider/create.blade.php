@extends('admin.layouts.master')
@section('title')
   @lang('site.slider')
@endsection
@section('css')
   
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">

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
                            <form id="banner_slider">
                                @csrf
                                @include('admin.setup.slider.create-edit-form')
                            </form>
                            <a onclick="submit('{{ route('admin.slider.store.slider') }}' ,'banner_slider');"
                            type="submit" class="btn btn-rounded  btn-outline-success">
                            <i class="ti-save-alt"></i> @lang('site.save')
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script src="{{ URL::asset('assets/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/scripts/forms/switch.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>


<script>
      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                $("#image_slide").attr("hidden", false);
                reader.onload = function(e) {
                    $('#image_slide')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>



@endsection
