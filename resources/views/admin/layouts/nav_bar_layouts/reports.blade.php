@canany(['reports', 'cours','view report'])
    
 
    <li class="treeview   {{ $prefix == getprefix('reports') ? 'active' : '' }}     ">
        <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>@lang('site.report')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            @can('view report')
                <li><a href="{{ route('admin.report') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.report')
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endcan
