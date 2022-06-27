@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <section class="invoice printableArea" id="print">
        <div class="col-12 no-print">
            <div class="bb-1 clearFix">
                <div class="text-right pb-15">
                    {{-- <button id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> --}}
                    <button class="btn  fa fa-print  hover-success text-white text-success" title="@lang('site.print')"
                        type="button" onclick="printarea()">
                        <span>@lang('site.print')</span>
                    </button>
                    {{-- <button id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> --}}

                </div>
            </div>
        </div>
        <div class=" row">
            <div class="col-12">
                <div class="bb-1 clearFix">
                </div>
            </div>
            <div class="col-12">
                <div class="page-header">
                    <h2 class="d-inline"><span class="font-size-30">@lang('site.receipt')</span></h2>
                    <div class="pull-right text-right">
                        <h3><label>@lang('site.Release Date')</label> :{{ $receipt->created_at->format('d-m-Y') }}
                        </h3>
                        {{-- <h3>{{ date('d-m-Y') }}</h3> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-md-6 invoice-col">
                <strong>@lang('site.from')</strong>
                <address>

                    {{-- <strong class="text-blue bb-1 font-size-24">{{ $std_name }}</strong> --}}
                    <strong class="text-blue bb-1 font-size-24">{{ $user->name }}</strong>
                    <br>@lang('site.registration id') : {{ $std[0]['id'] }}<br>
                    <br>@lang('site.registration date') : {{ $std[0]['created_at']->format('d-m-Y') }}<br>

                </address>
            </div>
            <div class="col-md-6 invoice-col">
                <strong>@lang('site.to')</strong>
                <address>
                    <strong class="text-blue bb-1  font-size-24">@lang('site.site name') </strong><br>
                    <strong class="d-inline">العنوان from database settings table and site name</strong><br>
                    <strong>تفاصيل email , nb pfone ...... from database settings table and site name</strong>
                </address>
            </div>
            <div class="col-sm-12 invoice-col mb-15">
                <div class="invoice-details row no-margin">
                    <div class="col-md-6 col-lg-3"><b>receipr id # {{ $receipt->id }}</b></div>

                    <div class="col-md-6 col-lg-3"><b>user ID : {{ $std[0]['cours_id'] }}</b></div>
                    <div class="col-md-6 col-lg-3"><b>cours : {{ $std[0]['user_id'] }}</b>
                        {{-- @if ($coursinfo->grade['grade'] != '' && $coursinfo->level['level'] != '')
                        {{ $coursinfo->grade['grade'] }} -{{ $coursinfo->level['level'] }}
                    @endif --}}
                    </div>
                    <div class="col-md-6 col-lg-3"><b>amount: {{ $receipt->amount }}</b></div>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            @isset($fees)
                <div class="table-responsive">
                    <table id="payment_table" class="table table-hover mb-0">
                        <tr>
                            <th scope="col">@lang('site.fee type')</th>
                            <th scope="col">@lang('site.fee value')</th>
                            <th scope="col">@lang('site.registration date')</th>
                            <th scope="col">@lang('site.paid')</th>
                            {{-- <th scope="col">@lang('site.paid date')</th> --}}
                            <th scope="col">@lang('site.remaining')</th>
                            <th scope="col">@lang('site.desription')</th>
                        </tr>
                        <form id="alldata">

                            @if ($old_payment->count() > 0)
                                @foreach ($old_payment as $feestopaid)
                                    <tr>
                                        {{-- <td scope="row"> feestopaid['id']</td> -- --}}
                                        <td scope="row"> {{ $feestopaid['cours_fee']['fee_type']['fee'] }} </td>
                                        <td scope="row"> {{ $feestopaid['cours_fee']['value'] }} </td>
                                        <td scope="row"> {{ $std[0]['created_at']->format('d-m-Y') }} </td>
                                        <td scope="row"> {{ $feestopaid['paid_amount'] }} </td>
                                        <td scope="row"> {{ $feestopaid['remaining'] }} </td>

                                    </tr>
                                @endforeach

                            @endif
                        </form>
                        <tr scope="col" class="text-warning text-uppercase">
                            <td scope="row">@lang('site.cours fee total') </td>
                            <td scope="row"> {{ $std[0]['cours_fee_total'] }}</td>
                            <td scope="row"> </td>
                            <td scope="row"> {{ $std[0]['cours_fee_total'] - $std[0]['remaining'] }} </td>
                            <td scope="row"> {{ $std[0]['remaining'] }}</td>
                        </tr>
                    </table>
                </div>
            @endisset


        </div>
    </section>

@endsection


@section('script')
    <script src="{{ URL::asset('assets/assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/invoice.js') }}"></script>
    <script src="{{ URL::asset('assets/custome_js/print.js') }}"></script>
@endsection
