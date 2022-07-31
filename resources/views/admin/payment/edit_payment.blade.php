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
                </h3>
            </div>
            <div class="row show-grid">
                <div class="col-md-6">
                    <span>
                        @lang('site.student name') : <span class="bb-1 border-success">
                            {{ $students->name }}
                        </span>
                    </span>
                </div>
                <div class="col-md-6">
                    <span>
                        @lang('site.cours info') : <span class="bb-1 border-success">
                            @isset($cours)
                                {{ $cours['cours']['grade']['grade'] }} - {{ $cours['cours']['level']['level'] }} -
                                {{ $cours['cours']['teacher_name']['name'] }}
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
                    @lang('site.fee of this cours is')
                    {{ $cours_currency['currency'] }} - {{ $cours_currency['abbr'] }} - {{ $cours_currency['symbol'] }}
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
                        <input type="hidden" name="cours_id" id="cours_id" value="{{ encrypt($cours['cours']['id']) }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ encrypt($students->id )}}">
                        <input type="hidden" name="receipt_id" id="receipt_id" value="{{$receipt['id']}}">
                        <input type="hidden" name="cours_currency_abbr" id="cours_currency_abbr"
                            value="{{ $cours_currency['abbr'] }}">
                        <input type="hidden" name="cours_currency_id" id="cours_currency_abbr"
                            value="{{ $cours_currency['id'] }}">
                        @csrf
                        <div class="col-md-6" id="normal_pament">
                            <input type="number" id="amount_to_paid" step="any" class='form-control'
                                placeholder="@lang('site.paid fee here')" name="amount_to_paid" value="{{ $receipt['amount'] }}">
                            <span class="text-danger" id="amount_to_paid_"> </span>
                        </div>

                        <div class="col-md-6" id="Other_payment" hidden>
                            <div class="col-md-6" id="normal_pament">
                                @lang('site.paid fee here')
                                <input type="number" id="other_amount_to_paid" step="any" class='form-control'
                                    placeholder="@lang('site.paid fee here')" name="other_amount_to_paid"
                                    value="{{ $receipt['other_amount'] }}">
                                <span class="text-danger" id="other_amount_to_paid_"> </span>
                            </div>
                            <div class="col-md-6" id="normal_pament">
                                @lang('site.rate exchange')
                                <input type="number" id="rate" step="any" class='form-control'
                                    placeholder="@lang('site.rate')" name="rate"
                                    value="{{ $receipt['rate_exchange'] }}">
                                <span class="text-danger" id="rate_"> </span>
                            </div>
                            <div class="col-md-6" id="normal_pament">
                                <div class="form-group">
                                    <label>@lang('site.cours currency') </label>
                                    <select name="other_payment_currency" class="form-control select2" style="width: 100%;">
                                        @isset($currency_active)
                                            @foreach ($currency_active as $cours_currencys)
                                                @if ( $cours_currency['id'] != $cours_currencys->id)
                                                    <option value="{{ $cours_currencys->id }}">
                                                        {{ $cours_currencys->symbol }} <- {{ $cours_currencys->currency }}
                                                            </option>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <span class="text-danger" id="cours_currency_"> </span>
                        </div>

                        @csrf
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
                                name="receipt_description" id="receipt_description"
                                value="{{ $receipt['description'] }}">
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

                        <div id="div_pay_check" hidden>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">#</label>
                                <div class="col-sm-10">
                                    <input class='form-control' id="check_number" type="number" step="any"
                                        placeholder="@lang('site.Enter check number')" name="check_number" id="check_number"
                                        value="{{ $receipt['checkNum'] }}">
                                </div>
                                <span class="text-danger" id="check_number_"> </span>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">#</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="bank" id="bank">
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
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                @isset($payment)
                    {{-- {{dd($payment)}} --}}
                    <div class="table-responsive">
                        <table id="payment_table" class="table table-hover mb-0">
                            <tr>
                                <th scope="col">@lang('site.fee type')</th>
                                <th scope="col">@lang('site.fee value')</th>
                                <th scope="col">@lang('site.registration date')</th>
                                <th scope="col">@lang('site.paid')</th>
                                {{-- <th scope="col">@lang('site.paid date')</th> --}}
                                <th scope="col">@lang('site.remaining')</th>
                                {{-- <th scope="col">@lang('site.desription')</th> --}}
                            </tr>
                            <form id="alldata">

                                @if ($payment->count() > 0)
                                    @foreach ($payment as $feestopaid)
                                        <tr>
                                            {{-- <td scope="row"> feestopaid['id']</td> -- --}}
                                            <td scope="row"> {{ $feestopaid['cours_fee']['fee_type']['fee'] }} </td>
                                            <td scope="row"> {{ $feestopaid['cours_fee']['value'] }} </td>
                                            <td scope="row"> {{ $students['created_at']->format('d-m-Y') }} </td>
                                            <td scope="row"> {{ $feestopaid['paid_amount'] }} </td>
                                            <td scope="row"> {{ $feestopaid['remaining'] }} </td>

                                        </tr>
                                    @endforeach
                                @else
                                    {{-- @foreach ($fees as $feestopaid)
                                        <tr>

                                            <td scope="row">32 </td>
                                            <td scope="row"> 32</td>
                                            <td scope="row"> 32</td>
                                            @if (!empty($feestopaid['payment']))
                                                <td scope="row"> 32 </td>
                                                <td scope="row"> 32 </td>
                                            @else
                                                <td scope="row">0 </td>
                                                <td scope="row">  </td>
                                            @endif
                                        </tr>
                                    @endforeach --}}
                                @endif
                            </form>
                            <tr scope="col" class="text-warning text-uppercase">
                                <td scope="row">@lang('site.cours fee total') </td>

                                <td scope="row">{{ $cours['cours_fee_total']}}</td>
                                <td scope="row"> </td>
                                <td scope="row"> {{ $cours['cours_fee_total'] -$cours['remaining']}}</td>
                                <td scope="row">{{ $cours['remaining']}}</td>
                            </tr>
                        </table>
                    </div>
                @endisset



                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                                type="submit"
                                onclick="savepayment('{{ route('admin.payment_edit_to_receipt') }}');">
                                <span class=""> @lang('site.next step')</span>
                            </button>
                        </div>
                    </div>
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
