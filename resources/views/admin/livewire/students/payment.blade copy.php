<div class="box bl-3 border-warning br-3">
    <div class="box-body">
        <div class="box-header with-border">
            <h3 class="box-title text-capitalize text-warning text-uppercase "> <span>@lang('site.receipt info')</span>
            </h3>
        </div>
        <div class="row show-grid">
            <div class="col-md-6">
                <span>
                    @lang('site.student name') : <span class="bb-1 border-success">
                        @isset($std_name)
                            {{ $std_name }}
                        @endisset
                    </span>
                </span>
            </div>
            <div class="col-md-6">
                <span>
                    @lang('site.cours info') : <span class="bb-1 border-success">

                        @if ($coursinfo->grade['grade'] != '' && $coursinfo->level['level'] != '' && $coursinfo->teacher['name'] != '')
                            {{ $coursinfo->grade['grade'] }} -{{ $coursinfo->level['level'] }} -
                            {{ $coursinfo->teacher['name'] }}
                        @endif
                    </span>
                </span>
            </div>

        </div> <!-- End of row show-grid cours info and std name -->

    </div>


    <div class="box">
        @if ($cours_fee_count > 0)
            <div class="col-md-4">
                <h4 class=" bb-1  bb-double border-danger box-title text-capitalize  text-uppercase"
                    style="color:rgb(255, 153, 0)"> @lang('site.fee of this cours is')
                    {{ $cours_fee[0]->currency['currency'] }}- {{ $cours_fee[0]->currency['abbr'] }}-
                    {{ $cours_fee[0]->currency['symbol'] }}
                </h4>
            </div>
        @endif
        <div class="row show-grid">
            <div class="col-md-3">
                <span>
                    @lang('site.amount') :
                </span>
            </div>
            <div class="col-md-6">
                <input type="number" step="any" wire:model="amount_to_paid" class='form-control'
                    placeholder="@lang('site.paid fee here')" name="amount_to_paid">
                    @error('amount_to_paid')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
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

                <input type="text" wire:model="receipt_description" class='form-control'
                    placeholder="@lang('site.description')" name="receipt_description">
                <span class="bb-1 border-success">
            </div>
        </div>
    </div>
    <div class="box ">
        <!-- End of row show-grid payment  -->
        <div class="row show-grid">
            <div class="col-md-2">
                <span>
                    @lang('site.payment') : <span class="bb-1 border-success">
                    </span>
                </span>
            </div>
            {{-- <div class="col-md-3">
                <span>
                    @lang('site.payment type') <span class="bb-1 border-success">
                    </span>
                </span>
            </div> --}}

            <div class="col-md-3">
                <div class="form-group">
                    <div class="radio">
                        <input name="group1" type="radio" id="Option_1" @if ($payment_type == 'pay_cache_') checked @endif
                            wire:model="payment_type" wire:change="switch_payment_type($event.target.value)"
                            value="pay_cache_">
                        <label for="Option_1">cache</label>


                        <input name="group1" type="radio" id="Option_2" @if ($payment_type == 'pay_check_') checked @endif
                            wire:model="payment_type" wire:change="switch_payment_type($event.target.value)"
                            value="pay_check_">
                        <label for="Option_2">check</label>
                    </div>
                </div>
            </div>

            @switch($payment_type)
                @case('pay_cache_')
                    {{-- {{ $payment_type }} --}}
                @break

                @case('pay_check_')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-1 col-form-label">#</label>
                        <div class="col-sm-10">
                            <input wire:model='check_number' class='form-control' id="check_number" type="number" step="any"
                                placeholder="@lang('site.Enter check number')" name="check_number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-1 col-form-label">#</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>slect from bank list 1</option>
                                <option>slect from bank list 2</option>
                                <option>slect from bank list3 </option>
                                <option>slect from bank list 4</option>
                                <option>slect from bank list 5</option>
                            </select>
                        </div>
                    </div>
                @break

                @default
                    {{ $payment_type }}
            @endswitch
        </div>
    </div>
    <div class="col-md-12">


        @if ($cours_fee_count > 0)
            <div class="table-responsive">

                <table id="payment_table" class="table table-hover mb-0">
                    <tr>
                        <th scope="col">@lang('site.fee type')</th>
                        <th scope="col">@lang('site.fee value')</th>
                        <th scope="col">@lang('site.registration date')</th>
                        <th scope="col">@lang('site.paid')</th>
                        <th scope="col">@lang('site.paid date')</th>
                        <th scope="col">@lang('site.remaining')</th>
                        <th scope="col">@lang('site.desription')</th>
                    </tr>

                    @foreach ($cours_fee as $cours_fe)
                        <tr>
                            <td scope="row">{{ $cours_fe->fee_type['fee'] }}</td>
                            <td scope="row">{{ $cours_fe->value }}</td>


                        </tr>
                    @endforeach

                    <tr scope="col" class="text-warning text-uppercase">
                        <td scope="row">@lang('site.cours fee total') </td>
                        <td scope="row"> {{ $cours_fee_sum }}</td>
                    </tr>
                </table>
            </div>
        @elseif ($cours_fee_count == 0)
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
        <div>

            @if ($cours_fee_count == 0)
                <a class="btn btn-success glyphicon glyphicon-ok" title="@lang('site.save')">
                </a>
            @elseif($cours_fee_count < 0)
                <a class="btn btn-success glyphicon glyphicon-ok" title="@lang('site.save')">
                </a>
            @else
                <button class="btn btn-success glyphicon glyphicon-ok" wire:click="save_payment()"
                    title="@lang('site.save')" type="submit">
                </button>
            @endif

            {{-- <button class="btn btn-success glyphicon glyphicon-ok" wire:click="save_payment()"
                title="@lang('site.save')" type="submit">
            </button> --}}
        </div>
    </div>
