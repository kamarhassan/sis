
 @extends('admin.layouts.master')
@section('title')
@lang('site.remaining')
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

    {{-- <div class="box" id="spinner_loading">
        <div class="d-flex justify-content-center text-primary">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div> --}}

    <div class="box" id="admin_table" hidden>

        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">

            <div class="table-responsive">
                <table id="example1" class="table table-hover">
                    <thead>
                       
                        <tr>
                            <th class="wrapper">@lang('site.lang name')</th>
                            {{-- <th class="wrapper">@lang('site.user_services_id')</th> --}}
                            <th class="wrapper">@lang('site.services')</th>
                            <th class="wrapper">@lang('site.quantity')</th>
                            <th class="wrapper">@lang('site.fee primary price')</th>
                            <th class="wrapper">@lang('site.amount')</th>
                            <th class="wrapper">@lang('site.remaining')</th>
                            <th class="wrapper">@lang('site.date')</th>
                            <th class="wrapper">@lang('site.options')</th>
                            {{--   <th>@lang('site.students photo')</th> --}}
                        </tr>
 {{-- "user_id": 5,
                        " ": "Bethany Hand",
                        "": 6,
                        "": 1,
                        "": 15,
                        "": 0,
                        "": 15,
                        "": "2022-10-13 19:23:46",
                        "service_id": 2,
                        "": "Inernet 3G" --}}
                    </thead>
                    <tbody>
                        @isset($data)
                            @foreach ($data as $data_clinet_payment_remaining)
                                <tr id="Row{{ $data_clinet_payment_remaining['user_services_id'] }}" class="bg-light mb-10 p-10 cursor_pointer hover-success">
                                    <td>{{$data_clinet_payment_remaining['user_name']}}</td>
                                    <td>{{$data_clinet_payment_remaining['service']}}</td>
                                    {{-- <td>{{$data_clinet_payment_remaining['user_services_id']}}</td> --}}
                                    <td>{{$data_clinet_payment_remaining['quantity']}}</td>
                                    <td>{{$data_clinet_payment_remaining['amount']}}</td>
                                    <td>{{$data_clinet_payment_remaining['paid_amount']}}</td>
                                    <td>{{$data_clinet_payment_remaining['remaining']}}</td>
                                    <td>{{$data_clinet_payment_remaining['date_services'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.payment.user_paid_for_services_for_remaining', $data_clinet_payment_remaining['user_services_id'])}}"
                                        class="btn fa fa-credit-card hover-warning text-light">@lang('site.pay')</a>
                                       
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
    <script src="{{ URL::asset('assets\custome_js\delete.js') }}"></script>
    <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
@endsection
