{{--<div class="box" id="spinner_loading">--}}
{{--    <div class="d-flex justify-content-center text-primary">--}}
{{--        <div class="spinner-border" role="status">--}}
{{--            <span class="sr-only">Loading...</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="box" id="admin_table" hidden>

    {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-hover">
                <thead>

                    <tr>
                        <th>@lang('site.sponsor type')</th>
                        <th>@lang('site.sponsor name')</th>
                        {{-- <th>@lang('site.sponsor is blocked')</th> --}}
                        <th>@lang('site.sponsor limit budget')</th>
                        <th>@lang('site.sponsor limit students')</th>
                        <th>@lang('site.sponsor default %')</th>
                        <th>@lang('site.options')</th>
                        {{--  <th>@lang('site.nbumber of cours')</th>
                        <th>@lang('site.students photo')</th> --}}
                    </tr>

                </thead>
                <tbody>
                    @isset($sponsor)
                        @foreach ($sponsor as $sponsors)
                            <tr id="Row{{ $sponsors['id'] }}" class="mb-10 p-10 cursor_pointer hover-success">
                                <td>{{ $sponsors['type'] }}</td>
                                <td>{{ $sponsors['name'] }}</td>
                                {{-- <td>{{ $sponsors['blocked'] }}</td> --}}
                                <td>{{ $sponsors['budgetLimit'] }}</td>
                                <td>{{ $sponsors['studentLimit'] }}</td>
                                <td>{{ $sponsors['defaultpercent'] }}</td>
                                <td>
                                    {{-- 'edit sponsore', --}}
                                    @can('delete sponsor')
                                        <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                            title="@lang('site.delete')"
                                            onclick="delete_by_id('{{ route('admin.sponsor.delete.sponsor') }}',{{ $sponsors['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endisset


                </tbody>
            </table>
        </div>
    </div>




</div>