@extends('admin.layouts.master')
@section('title')
@lang('site.certificate')
@endsection
@section('css')
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }
    </style>



    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/switchery.min.css') }}">
@endsection


@section('content')



    <div class="box" id="admin_table">

        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">

            <div class="table-responsive ">
               
                    <div class="form-group">
                        <label>@lang('site.cours') <span class="text-danger">*</span> </label>
                        <select name="template" id="template" class="selectize-multiple" onchange="">

                            <option value="">-------------------------------</option>
                            @isset($certificates)
                                @foreach ($certificates as $certificate)
                                    <option value="{{ $certificate['id'] }}">
                                        {{ $certificate['name'] }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>

                    </div>
                    <table id="example1" class="table table-striped table-bordered" style="width:100% ">
                        <thead>

                            <tr>
                                <th>@lang('site.registration id')</th>
                                <th>@lang('site.student name')</th>
                                <th>@lang('site.cours fees')</th>
                                <th>@lang('site.remaining')</th>
                                <th>@lang('site.options')</th>

                            </tr>

                        </thead>
                        <tbody>
                            @isset($students)
                                {{-- {{dd($students)}} --}}
                                @foreach ($students as $student)
                                    @php  $student['remaining']==0 ? $class ='text-success' : $class ='text-danger'  @endphp
                                    <tr id="Row{{ $student['id'] }}" class="mb-10 p-10 cursor_pointer hover-success">
                                        <td>{{ $student['id'] }}</td>
                                        <td>{{ $student['student'][0]['name'] }} # {{ $student['student'][0]['id'] }}</td>
                                        <td>{{ $student['cours_fee_total'] }}</td>

                                        <td>
                                            <span class="{{ $class }}"> {{ $student['remaining'] }}</span>
                                        </td>
                                        <td>
                                          <form id="generate_cetificate_{{ $student['id'] }}">
                                             @csrf
                                            <input type="hidden" name="registration_id" id="registration_id"
                                                value="{{ $student['id'] }}">
                                            <input type="hidden" name="user_id" id="user_id"
                                                value="{{ $student['student'][0]['id'] }}">
                                            <input type="hidden" name="cours_id" id="cours_id"
                                                value="{{ $student['cours_id'] }}">
                                                <input type="hidden" name="template_id" class="template_id">
                                            <a onclick="submit('{{ route('admin.post.admin.generate.certificate') }}' ,'generate_cetificate_{{ $student['id'] }}');"
                                                class="hover hover-warning btn mdi mdi-certificate"
                                                title="@lang('site.generate certficate')">@lang('site.generate certficate')
                                            </a>
                                          </form>


                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                        </tbody>
                    </table>
                
            </div>
        </div>




    </div>
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
    <script>
        $(document).ready(function() {

            $('#template').on( "change",function(){
             
               $('.template_id').val($('#template').val());
            });
        
        
        
            $('#spinner_loading').css("display", "none");

            $('#admin_table').removeAttr('hidden');

            var table = $('#example1').DataTable({
                scrollY: "400px",
                // searching: false,
                // scrollX: true,
                scrollCollapse: true,
                paging: false,
                info: false,
                responsive: true,
                // ajax: '/test/0',

            });
        });
    </script>

    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
    <script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>
@endsection
