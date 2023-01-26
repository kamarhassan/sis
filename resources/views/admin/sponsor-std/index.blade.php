@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-body">
        {{-- <div class="box"> --}}
        <div class="box bl-3 border-warning br-3">

            <div class="row ">
                <div class="col-lg-12">

                    <form id="sponsor">
                        @csrf
                        <select name="sponsor"
                            onchange="get_sponsor_shipe('{{ route('admin.cours.sponsore.ships') }}','sponsor');"
                            class="form-control select2" id="sponsore">
                            <option value="">------------------------</option>
                            @foreach ($sponore as $sponore_)
                                <option value="{{ $sponore_['id'] }}">{{ $sponore_['name'] }} # {{ $sponore_['type'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                </div>
            </div>

        </div>

        <div class="box bl-3 border-warning br-3" hidden id="cours_form_col">
            <form id="cours_form">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">

                            <input type="hidden" name="sponsore_id" id="sponsore_id">
                            <select name="sponsor_ships" class="form-control select2" id="cours">
                                <option value="">------------------------------------------------</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="demo-radio-button">
                                    <input name="discount" type="radio" id="radio_30" value="same_discount"
                                        class="with-gap radio-col-primary"
                                        onclick="get_students_sponsor('{{ route('admin.cours.sponsore.student') }}','cours_form');" />
                                    <label for="radio_30">@lang('site.same discount for all')</label>
                                    <input name="discount" type="radio" id="radio_32"
                                        value="diff_discount"class="with-gap radio-col-success"
                                        onclick="get_students_sponsor('{{ route('admin.cours.sponsore.student') }}','cours_form');" />
                                    <label for="radio_32">@lang('site.different discount for all')</label>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

    </div>
    <div class="row" id="error_and_edit_route" hidden>
        <div class="col-md-8">
            <h4 id="error" class="text-warning"></h4>
        </div>
        <div class="col-md-4">
            <a href="" id="edit_route" class="fa  fa-link">@lang('site.update link')</a>
        </div>
    </div>
   @include('admin.sponsor-std.data-table-students-sponsored')

    </div>
@endsection
@section('script')
    <script></script>
    <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/sponsor.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>    

    {{-- <script src="{{ URL::asset('assets/assets/vendor_components/moment/min/moment.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>'
    {{-- <script src="{{ URL::asset('assets/assets/vendor_plugins/iCheck/icheck.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/app-assets/js/data-table-responsive/datatable-responsive.js') }}"></script> --}}
@endsection
