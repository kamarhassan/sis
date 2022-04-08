@extends('admin.layouts.master')



@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashborad') }}">@lang('site.primary') </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.language') }}"> @lang('site.cours') </a>
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
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- @include('admin.alerts.success')
                                @include('admin.alerts.error') --}}
                        {{-- @include('admin.alerts.toaster') --}}
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.cours.store') }}" class="form"
                                    enctype="multipart/form-data">
                                    @csrf
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
                                                                    <option selected="selected" value="{{ old('grade') }}">
                                                                        {{ old('grade') }}</option>
                                                                @else
                                                                    <option selected="selected"
                                                                        value=" @lang('site.chosse the cours')">
                                                                        @lang('site.chosse the cours')</option>
                                                                @endif
                                                                @foreach ($grade as $grades)
                                                                    <option value="{{ $grades->name }}">{{ $grades->name }}
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
                                                                    <option selected="selected" value="{{ old('level') }}">
                                                                        {{ old('level') }}</option>
                                                                @else
                                                                    <option selected="selected"
                                                                        value=" @lang('site.chosse the cours')">
                                                                        @lang('site.chosse the cours')</option>
                                                                @endif
                                                                @foreach ($level as $levels)
                                                                    <option value="{{ $levels->name }}">
                                                                        {{ $levels->name }}
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
                                                        value="{{ old('start_date') }}" id="example-date-input">
                                                    @error('start_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('site.end date') </label>
                                                    <input name="end_date" class="form-control" type="date"
                                                        value="{{ old('end_date') }}" id="example-date-input">
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
                                                        value="{{ old('start_time') }}" id="example-date-input">
                                                    @error('start_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('site.end time') </label>
                                                    <input name="end_time" class="form-control" type="time"
                                                        value="{{ old('end_time') }}" id="example-date-input">
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
                                                    <input name="ac_start_date" class="form-control" type="date"
                                                        value="{{ old('ac_start_date') }}" id="example-date-input">
                                                    @error('ac_start_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('site.actually end date') </label>
                                                    <input name="ac_end_date" class="form-control" type="date"
                                                        value="{{ old('ac_end_date') }}" id="example-date-input">
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
                                                    <input name="max_std_number" class="form-control" type="number"
                                                        value="{{ old('max_std_number') }}" id="example-date-input">
                                                    @error('max_std_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @isset($status_od_cours)
                                                        <label>@lang('site.status of cours') </label>
                                                        <select name="status" class="form-control" style="width: 100%;">
                                                            @if (old('status') != '')
                                                                <option selected="selected" value="{{ old('status') }}">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('site.teacher name') </label>
                                                    <input list="browsers" name="teacher_name" id="browser"
                                                        class="form-control" value="{{ old('teacher_name') }}"
                                                        placeholder="@lang('site.teacher name if not entry')">
                                                    <datalist id="browsers">
                                                        @isset($teacher)
                                                            @foreach ($teacher as $teachers)
                                                                <option value="{{ $teachers->name }}">
                                                                    {{ $teachers->name }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </datalist>
                                                    @error('teacher_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('site.teacher fee') </label>
                                                    <input name="teacher_fee" class="form-control" type="number"
                                                        value="{{ old('teacher_fee') }}" id="example-date-input">
                                                    @error('teacher_fee')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>{{-- end of row teacher name and fee --}}
                                        <div class="row">
                                            <div class="box-body">
                                                <div class="demo-checkbox border border-warning">
                                                    <input  name="days[]"type="checkbox" id="md_checkbox_" class="chk-col-primary" value="1"/>
                                                    <label for="md_checkbox_">@lang('site.monday')</label>

                                                    <input name="days[]" type="checkbox" id="md_checkbox_2" class="chk-col-primary"  value="2"/>
                                                    <label for="md_checkbox_2">@lang('site.tuesday')</label>

                                                    <input  name="days[]"type="checkbox" id="md_checkbox_3" class="chk-col-primary"  value="3"/>
                                                    <label for="md_checkbox_3">@lang('site.wednesday')</label>

                                                    <input  name="days[]"type="checkbox" id="md_checkbox_4" class="chk-col-primary"  value="4"/>
                                                    <label for="md_checkbox_4">@lang('site.thirsday')</label>

                                                    <input  name="days[]"type="checkbox" id="md_checkbox_5" class="chk-col-primary"  value="5"/>
                                                    <label for="md_checkbox_5">@lang('site.friday')</label>

                                                    <input  name="days[]"type="checkbox" id="md_checkbox_6" class="chk-col-primary"  value="6"/>
                                                    <label for="md_checkbox_6">@lang('site.saturday')</label>

                                                </div>


                                            </div>


                                        </div>{{-- end of row teacher name and fee --}}





                                    </div>



                                    <div class="form-actions">
                                        <button class="btn btn-close btn-danger btn-round fa fa-times"
                                            onclick="history.back();">
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
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}">
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endsection
