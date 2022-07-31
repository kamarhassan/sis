@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="box bl-3 border-warning br-3">

        <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title text-capitalize text-warning text-uppercase">
                    {{-- <span>@lang('site.pay')</span> --}}
                </h3>
            </div>
            <div class="row show-grid">
                <div class="col-md-6">
                    <span>
                        @lang('site.client name') : <span class="bb-1 border-success">

                            @isset($user)
                                {{ $user['name'] }}
                            @endisset

                        </span>
                    </span>
                </div>
                <div class="col-md-6">
                    <span>
                        @lang('site.services info') : <span class="bb-1 border-success">
                            @isset($service)
                                {{ $service['service'] }} # {{ $service['fee'] }} {{ $service['currency']['abbr'] }}
                            @endisset
                        </span>
                    </span>
                </div>
            </div> <!-- End of row show-grid cours info and std name -->
        </div>


        <div class="box">
            <div class="col-md-4">
                <input type="hidden">
                <h4 class=" bb-1  border-danger box-title text-capitalize  text-uppercase" style="color:rgb(255, 153, 0)">
                    @lang('site.fee of this services is')
                    @isset($service)
                        {{ $service['currency']['currency'] }} - {{ $service['currency']['abbr'] }} -
                        {{ $service['currency']['symbol'] }}
                    @endisset
                </h4>
            </div>
            <form id="payment_data">
                <div class="box ">
                    <div class="row show-grid">
                        <div class="col-md-3">
                            <span>
                                @lang('site.amount') :
                            </span>
                        </div>

                        <input type="hidden" name="client_receipt" id="client_receipt"
                            value="{{ encript_custome($client_receipt['id']) }}">
                        <input type="hidden" name="service_id" id="service_id"
                            value="{{ encript_custome($service['id']) }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ encript_custome($user['id']) }}">
                        <input type="hidden" name="client_services_id" id="client_services_id"
                            value="{{ encript_custome($client_services['id']) }}">

                        <input type="hidden" name="service_currency_abbr" id="service_currency_abbr"
                            value="{{ $service['currency']['abbr'] }}">
                        <input type="hidden" name="service_currency_id" id="service_currency_abbr"
                            value="{{ $service['currency']['id'] }}">

                        @csrf
                        <div class="col-md-6" id="normal_pament">
                            <input type="number" id="amount_to_paid" step="any" class='form-control'
                                placeholder="@lang('site.paid fee here')" name="amount_to_paid"
                                value={{ $client_receipt['amount'] }}>
                            <span class="text-danger" id="amount_to_paid_"> </span>
                        </div>

                        <div class="col-md-6" id="Other_payment" hidden>
                            <div class="col-md-6" id="normal_pament">
                                @lang('site.paid fee here')
                                <input type="number" id="other_amount_to_paid" step="any" class='form-control'
                                    placeholder="@lang('site.paid fee here')" name="other_amount_to_paid"
                                    value={{ $client_receipt['other_amount'] }}>
                                <span class="text-danger" id="other_amount_to_paid_"> </span>
                            </div>
                            <div class="col-md-6" id="normal_pament">
                                @lang('site.rate exchange')
                                <input type="number" id="rate" step="any" class='form-control'
                                    placeholder="@lang('site.rate')" name="rate"
                                    value={{ $client_receipt['rate_exchange'] }}>
                                <span class="text-danger" id="rate_"> </span>
                            </div>
                            <div class="col-md-6" id="normal_pament">
                                <div class="form-group">
                                    <label>@lang('site.cours currency') </label>
                                    <select name="other_payment_currency" class="form-control select2" style="width: 100%;">
                                        @foreach ($currency as $service_currencys)
                                            @if ($service['currencies_id'] != $service_currencys->id)
                                                <option value="{{ $service_currencys->id }}">
                                                    {{ $service_currencys->symbol }} <- {{ $service_currencys->currency }}
                                                        </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <span class="text-danger" id="cours_currency_"> </span>
                        </div>


                        <div class="col-md-2">
                            <div class="demo-checkbox">
                                <input type="checkbox" name="payment_methode" id="payment_methode" class="chk-col-success"
                                    onchange='change_payment_methode();' value="1" />
                                <label for="payment_methode">@lang('site.other payment')</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="box ">
                    <div class="row show-grid">
                        <div class="col-md-3">
                            <span>
                                @lang('site.receipt description') :
                            </span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class='form-control' placeholder="@lang('site.description')"
                                name="receipt_description" id="receipt_description">
                            <span class="bb-1 border-success">
                        </div>
                    </div>
                </div>
                <div class="box ">
                    <div class="row show-grid">
                        <div class="col-md-3">
                            <span>
                                @lang('site.payment type') <span class="bb-1 border-success">
                                </span>
                            </span>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="radio">
                                    <input name="pay_type" type="radio" id="pay_cache_" checked
                                        onclick="change_pay_type(this.value);" value="pay_cache_">
                                    <label for="pay_cache_">cache</label>
                                    <input name="pay_type" type="radio" id="pay_check_"
                                        onclick="change_pay_type(this.value);" value="pay_check_">
                                    <label for="pay_check_">check</label>
                                    <span class="text-danger" id="pay_by_check_"> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="div_pay_check" hidden>
                    <div class="col-md-6" id="normal_pament">
                        <label>#@lang('site.check number')</label>
                        <input class='form-control' id="check_number" type="number" step="any"
                            placeholder="@lang('site.Enter check number')" name="check_number" id="check_number">
                        <span class="text-danger" id="check_number_"> </span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>#@lang('site.bank')</label>
                            <select class="form-control select2" name="bank" id="bank"
                                class="form-control select2" style="width: 100%;">
                                <option></option>
                                <option>slect from bank list 2</option>
                                <option>slect from bank list3 </option>
                                <option>slect from bank list 4</option>
                                <option>slect from bank list 5</option>

                            </select>
                        </div>
                    </div>
                    <span class="text-danger" id="bank_"> </span>
                </div>



            </form>
            <div class="row">
                <div class="col-md-3">
                    <button class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                        type="submit"   onclick="savepayment('{{ route('admin.service.edit.old.payment') }}');">

                        <span class=""> @lang('site.next step')</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('assets/custome_js/payment_for_cours_and_services.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
@endsection
