@canany(['payment students', 'payment remaining'])


    <li class="treeview {{ $prefix == getprefix('reports') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>@lang('site.accounting')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">


            @can('payment students')
                <li><a href="{{ route('admin.students.get_std_to_payment') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                        <i class="ti-more">
                        </i>
                        @lang('site.register Student pay fee')
                    </a>
                </li>
            @endcan

            @can('payment remaining')
                <li><a href="{{ route('admin.get.remaining.for.services') }}">
                        <i class="ti-more"></i>
                        @lang('site.register service pay fee')
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endcan
