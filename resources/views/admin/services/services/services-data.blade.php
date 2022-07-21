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
                        @foreach ($services as $key => $servicess)
                            <tr class="Row{{ $servicess['id'] }} ">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $servicess['service'] }}</td>
                                <td>{{ $servicess['fee'] }}</td>
                                <td>{{ $servicess['currency']['currency'] }} - {{ $servicess['currency']['abbr'] }} -
                                    {{ $servicess['currency']['symbol'] }}</td>
                                <td>{{ $servicess->getactive() }}</td>
                                <td>



                                    <ul>
                                        <li class="list-unstyled">
                                            <a class="btn text-success fa fa-pencil hover  hover-primary" data-toggle="modal" data-target="#modal-center"
                                            onclick="get_service('{{ route('admin.services.update', $servicess['id'] ) }}',{{ $servicess['id'] }},'{{ csrf_token() }}');"

                                            title="@lang('site.edit')">
                                            </a>   </li>

                                    </ul>



                                    <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                        title="@lang('site.delete')"
                                        onclick="delete_by_id('{{ route('admin.services.delete') }}',{{ $servicess['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
            {{ $services->links() }}
        </div>
    </div>
</div>
