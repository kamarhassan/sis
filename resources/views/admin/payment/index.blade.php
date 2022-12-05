@extends('admin.layouts.master')
@section('title')
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

    <div class="box" id="spinner_loading">
        <div class="d-flex justify-content-center text-primary">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <div class="box" id="table_std" hidden>

        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">
            <div class="table-responsive ">
                {{-- <div id="spiner_loading"     class="spinner-grow text-primary @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') float-left
                @else float-right @endif " role="status">
                    <span class="sr-only">Loading...</span>
                </div> --}}
                <table id="example1" class="table table-hover">
                    <thead>

                        <tr>

                            <th>@lang('site.student name')</th>
                            <th>@lang('site.cours info')</th>
                            <th>@lang('site.cours fees')</th>
                            <th>@lang('site.remaining')</th>
                            <th>@lang('site.options')</th>
                        </tr>

                    </thead>
                    <tbody>
                        @isset($std_registartion)
                            @foreach ($std_registartion as $stduents)
                                <tr id="Row{{ $stduents->user_id }}" class="bg-light mb-10 p-10 cursor_pointer hover-success">

                                    <td class="col-sm-2">{{ $stduents['student'][0]['name'] }} # {{ $stduents->user_id }}</td>

                                    <td>{{ $stduents['cours']['grade']['grade'] }} # {{ $stduents['cours']['level']['level'] }}
                                        # {{ $stduents['cours']['teacher_name']['name'] }}</td>
                                    <td>{{ $stduents['cours_fee_total'] }} <span
                                            class="text-warning">{{ $stduents['cours']['cours_currency']['abbr'] }}</span></td>
                                    <td>{{ $stduents['remaining'] }} <span
                                            class="text-warning">{{ $stduents['cours']['cours_currency']['abbr'] }}</span></td>
                                    <td>

                                        <a href="{{ route('admin.payment.user_paid_for_cours', [$stduents->cours_id, $stduents->user_id]) }}"
                                            class="btn fa fa-credit-card hover-warning text-light" title="@lang('site.save')">
                                            @lang('site.pay')</a>


                                        {{-- <ul>
                                            <li class="list-unstyled">
                                                <a data-toggle="modal" data-target="#modal-center"
                                                   href=""
                                                    class="btn fa fa-credit-card hover-warning text-light"
                                                    title="@lang('site.save')"> @lang('site.pay')</a>
                                            </li>

                                        </ul> --}}
                                        {{-- <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light"
                                        title="@lang('site.save')"></a>
                                     <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light"
                                        title="@lang('site.save')"></a> --}}

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
@include('admin.payment.cours_std')
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
