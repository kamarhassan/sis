@extends('admin.layouts.master')
@section('title')
   @lang('site.payment')
@endsection
@section('css')
@endsection
@section('content')
   <section id="striped-row-form-layouts">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                     </ul>
                  </div>
               </div>
               <div class="card-content collpase show">
                  <div class="card-body">

                     <form id="payment_data" class="form form-horizontal striped-rows form-bordered">
                        @csrf
                        <div class="form-body">
                           <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                           <div class="form-group row">
                              <label class="col-md-4 label-control" for="projectinput1">
                                 @lang('site.student name') : <span class="">
                                 {{ $user['name'] }}</label>
                              <label class="col-md-6 label-control" for="projectinput1">
                                 @lang('site.cours info') :  
                                           @if ($cours['category_grade_level']['grade']['grade'] != '' && $cours['category_grade_level']['level']['level'] != '' && $cours['teacher']['name'] != '')
                                       <span
                                          class="bb-3  bb-double text-warning"> @lang('site.teacher name') :   {{ $cours['teacher']['name'] }}</span>
                                    
                                       <span class="bb-3  bb-double text-warning"> @lang('site.categorie info') : {{ $cours['category_grade_level']['name'] }} 
                                    
                                       [{{ $cours['category_grade_level']['grade']['grade'] }} \ {{ $cours['category_grade_level']['level']['level'] }} ]
                                    </span>
                                     
                                 @endif
                              </label>

                           </div>
                           <div class="form-group row">
                              <label class="col-md-12 label-control" for="projectinput2">
                                 <h4 class=" bb-1  border-danger box-title text-capitalize  text-uppercase"
                                     style="color:rgb(255, 153, 0);align:right;">
                                    @lang('site.fee of this cours is')
                                    {{-- @isset($fees) 
                                   {{ $fees['currency']['currency'] }} - {{ $fees['currency']['abbr'] }} -
                                   {{ $fees['currency']['symbol'] }}
                             @endisset --}}
                                 </h4>
                              </label>

                           </div>


                           <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput5">
                                 @lang('site.amount')</label>


                              <div class="row show-grid">
                                 <input type="hidden" name="cours_id" id="cours_id"
                                        value="{{ encript_custome($cours['id']) }}">
                                 <input type="hidden" name="user_id" id="user_id"
                                        value="{{ encript_custome($user['id']) }}">
                                 <input type="hidden" name="user_id" id="user_id"
                                        value="{{ encript_custome($user['id']) }}">
                                 <input type="hidden" name="cours_currency_abbr" id="cours_currency_abbr"
                                        value="{{ $cours_fee_currency['abbr'] }}">
                                 <input type="hidden" name="cours_currency_id" id="cours_currency_abbr"
                                        value="{{ $cours_fee_currency['id'] }}">


                                 @csrf
                                 <div class="col-md-9" id="normal_pament">
                                    <input type="number" id="amount_to_paid" step="any"
                                           class='form-control' placeholder="@lang('site.paid fee here')"
                                           name="amount_to_paid" value="0">
                                    <span class="text-danger" id="amount_to_paid_"> </span>
                                 </div>

                                 <div class="col-md-9" id="Other_payment" hidden>
                                    <div class="col-md-9" id="normal_pament">
                                       @lang('site.paid fee here')
                                       <input type="number" id="other_amount_to_paid" step="any"
                                              class='form-control' placeholder="@lang('site.paid fee here')"
                                              name="other_amount_to_paid" value="0">
                                       <span class="text-danger" id="other_amount_to_paid_"> </span>
                                    </div>
                                    <div class="col-md-9" id="normal_pament">
                                       @lang('site.rate exchange')
                                       <input type="number" id="rate" step="any" class='form-control'
                                              placeholder="@lang('site.rate')" name="rate" value="0">
                                       <span class="text-danger" id="rate_"> </span>
                                    </div>
                                    <div class="col-md-9" id="normal_pament">
                                       <div class="form-group">
                                          <label>@lang('site.cours currency') </label>
                                          <select name="other_payment_currency" class="form-control select2"
                                                  style="width: 100%;">
                                             @foreach ($cours_currency as $cours_currencys)
                                                @if ($cours_fee_currency['id'] != $cours_currencys->id)
                                                   <option value="{{ $cours_currencys->id }}">

                                                      {{ $cours_currencys->symbol }} <-
                                                      {{ $cours_currencys->currency }} </option>
                                                @endif
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <span class="text-danger" id="cours_currency_"> </span>
                                 </div>


                                 <div class="col-md-2">
                                    <div class="demo-checkbox">
                                       <input type="checkbox" name="payment_methode" id="payment_methode"
                                              class="chk-col-success" onchange='change_payment_methode();'
                                              value="1"/>
                                       <label for="payment_methode">@lang('site.other payment')</label>
                                    </div>
                                 </div>

                              </div>

                           </div>


                           <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">
                                 @lang('site.receipt description')</label>
                              <div class="col-md-9">
                                 <input type="text" class='form-control' placeholder="@lang('site.description')"
                                        name="receipt_description" id="receipt_description">
                              </div>


                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput7"> @lang('site.payment type')
                              </label>
                              <div class="col-md-9">
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
                           {{--                               <div class="form-group row">--}}
                           {{--                                   <div class="col-md-12" id="div_pay_check" hidden>--}}
                           {{--                                       <div class="col-md-6" id="normal_pament">--}}
                           {{--                                           <label>#@lang('site.check number')</label>--}}
                           {{--                                           <input class='form-control' id="check_number" type="number"--}}
                           {{--                                               step="any" placeholder="@lang('site.Enter check number')" name="check_number"--}}
                           {{--                                               id="check_number">--}}
                           {{--                                           <span class="text-danger" id="check_number_"> </span>--}}
                           {{--                                       </div>--}}

                           {{--                                       <div class="col-md-6">--}}
                           {{--                                           <div class="form-group">--}}
                           {{--                                               <label>#@lang('site.bank')</label>--}}
                           {{--                                               <select class="form-control select2" name="bank" id="bank"--}}
                           {{--                                                   class="form-control select2" style="width: 100%;">--}}
                           {{--                                                   <option></option>--}}
                           {{--                                                   <option>slect from bank list 2</option>--}}
                           {{--                                                   <option>slect from bank list3 </option>--}}
                           {{--                                                   <option>slect from bank list 4</option>--}}
                           {{--                                                   <option>slect from bank list 5</option>--}}
                           {{--                                               </select>--}}
                           {{--                                           </div>--}}
                           {{--                                       </div>--}}
                           {{--                                       <span class="text-danger" id="bank_"> </span>--}}
                           {{--                                   </div>--}}
                           {{--                               </div>--}}

                           <div class="form-group row last">
                              <label class="col-md-3 label-control"
                                     for="projectinput9">@lang('site.fee required')</label>
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
                                             {{-- <th scope="col">@lang('site.desription')</th> --}}
                                          </tr>
                                          <form id="alldata">

                                             @if ($payment->count() > 0)
                                                @foreach ($payment as $feestopaid)
                                                   <tr>
                                                      {{-- <td scope="row"> feestopaid['id']</td> -- --}}
                                                      <td scope="row">
                                                         {{ $feestopaid['cours_fee']['fee_type']['fee'] }}
                                                      </td>
                                                      <td scope="row">
                                                         {{ $feestopaid['cours_fee']['value'] }} </td>
                                                      <td scope="row">
                                                         {{ $std['created_at']->format('d-m-Y') }} </td>
                                                      <td scope="row"> {{ $feestopaid['paid_amount'] }}
                                                      </td>
                                                      <td scope="row"> {{ $feestopaid['remaining'] }}
                                                      </td>

                                                   </tr>
                                                @endforeach
                                             @else
                                                @foreach ($fees as $feestopaid)
                                                   <tr>
                                                      <td>{{ $feestopaid['fee_type_value'] }}</td>
                                                      <td>{{ $feestopaid['fee_value'] }}</td>

                                                      <td scope="row">
                                                         {{ $std['created_at']->format('d-m-Y') }}
                                                      </td>
                                                      <td scope="row"> 0</td>
                                                      <td>{{ $feestopaid['fee_value'] }}</td>

                                                      {{-- <td scope="row">0 </td> --}}
                                                      {{-- <td scope="row"> {{ $feestopaid['value'] }} --}}
                                                      </td>


                                                   </tr>



                                                @endforeach
                                             @endif
                                          </form>
                                          <tr scope="col" class="text-warning text-uppercase">
                                             <td scope="row">@lang('site.cours fee total') </td>
                                             <td scope="row"> {{ $std['cours_fee_total'] }}</td>
                                             <td scope="row"></td>
                                             <td scope="row">
                                                {{ $std['cours_fee_total'] - $std['remaining'] }} </td>
                                             <td scope="row"> {{ $std['remaining'] }}</td>
                                          </tr>
                                       </table>
                                    </div>
                                 @endisset
                              </div>
                           </div>
                           <div class="form-actions">


                              <div class="col-md-3">
                                 <a class="btn  glyphicon glyphicon-arrow-left hover-success "
                                    title="@lang('site.save')" type="submit"
                                    onclick="savepayment('{{ route('admin.payment.payment_to_receipt') }}');">
                                    <span class=""> @lang('site.next step')</span>
                                 </a>

                              </div>
                           </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </section>

@endsection


@section('script')
   <script src="{{ URL::asset('assets/custome_js/payment_for_cours_and_services.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
   </script>
@endsection
