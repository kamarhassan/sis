<li class="treeview   {{ $prefix == getprefix('setting') ? 'active' : '' }}     ">
    <a href="#">
        <i class="ti-settings"></i>
        <span>@lang('site.setting')</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

        <li class="treeview   {{ $prefix == getprefix('supervisor') ? 'active' : '' }}     ">
            <a href="#">
                <i class="si si-people"></i>
                <span>@lang('site.supervisor')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">

                <li><a href="{{ route('admin.supervisor.all') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.all supervisor')
                    </a>
                </li>
                <li><a href="{{ route('admin.supervisor.add') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.supervisor add')
                    </a>
                </li>

            </ul>
        </li>


        @can('language')
            <li><a href="{{ route('admin.language') }}">
                    <i class="ti-more">
                    </i>
                    @lang('site.website language')
                </a>
            </li>
        @endcan
        @can('grades')
            <li><a href="{{ route('admin.grades.add') }}">
                    <i class="ti-more"></i>@lang('site.add new grade')</a></li>
        @endcan

        @can('levels')
            <li><a href="{{ route('admin.level.add') }}">
                    <i class="ti-more"></i>@lang('site.add new level')</a></li>
        @endcan

        @can('activate_currency')
            <li><a href="{{ route('admin.Currency.get') }}">
                    <i class="ti-more"></i>@lang('site.add new Currency')</a></li>
        @endcan

        @can('services')
            <li><a href="{{ route('admin.Services.add') }}">
                    <i class="ti-more"></i>
                    @lang('site.add and edit services')
                </a>
            </li>
        @endcan
        @can('roles')
            <li><a href="{{ route('admin.setting.role') }}">
                    <i class="ti-more"></i>
                    @lang('site.role and permission')
                </a>
            </li>
        @endcan

        @can('fee type')
            <li><a href="{{ route('admin.setting.fee') }}">
                    <i class="ti-more"></i>
                    @lang('site.fees')
                </a>
            </li>
        @endcan
    </ul>
</li>
