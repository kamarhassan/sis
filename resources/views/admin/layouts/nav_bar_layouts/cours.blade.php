<li class="treeview   {{ $prefix == getprefix('cours') ? 'active' : '' }}     ">
    <a href="#">
        <i class="fa fa-book "></i>
        <span>@lang('site.cours')</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        @can('show all cours')
            <li><a href="{{ route('admin.cours.all') }}">
                    <i class="ti-more">
                    </i>
                    @lang('site.all cours')
                </a>
            </li>
        @endcan
        @can('create cours')
            <li><a href="{{ route('admin.cours.add') }}">
                    <i class="ti-more">
                    </i>
                    @lang('site.add new cours')
                </a>
            </li>
        @endcan


    </ul>
</li>