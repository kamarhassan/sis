<div class=" col-12">
    <div class="box ">

        <div class="box-body">
            <div class="row">

                @isset($cours_currency)
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label>@lang('site.cours currency') <span class="text-danger">*</span></label>
                                <select name="cours_currency" class="selectize-multiple" style="width: 100%;">
                                    <option value="">-----------------</option>
                                    @foreach ($cours_currency as $cours_currencys)
                                        <option value="{{ $cours_currencys->id }}"
                                            @isset($coursfee) 
                                          @if($coursfee->count()>0)
                                             @if ($cours_currencys->id == $coursfee['0']->currencies_id)
                                                 selected
                                           
                                           @endisset
                                           @endif
                                        @endisset>
                                        {{ $cours_currencys->symbol }} <- {{ $cours_currencys->currency }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <span class="text-danger" id="cours_currency_"></span>
                </div>
            @endisset

        </div>
        @isset($fee_type)
            <div class="table-responsive">
                <table class="table table-hover ">
                    <tr>
                        <th>@lang('site.select fee')</th>
                        <th>@lang('site.fee value')</th>
                    </tr>

                    @foreach ($fee_type as $key => $feeType)
                        <tr>
                            <td>

                                <div class="demo-checkbox">
                                    <fieldset>
                                        <div class="float-left">
                                            <input type="checkbox"
                                                @isset($coursfee)
                                                @foreach ($coursfee as $item)
                                                  @if ($item['fee_types_id'] == $feeType->id)   checked @endif                                                @endforeach
                                            @endisset
                                            
                                                value=""
                                                @isset($std_register_count)
                                                 @if ($std_register_count == 0) name="fee[{{ $feeType->id }}]" @else disabled @endif
                                           @endisset
                                                onchange='total_coust(@json($fee_type_id) );'
                                                class="switchBootstrap fee_{{ $feeType->id }}"
                                                id="md_checkbox_{{ $feeType->id }}" data-on-text="Enable"
                                                data-off-text="Disable" />
                                        </div>
                                        <label for=""
                                            class="font-medium-2 text-bold-600 mr-1 text-success"></label>
                                        <label for="md_checkbox_{{ $feeType->id }}">{{ $feeType->fee }}</label>


                                    </fieldset>

                                </div>
                            </td>
                            <td>

                                <input class="form-control fee_value_{{ $feeType->id }}" type="number" step="any"
                                    @isset($std_register_count) 
                                 @if ($std_register_count > 0) disabled   @endif
                               @endisset
                                    onchange='total_coust(@json($fee_type_id) );'
                                    id="fee_value_{{ $feeType->id }}" />
                                <span class="text-danger" id="fee_{{ $key + 1 }}_"></span>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <div>
                                <label for="total_coust" id="total_coust">@lang('site.total_coust')</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <label for="total_coust" id="total_coust_fee">0</label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        @endisset
    </div>
</div>
