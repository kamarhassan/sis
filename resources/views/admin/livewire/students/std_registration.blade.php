@extends('admin.layouts.popup')
@section('title')
    @lang('site.register Student in Course')
@endsection
@section('css')
@endsection

@section('content')
    @livewire('students.registration')
@endsection


@section('script')
    @livewireScripts
@endsection
