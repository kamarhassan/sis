@extends('admin.layouts.master')
@section('title')
    @lang('site.reports')
@endsection
@section('css')
@endsection
@section('content')
    <form action="{{ route('admin.report.between_date') }}" method="POST">
       @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('site.start date') </label>
                    <input name="start_date" class="form-control" type="date" value="{{ old('start_date') }}"
                        id="example-date-input">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('site.end date') </label>
                    <input name="end_date" class="form-control" type="date" value="{{ old('end_date') }}"
                        id="example-date-input">
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


        <button class="btn  glyphicon glyphicon-arrow-left hover-success text-warning-light" title="@lang('site.save')"
            type="submit"> <span> @lang('site.next step')</span>
        </button>
    </form>
@endsection


@section('script')
@endsection
