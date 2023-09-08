<div class="box">
    <div class="box-body">
        @isset($cours->fee_with_type)
            <div class="table-responsive">
                <table class="table table-hover ">
                    <tr>
                        <th>@lang('site.select fee')</th>
                        <th>@lang('site.fee value')</th>
                    </tr>

                    @foreach ($cours->fee_with_type as $key => $feeType)
                        <tr>

                            <td>
                                {{ $feeType['fee_type']['fee'] }}
                            </td>
                            <td>
                                {{ $feeType['value'] }}
                            </td>



                        </tr>
                    @endforeach
                    <tr>
                        <td><span class="text-warning">@lang('site.total_coust') </span> </td>
                        <td>
                            <span class="text-warning">{{ $total_cost }}</span>

                        </td>
                    </tr>
                </table>
            </div>
        @endisset

    </div>
</div>
