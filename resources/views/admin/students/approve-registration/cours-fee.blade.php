<div class="box">
   {{-- <div class="box-header with-border">
       <h3 class="box-title text-capitalize text-warning text-uppercase "> <span>@lang('site.result')</span></h3>
   </div> --}}
   <!-- /.box-header -->
   <div class="box-body">

       <div class="table-responsive">
           <div class="box-header with-border">
               <h4 class="box-title">@lang('site.fee of this cours is')
                   <span class="badge badge-pill badge-danger">

                       @isset($cours_fee_currency)
                           {{ $cours_fee_currency['currency'] }} -> {{ $cours_fee_currency['abbr'] }}
                       @endisset
                   </span>
               </h4>
           </div>
           @isset($cours_fee)
               @if ($cours_fee->count() > 0)
                   <table class="table table-hover mb-0">
                       <tr>
                           <th scope="col">@lang('site.fee required') / @lang('site.fee type')<br> <span id="cours_fee_" class="text-danger"></span>                            </th>
                           <th scope="col">@lang('site.fee value')</th>
                           <th scope="col" id="tr_sponsore_selected_percent" hidden>@lang('site.covered by sponsore') </th>
                           <th scope="col" id="tr_sponsore_selected_discount" hidden>@lang('site.covered by sponsore')%</th>

                       </tr>

                       @foreach ($cours_fee as $key => $cours_fe)
                           <tr>
                               <td scope="row">
                                   <input type="checkbox" checked name="cours_fee[]" class="chk-col-primary"
                                       id="cours_fee{{ $cours_fe['id'] }}" value="{{ $cours_fe['id'] }}"
                                       onchange="reset_percent_discount_input('{{ $cours_fe['id'] }}','#select_one_of_fee_1',{{$cours_fee}});" />
                                   <label for="cours_fee{{ $cours_fe['id'] }}">{{ $cours_fe->fee_type['fee'] }}</label>
                               </td>
                               <input type="hidden" name='fee[{{ $cours_fe['id'] }}]'
                                   id="cours_fee_value_{{ $cours_fe['id'] }}" value=" {{ $cours_fe->value }}">
                               <td scope="row">{{ $cours_fe->value }}</td>

                               <td scope="row" id="td_sponsore_selected_percentage_{{ $cours_fe['id'] }}" hidden>
                               
                                   <input type="number" id="discount_{{ $cours_fe['id'] }}" name="fee_sponsored_discount[{{ $cours_fe['id'] }}]"
                                       class="form-control" placeholder="@lang('site.discount')"  onchange="calculate_percent('{{ $cours_fe['id'] }}', {{$cours_fee}},{{$cours_fe['id']}},{{ $total_cours_fee }})" />


                               </td>
                               <td scope="row" id="td_sponsore_selected_discount_{{ $cours_fe['id'] }}" hidden>
                                   <input type="number" id="percent_{{ $cours_fe['id'] }}" name="fee_sponsored_percent[{{ $cours_fe['id'] }}]"
                                       class="form-control"  placeholder="@lang('site.percent')" onchange="calculate_discount('{{ $cours_fe['id'] }}', {{$cours_fee}},{{$cours_fe['id']}},{{ $total_cours_fee }})" />
                               </td>

                           </tr>
                       @endforeach
                       <tr scope="col" class="text-warning text-uppercase">
                           <td scope="row">@lang('site.cours fee total') </td>
                           <td scope="row"> <span id="total_coust" class="text-warning">{{ $total_cours_fee }}</span> </td>
                           <td scope="row" id="td_discount_total" hidden><span id="discount_total" class="text-warning"></span></td>
                           <td scope="row" id="td_percent_total" hidden ><span id="percent_total" class="text-warning"></span></td>
                       </tr>
                   </table>
           </div> 
       @elseif ($cours_fee->count() == 0)
           <div>
               <label>
                   <span class="border-warning">
                       <h3 class="text-danger">
                           @lang('site.fee of this cours note defined')
                       </h3>
                   </span>
               </label>
           </div>
       @else
           @endif
       @endisset


   </div>
</div>
