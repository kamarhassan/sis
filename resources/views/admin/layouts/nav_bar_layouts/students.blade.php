@canany([
    'show all students',
    'register students',
    'attendance students',
    'payment students',
    'edit old payment students',
    'delete old payment students',
    'print old payment students',
    'register order delete all',
    'register order deny all',
    'register order aprrove',
    'register order delete',
    'register order deny',
    ])

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
            @canany(['edit old payment students', 'delete old payment students', 'print old payment students'])
                <li><a href="{{ route('admin.all-receipt') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                        <i class="ti-more">
                        </i>
                        @lang('site.edit receipt and payment')
                    </a>
                </li>
            @endcan

            @canany([   'register order delete all',
            'register order deny all',
            'register order aprrove',
            'register order delete',
            'register order deny',])
                <li><a href="{{ route('admin.new.register.order') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                        <i class="ti-more">
                        </i>
                        @lang('site.new registration order')
                    </a>
                </li>
            @endcan
            @can('attendance students')
                <li><a href="{{ route('admin.take.attendance.students') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                        <i class="ti-more">
                        </i>
                        @lang('site.attendance students')
                    </a>
                </li>
            @endcan

        </ul>
    </li>



@endcan
