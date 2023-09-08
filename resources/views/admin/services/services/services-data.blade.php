{{--<div class="box" id="spinner_loading">--}}
{{--    <div class="d-flex justify-content-center text-primary">--}}
{{--        <div class="spinner-border" role="status">--}}
{{--            <span class="sr-only">Loading...</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="box" id="services-table-" >
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
                        {{-- <th>@lang('site.status')</th> --}}
                        <th>@lang('site.options')</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($services)

                        @foreach ($services as $key => $servicess)
                            <tr class="Row{{ $servicess['id'] }}" id="Row{{ $servicess['id'] }}">
                                <td>{{ $key + 1 }}

                                </td>
                                <td>{{ $servicess['service'] }}
                                    <div class="box-body ribbon-box">
                                        @if ($servicess->active == 1)
                                            <div class="ribbon-two ribbon-two-success">
                                                <span>{{ $servicess->getactive() }}</span>
                                            </div>
                                        @else
                                            <div class="ribbon-two ribbon-two-danger">
                                                <span>{{ $servicess->getactive() }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td>{{ $servicess['fee'] }}</td>
                                <td>{{ $servicess['currency']['currency'] }} - {{ $servicess['currency']['abbr'] }} -
                                    {{ $servicess['currency']['symbol'] }}</td>
                                <td>
                                    <div class="row">

                                        @can('edit setting services')
                                            <ul>
                                                <li class="list-unstyled">
                                                    <a class="btn text-success fa fa-pencil hover  hover-primary"
                                                        onclick="get_service('{{ route('admin.services.to-update', $servicess['id']) }}','{{ csrf_token() }}');"
                                                        title="@lang('site.edit')">
                                                    </a>
                                                </li>
                                            </ul>
                                        @endcan
                                        @can('delete setting services')
                                            <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                                title="@lang('site.delete')"
                                                onclick="delete_by_id('{{ route('admin.services.delete') }}',{{ $servicess['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                            </a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            {{-- {{ $services->links() }} --}}
        </div>
    </div>
</div>
