<table class="no-border">
    <tr>
        <td  colspan="2">
            <h2 class="d-inline"><span class="font-size-30">@lang('site.receipt')</span></h2>
        </td>
        <td  colspan="2">
            <h3><label>@lang('site.Release Date')</label> :{{ $receipt->created_at->format('d-m-Y') }}
            </h3>
        </td>
    </tr>
    <tr>
        <td  colspan="2">
            <strong>@lang('site.from')</strong>
            <address>

                <strong class="text-blue bb-1 font-size-24">{{ $user->name }}</strong>
                <br>@lang('site.registration id') : {{ $std[0]['id'] }}<br>
                <br>@lang('site.registration date') : {{ $std[0]['created_at']->format('d-m-Y') }}<br>

            </address>
        </td>
        <td  colspan="2">
            <strong>@lang('site.to')</strong>
            <address>
                <strong class="text-blue bb-1  font-size-24">@lang('site.site name') </strong><br>
                <strong class="d-inline">العنوان from database settings table and site name</strong><br>
                <strong>تفاصيل email , nb pfone ...... from database settings table and site name</strong>
            </address>
        </td>
    </tr>
    <tr>
        <td><b>receipr id # {{ $receipt->id }}</b></td>
        <td><b>user ID : {{ $std[0]['cours_id'] }}</b></td>
        <td><b>cours : {{ $std[0]['user_id'] }}</b></td>
        <td><b>amount: {{ $receipt->amount }}</b></td>
    </tr>
</table>



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
                    @else
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
