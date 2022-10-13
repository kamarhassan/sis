@canany(['register service to client', 'old services receipt', 'edit old services receipt', 'delete old services
    receipt', 'print old services receipt'])
    <li class="treeview   {{ $prefix == getprefix('services') ? 'active' : '' }}     ">
        <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>@lang('site.services')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('register service to client')
                <li><a href="{{ route('admin.Services.to.client') }}">
                        <i class="ti-more"></i>
                        @lang('site.services')
                    </a>
                </li>
            @endcan
            @canany(['edit old services receipt', 'delete old services receipt', 'print old services receipt'])
                <li><a href="{{ route('admin.Services.all-receipt') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                        <i class="ti-more">
                        </i>
                        @lang('site.edit receipt and payment')
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
