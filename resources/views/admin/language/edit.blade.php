@extends('admin.layouts.master')


@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashborad') }}">الرئيسية </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.language') }}"> أللغات </a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.lang edit')
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
                            <h4 class="card-title" id="basic-layout-form"> @lang('site.lang edit') </h4>
                            {{-- <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                     <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div> --}}
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.language.update', $language->id) }}"
                                    class="form" enctype="multipart/form-data">
                                    @csrf

                                   <div class="form-body">
                                        <h4 class="form-section"><i class="ft-home"></i> @lang('site.Language data') </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">@lang('site.enter lang')</label>
                                                    <input type="text" name="name" value="{{ $language->name }}"
                                                        id="name" class="form-control"
                                                        placeholder="@lang('site.enter lang') " name="name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1"> @lang('site.country') </label>
                                                    <input type="text" value="{{ $language->country }}" id="country"
                                                        class="form-control" placeholder="@lang('site.enter country') "
                                                        name="country">
                                                    @error('country')
                                                        <span class="text-danger">{{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1"> @lang('site.code') </label>
                                                    <input type="text" value="{{ $language->code }}" id="code"
                                                        class="form-control" placeholder="@lang('site.enter code') "
                                                        name="code">
                                                    @error('code')
                                                        <span class="text-danger">{{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput2"> @lang('site.direction') </label>
                                                    <select name="direction" class="select2 form-control">
                                                        {{-- <optgroup label="من فضلك أختر اتجاه اللغة "> --}}


                                                        <option value="rtl"
                                                            @if ($language->direction == 'rtl') selected @endif>@lang('site.from right to left')</option>

                                                        <option value="ltr"
                                                            @if ($language->direction == 'ltr') selected @endif>@lang('site.from left to right')</option>


                                                        </optgroup>
                                                    </select>
                                                    @error('direction')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-1">
                                                    <div class="box-controls pull-right">
                                                        <label class="switch switch-border switch-success">
                                                            <input type="checkbox" value="1" name="active"
                                                                @if ($language->active == 1) checked @endif />
                                                            <span class="switch-indicator"></span>
                                                            <label for="switcheryColor4" class="card-title ml-1">@lang('site.is active') </label>
                                                            @error('active')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>


                            <div class="form-actions">
                                <button class="btn btn-close btn-danger btn-round fa fa-times" onclick="{history.back();}">
                                    <i class="ft-x"></i> @lang('site.back')
                                </button>


                                <button type="submit" class="btn btn-close btn-success btn-round fa fa-save">

                                    <i class="ft-x"></i>@lang('site.save')
                                </button>


                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- // Basic form layout section end -->
    </div>
@endsection
