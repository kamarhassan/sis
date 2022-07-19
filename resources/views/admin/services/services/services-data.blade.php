<div class="box" id="spinner_loading">
    <div class="d-flex justify-content-center text-primary">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<div class="box" id="services-table-" hidden>
    {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
    <div class="box-body">
        <div class="table-responsive ">
            <table id="services-table" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.services')</th>
                        <th>@lang('site.fee amount')</th>
                        <th>@lang('site.currency name')</th>
                        <th>@lang('site.status')</th>
                        <th>@lang('site.options')</th>
                    </tr>

                </thead>
                <tbody>
                    @isset($services)
                        @foreach ($services as $key =>$servicess)
                            <tr class="Row{{ $servicess['id'] }} ">
                                <td>{{$key +1 }}</td>
                                <td>{{$servicess['service']}}</td>
                                <td>{{$servicess['fee']}}</td>
                                <td>{{$servicess['currency']['currency']}} - {{$servicess['currency']['abbr']}} - {{$servicess['currency']['symbol']}}</td>
                                <td>{{$servicess->getactive()}}</td>
                                <td>

                                    <a 
                                    class="btn text-success fa fa-pencil hover  hover-primary" title="@lang('site.edit')">
                                </a>
                                <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                    title="@lang('site.delete')"
                                    onclick="">
                                </a>

                                </td>
                            </tr>
                        @endforeach

                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
