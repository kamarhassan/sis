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
                        @lang('site.student name') : <span class="bb-1 border-success">
                            {{ $user[0]['name'] }}

                        </span>
                    </span>
                </div>
                <div class="col-md-6">
                    <span>
                        @lang('site.cours info') : <span class="bb-1 border-success">
                            @if ($cours[0]['grade']['grade'] != '' && $cours[0]['level']['level'] != '' && $cours[0]['teacher']['name'] != '')
                                {{ $cours[0]['grade']['grade'] }} - {{ $cours[0]['level']['level'] }} -
                                {{ $cours[0]['teacher']['name'] }}
                            @endif
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
                    {{ $fees[0]['currency']['currency'] }} - {{ $fees[0]['currency']['abbr'] }} -
                    {{ $fees[0]['currency']['symbol'] }}
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
                        <input type="hidden" name="cours_id" id="cours_id" value="{{ encript_custome($cours[0]['id'] )}}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ encript_custome($user[0]['id']) }}">
                        @csrf
                        <div class="col-md-6" id="normal_pament">
                            <input type="number" id="amount_to_paid" step="any" class='form-control'
                                placeholder="@lang('site.paid fee here')" name="amount_to_paid" value="0">
                            <span class="text-danger" id="amount_to_paid_"> </span>
                        </div>

                        <div class="row" id="Other_payment" hidden>
                            <div class="col-md-6" id="normal_pament">
                                @lang('site.paid fee here')
                                <input type="number" id="other_amount_to_paid" step="any" class='form-control'
                                    placeholder="@lang('site.paid fee here')" name="other_amount_to_paid" value="0">
                                <span class="text-danger" id="other_amount_to_paid_"> </span>
                            </div>
                            <div class="col-md-6" id="normal_pament">
                                @lang('site.rate exchange')
                                <input type="number" id="rate" step="any" class='form-control'
                                    placeholder="@lang('site.rate')" name="rate" value="1">
                                <span class="text-danger" id="rate_"> </span>
                            </div>
                            <div class="col-md-6" id="normal_pament">
                                <div class="form-group">
                                    <label>@lang('site.cours currency') </label>
                                    <select name="cours_currency" class="form-control select2" style="width: 100%;">
                                        @foreach ($cours_currency as $cours_currencys)
                                            <option value="{{ $cours_currencys->id }}">
                                                {{ $cours_currencys->symbol }} <- {{ $cours_currencys->currency }}
                                                    </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <span class="text-danger" id="cours_currency_"> </span>
                        </div>

                        @csrf
                        <div class="col-md-2">
                            <div class="demo-checkbox">
                                <input type="checkbox" name="payment_methode" id="payment_methode" class="chk-col-success"
                                    onchange='change_payment_methode();' value="1"/>
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


                                    <input name="pay_type" type="radio" id="pay_check_" onclick="change_pay_type(this.value);"
                                        value="pay_check_">
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
                                        placeholder="@lang('site.Enter check number')" name="check_number" id="check_number">
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
                                @foreach ($fees as $feestopaid)
                                    <tr>
                                        {{-- <td scope="row"> feestopaid['id']</td> -- --}}
                                        <td scope="row"> {{ $feestopaid['fee_type']['fee'] }} </td>
                                        <td scope="row"> {{ $feestopaid['value'] }} </td>
                                        <td scope="row"> {{ $std[0]['created_at']->format('d-m-Y') }} </td>
                                        @if (!empty($feestopaid['payment']))
                                            <td scope="row">{{ $feestopaid['payment']['paid_amount'] }} </td>
                                            <td scope="row"> {{ $feestopaid['payment']['remaining'] }} </td>
                                        @else
                                            <td scope="row">0 </td>
                                            <td scope="row"> {{ $feestopaid['value'] }} </td>
                                        @endif
                                    </tr>
                                @endforeach
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


                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                                type="submit"
                                onclick="savepayment('{{ route('admin.payment.payment_to_receipt') }}','{{ csrf_token() }}','{{ encript_custome($std[0]['user_id']) }}','{{ encript_custome($std[0]['cours_id']) }}');">
                                <span class=""> @lang('site.next step')</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endsection


            @section('script')
                <script src="{{ URL::asset('assets\custome_js\payment_for_cours.js') }}"></script>
            @endsection
