@extends('admin.layouts.master')
@section('title')
@lang('site.payment')
@endsection
@section('css')
    <style>
        .loader {
            left: 50%;
            margin-left: -4em;
        }
    </style>
@endsection


@section('content')



    <div class="box" id="table_std">

        <div class="box-body">
            <div class="table-responsive ">
                <table id="example1" class="table table-hover">
                    <thead>

                        <tr>

                            <th>@lang('site.student name')</th>
                            <th>@lang('site.cours info')</th>
                            <th>@lang('site.teacher name')</th>
                            <th>@lang('site.cours fees')</th>
                            <th>@lang('site.remaining')</th>
                            <th>@lang('site.options')</th>
                        </tr>

                    </thead>
                    <tbody>
                        @isset($std_registartion)
                            @foreach ($std_registartion as $stduents)
                                <tr id="Row{{ $stduents->user_id }}" class=" mb-10 p-10 cursor_pointer hover-success">

                                    <td class="col-sm-2">{{ $stduents['student'][0]['name'] }} # {{ $stduents->user_id }}</td>

                                    <td>
                                       {{ $stduents['cours']['category_grade_level']['name']}}     [ {{ $stduents['cours']['category_grade_level']['grade']['grade'] }} # {{ $stduents['cours']['category_grade_level']['level']['level'] }}]
                                         
                                    </td>
                                    <td>{{ $stduents['cours']['teacher_name']['name'] }}</td>
                                    <td>{{ $stduents['cours_fee_total'] }} <span
                                            class="text-warning">{{ $stduents['cours']['cours_currency']['abbr'] }}</span>
                                    </td>
                                    <td>{{ $stduents['remaining'] }} <span
                                            class="text-warning">{{ $stduents['cours']['cours_currency']['abbr'] }}</span>
                                    </td>
                                    <td>

                                        <a href="{{ route('admin.payment.user_paid_for_cours', [$stduents->cours_id, $stduents->user_id]) }}"
                                            class="btn fa fa-credit-card hover-warning text-light" title="@lang('site.save')">
                                            @lang('site.pay')
                                        </a>



                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.payment.cours_std')
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#spinner_loading').css("display", "none");

            $('#table_std').removeAttr('hidden');

            var table = $('#example1').DataTable({
                scrollY: "400px",
                // scrollX: true,
                scrollCollapse: true,
                paging: false,
                responsive: true,
                // ajax: '/test/0',

            });
        });
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
    <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script>
@endsection
