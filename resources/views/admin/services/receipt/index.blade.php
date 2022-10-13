@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
    <style>
        .overlayl {
            position: fixed;

            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    {{-- <div class="row"> --}}
    <div class="box-body" id="spinner_loading">
        <div class="d-flex justify-content-center text-primary ">
            <div class="spinner-border " role="status">

                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>


    {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
    <div class="box-body" id="table_std" hidden>
        <div class="table-responsive">
            <table id="example1" class="table table-hover">
                <thead>

                    <tr>
                        <th>@lang('site.id') #</th>
                        <th>@lang('site.Client name')</th>
                        <th>@lang('site.services')</th>

                        <th>@lang('site.amount')</th>
                        {{-- <th>@lang('site.id')</th> --}}
                        <th>@lang('site.payment date')</th>
                        <th>@lang('site.options')</th>
                        {{-- <th>@lang('site.students photo')</th> --}}
                    </tr>

                </thead>
                <tbody>
                    @isset($service_repceit)
                        @foreach ($service_repceit as $service_repceits)
                            <tr class="Row{{ $service_repceits['id'] }}" id="Row{{ $service_repceits['id'] }}">
                                <td>{{ $service_repceits['id'] }}</td>
                                <td>
                                   <span class="text-wrap"> {{ $service_repceits['client']['id'] }} # {{ $service_repceits['client']['name'] }}</span>
                                </td>
                                <td class="text-wrap">

                                @isset ($service_repceits['services_'])
                                        {{ $service_repceits['services_']['service'] }} #<br> <span class="text-wrap text-warning">
                                            {{ $service_repceits['services_']['fee'] }}
                                            {{ $service_repceits['services_currency']['symbol'] }} -
                                            {{ $service_repceits['services_currency']['abbr'] }}</span>

                                @endisset

                                </td>
                                <td>{{ $service_repceits['amount_total'] }}  <span class="text-wrap text-warning">
                                        {{ $service_repceits['services_currency']['symbol'] }} -
                                        {{ $service_repceits['services_currency']['abbr'] }}</span></td>
                                <td>{{ $service_repceits['created_at']->format('d-m-Y') }}</td>
                                <td>
                                   
                                    @can ('edit old services receipt') 
                                        <a href="{{route('admin.service.get_old_payment.edit',$service_repceits['id'])}}"
                                            class="btn text-success fa fa-pencil hover  hover-primary" title="@lang('site.edit')">
                                        </a>
                                    @endcan
                                    @can ('delete old services receipt') 
                                        <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                            title="@lang('site.delete')"
                                            onclick="delete_by_id('{{ route('admin.service.delete_payment_receipt') }}',{{ $service_repceits['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');"
                                            >
                                        </a>
                                    @endcan
                                    @can ('print old services receipt') 
                                        <a href="{{route('admin.payment.service.receipt',$service_repceits['id'])}}"
                                            class="btn text-warning fa fa-print hover  hover-primary" title="@lang('site.print')">
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            @isset($receipt)
                {{ $receipt->links() }}
            @endisset
        </div>
    </div>
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            $('#spinner_loading').css("display", "none");

            $('#table_std').removeAttr('hidden');
            var table = $('#example1').DataTable({
                order: [
                    [0, 'desc']
                ],
                scrollY: "400px",
                // scrollX: true,
                // scrollCollapse: true,
                responsive: true,
                paging: false,
                // ajax: '/test/0',

            });
        });
    </script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script> --}}
@endsection
