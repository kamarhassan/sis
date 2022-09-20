@extends('admin.layouts.master')
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
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                        </div>
                        {{-- @include('admin.alerts.success')
                                @include('admin.alerts.error') --}}
                        {{-- @include('admin.alerts.toaster') --}}
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.cours.store') }}" class="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class=" col-12">
                                        <div class="box bl-3.border-primary">
                                            <div class="box-header with-border">
                                                <h4 class="box-title"> <strong>@lang('site.cours info')</strong></h4>
                                                <ul class="box-controls pull-right">
                                                    {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                                                    <li><a class="box-btn-slide" href="#"></a></li>
                                                    {{-- <li><a class="box-btn-fullscreen" href="#"></a></li> --}}
                                                </ul>
                                            </div>

                                            <div class="box-body">
                                                <div class="form-body">
                                                    {{-- <h4 class="form-section"><i class="ft-home"></i> بيانات اللغة </h4> --}}
                                                    {{-- value="{{ old('username') }}" --}}
                                                    <div class="row">
                                                        @isset($grade)
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="form-group">
                                                                        <label>@lang('site.cours') </label>
                                                                        <select name="grade" class="form-control select2"
                                                                            style="width: 100%;">

                                                                            @if (old('grade') != '')
                                                                                <option selected="selected"
                                                                                    value="{{ old('grade') }}">
                                                                                    {{ old('grade') }}</option>
                                                                            @else
                                                                                <option selected="selected"
                                                                                    value=" @lang('site.chosse the cours')">
                                                                                    @lang('site.chosse the cours')</option>
                                                                            @endif
                                                                            @foreach ($grade as $grades)
                                                                                <option value="{{ $grades->grade }}">
                                                                                    {{ $grades->grade }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('grade')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        @endisset
                                                        @isset($level)
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="form-group">
                                                                        <label>@lang('site.level') </label>
                                                                        <select name="level" class="form-control select2"
                                                                            style="width: 100%;">
                                                                            @if (old('level') != '')
                                                                                <option selected="selected"
                                                                                    value="{{ old('level') }}">
                                                                                    {{ old('level') }}</option>
                                                                            @else
                                                                                <option selected="selected"
                                                                                    value=" @lang('site.chosse the cours')">
                                                                                    @lang('site.chosse the cours')</option>
                                                                            @endif
                                                                            @foreach ($level as $levels)
                                                                                <option value="{{ $levels->level }}">
                                                                                    {{ $levels->level }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('level')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        @endisset
                                                    </div>{{-- end of row level and grade --}}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.start date') </label>
                                                                <input name="start_date" class="form-control" type="date"
                                                                    value="{{ old('start_date') }}"
                                                                    id="example-date-input">
                                                                @error('start_date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.end date') </label>
                                                                <input name="end_date" class="form-control" type="date"
                                                                    value="{{ old('end_date') }}"
                                                                    id="example-date-input">
                                                                @error('end_date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>{{-- end of row start and end date --}}


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.start time') </label>
                                                                <input name="start_time" class="form-control" type="time"
                                                                    value="{{ old('start_time') }}"
                                                                    id="example-date-input">
                                                                @error('start_time')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.end time') </label>
                                                                <input name="end_time" class="form-control" type="time"
                                                                    value="{{ old('end_time') }}"
                                                                    id="example-date-input">
                                                                @error('end_time')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>{{-- end of row start and end time --}}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.actually start date') </label>
                                                                <input name="ac_start_date" class="form-control"
                                                                    type="date" value="{{ old('ac_start_date') }}"
                                                                    id="example-date-input">
                                                                @error('ac_start_date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.actually end date') </label>
                                                                <input name="ac_end_date" class="form-control" type="date"
                                                                    value="{{ old('ac_end_date') }}"
                                                                    id="example-date-input">
                                                                @error('ac_end_date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>{{-- end of row start and end actually date --}}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.max number of students') </label>
                                                                <input name="max_std_number" class="form-control"
                                                                    type="number" value="{{ old('max_std_number') }}"
                                                                    id="example-date-input">
                                                                @error('max_std_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                @isset($status_od_cours)
                                                                    <label>@lang('site.status of cours') </label>
                                                                    <select name="status" class="form-control"
                                                                        style="width: 100%;">
                                                                        @if (old('status') != '')
                                                                            <option selected="selected"
                                                                                value="{{ old('status') }}">
                                                                                {{ old('status') }}</option>
                                                                        @else
                                                                            <option selected="selected"
                                                                                value=" @lang('site.chosse the cours')">
                                                                                @lang('site.chosse the cours')</option>
                                                                        @endif
                                                                        @foreach ($status_od_cours as $status_od_cour)
                                                                            <option value="{{ $status_od_cour->name }}">
                                                                                {{ $status_od_cour->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('status')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                @endisset
                                                            </div>
                                                        </div>
                                                    </div>{{-- end of row max std number and status of cours --}}

                                                    <div class="row">
                                                        @isset($teacher)
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <label>@lang('site.teacher name') </label>
                                                                        <select name="teacher_name" class="form-control select2"
                                                                            style="width: 100%;">

                                                                            @if (old('teacher_name') != '')
                                                                                <option selected="selected"
                                                                                    value="{{ old('teacher_name') }}">
                                                                                    {{ old('teacher_name') }}</option>
                                                                            @else
                                                                                <option selected="selected"
                                                                                    value=" @lang('site.chosse the teacher name')">
                                                                                    @lang('site.chosse the cours')</option>
                                                                            @endif
                                                                            @foreach ($teacher as $teachers)
                                                                                <option value="{{ $teachers->name }}">
                                                                                    {{ $teachers->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                @error('teacher_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        @endisset
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.teacher fee') </label>
                                                                <input name="teacher_fee" class="form-control"
                                                                    type="number" step="any"
                                                                    value="{{ old('teacher_fee') }}"
                                                                    id="example-date-input">
                                                                @error('teacher_fee')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>{{-- end of row teacher name and fee --}}
                                                    <div class="row">
                                                        {{-- <div class="box-body">
                                                            <div class="demo-checkbox border border-warning"> --}}

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.level') </label>
                                                                <select name="days[]" multiple class="form-control select2"
                                                                    style="width: 100%;">

                                                                    @foreach (days_of_week() as $key => $days)
                                                                        <option selected value={{ $key }}>
                                                                            {{ $days }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @error('days[]')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>@lang('site.description') </label>
                                                                <textarea name="description" id="description" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                {{-- end of row teacher name and fee --}}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>





                        {{-- begin start blade to cours fee --}}
                        <div class=" col-12">
                            <div class="box ">
                                <div class="box-header with-border">
                                    <h4 class="box-title"> <strong>@lang('site.cours fees')</strong></h4>

                                    <ul class="box-controls pull-right">

                                        {{-- <li><a class="box-btn-close" href="#"></a></li> --}}
                                        <li><a class="box-btn-slide" href="#"></a></li>
                                        {{-- <li><a class="box-btn-fullscreen" href="#"></a></li> --}}
                                    </ul>
                                </div>
                                <div class="box-body">
                                    <div class="row">

                                        @isset($grade)
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="form-group">
                                                        <label>@lang('site.cours currency') </label>
                                                        <select name="cours_currency" class="form-control select2" style="width: 100%;">
                                                            @foreach ($cours_currency as $cours_currencys)
                                                                <option value="{{ $cours_currencys->id }}">
                                                                 {{ $cours_currencys->symbol }}   <-  {{ $cours_currencys->currency }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('cours_currency')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endisset


                                    </div>

                                    @isset($fee_type)
                                        <div class="table-responsive">
                                            <table class="table table-hover ">
                                                <tr>
                                                    <th>@lang('site.select fee')</th>
                                                    <th>@lang('site.fee value')</th>
                                                </tr>
                                                @foreach ($fee_type as $key => $feeType)
                                                    <tr>
                                                        <td>
                                                            <div class="demo-checkbox">
                                                                <input type="checkbox" name="fee[{{  $feeType->id }}]" id="md_checkbox_{{ $feeType->id }}"
                                                                class="chk-col-primary"
                                                                @if ($feeType->sponsored == 1)
                                                                checked
                                                                @endif
                                                                onchange ='total_coust(@json($fee_type_id));' />
                                                                <label for="md_checkbox_{{ $feeType->id }}">{{ $feeType->fee }}</label>
                                                                {{-- @if ($feeType->sponsored == 1) --}}
                                                                @error('fee.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            {{-- @error('fee[]')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
                                                            {{-- @endif --}}
                                                        </div>
                                                    </td>
                                                    {{-- @error('fee_id.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror --}}
                                                        <td>

                                                            <input
                                                            class="form-control fee" type="number" step="any"

                                                                id="fee_value_{{$feeType->id }}"
                                                                onchange='total_coust(@json($fee_type_id));' />

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                {{-- class="box-inverse box-warning" --}}
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <label for="total_coust"
                                                                id="total_coust">@lang('site.total_coust')</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <label for="total_coust" id="total_coust_fee">0</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        {{-- end  start blade to cours fee --}}


                        <div class="form-actions">
                            <button class="btn btn-close btn-danger btn-round fa fa-times" onclick="history.back();">
                                <i class="ft-x"></i>@lang('site.back')
                            </button>


                            <button type="submit" class="btn btn-close btn-success btn-round fa fa-save">

                                <i class="ft-x"></i> @lang('site.save')
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
@section('script')
    <script>
    </script>
    <script src="{{ URL::asset('assets/custome_js/cours_.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"> --}}
    {{-- </script> --}}
    {{-- <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script> --}}
@endsection
