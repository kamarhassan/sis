@extends('admin.layouts.master')
@section('title')
   @lang('site.cours edit')
@endsection
@section ('css') 
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/bootstrap-switch.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/switchery.min.css') }}">

@endsection



@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashborad') }}">@lang('site.Dashboard') </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.cours.all') }}"> @lang('site.cours') </a>
                        </li>
                        <li class="breadcrumb-item active">
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form"> @lang('site.add new cours') </h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form id="cours_update"  class="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-user"></i> @lang('site.cours info')</h4>
                                        @include('admin.cours.create-edit.class-info-duration')
                                    </div>

                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-user"></i> @lang('site.time and duration')</h4>
                                        @include('admin.cours.create-edit.time-duration')
                                    </div>
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-user"></i> @lang('site.')</h4>
                                        @include('admin.cours.create-edit.std_number-status-teacher_name-days')
                                    </div>
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-user"></i> @lang('site.fee amount')</h4>
                                        @include('admin.cours.create-edit.fee')
                                    </div>
                                    <div class="form-actions">
                                        <button class="btn btn-close btn-danger btn-round fa fa-times"
                                            onclick="history.back();">
                                            <i class="ft-x"></i>@lang('site.back')
                                        </button>



                                        <a onclick="submit('{{ route('admin.cours.update', $cours->id) }}' ,'cours_update');"
                                        type="submit" class="btn btn-close btn-success btn-round fa fa-save">
                                        <i class="ft-check"></i> @lang('site.save')
                                    </a>

                                      


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
<script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
<script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>
<script src="{{ URL::asset('assets/app-assets/js/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/custome_js/cours_.js') }}"></script>

{{-- <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
</script> --}}
<script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>




<script src="{{ URL::asset('assets/switcher/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/switcher/js/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/switcher/js/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/switcher/js/switch.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/custome_js/cours_.js') }}"></script>
<script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
</script>
<script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            
            set_grade_level(@json($categories),$('#categories_select').find(":selected").val());
            
            change_fee_cours(@json($coursfee))
            select_day_of_cours(@json(day_of_week_for_cours($cours->days)))
          
        });
    </script>
   
  @endsection
