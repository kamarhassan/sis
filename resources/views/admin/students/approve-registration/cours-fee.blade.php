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
                            <th scope="col">@lang('site.fee required') / @lang('site.fee type')</th>
                            <th scope="col">@lang('site.fee value')</th>

                        </tr>

                        @foreach ($cours_fee as $cours_fe)
                            <tr>
                                <td scope="row">
                                    <input type="checkbox" checked name="feerequired[]" class="chk-col-primary"
                                        id="md_checkbox_{{ $cours_fe->id }}" value="{{ $cours_fe->id }}" name="" />
                                    <label for="md_checkbox_{{ $cours_fe->id }}">{{ $cours_fe->fee_type['fee'] }}</label>
                                </td>
                                <td scope="row">{{ $cours_fe->value }}</td>
                            </tr>
                        @endforeach
                        <tr scope="col" class="text-warning text-uppercase">
                            <td scope="row">@lang('site.cours fee total') </td>
                            <td scope="row"> {{ $total_cours_fee }}</td>
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
