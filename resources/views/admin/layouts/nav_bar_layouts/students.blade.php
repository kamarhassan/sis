<li class="treeview   {{ $prefix == getprefix('students') ? 'active' : '' }}     ">
    <a href="#">
        <i class="fa fa-user-circle"></i>
        <span>@lang('site.students')</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        @can('show all students')
            <li><a href="{{ route('admin.students.all') }}">
                    <i class="ti-more">
                    </i>
                    @lang('site.all students')
                </a>
            </li>
        @endcan
        @can('register students')
            <li><a href="{{ route('admin.students.Registration-1') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                    <i class="ti-more">
                    </i>
                    @lang('site.register Student in Course')
                </a>
            </li>
        @endcan
        @can('payment students')
            <li><a href="{{ route('admin.students.get_std_to_payment') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                    <i class="ti-more">
                    </i>
                    @lang('site.register Student pay fee')
                </a>
            </li>
        @endcan
        @can('old payment students')
            <li><a href="{{ route('admin.all-receipt') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                    <i class="ti-more">
                    </i>
                    @lang('site.edit receipt and payment')
                </a>
            </li>
        @endcan
        @can('register order')
            <li><a href="{{ route('admin.new.register.order') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                    <i class="ti-more">
                    </i>
                    @lang('site.new registration order')
                </a>
            </li>
        @endcan



    </ul>
</li>