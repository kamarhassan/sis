@canany(['cours',  'create cours', 'edit cours', 'delete cours'])
    <li class="treeview {{ $prefix == getprefix('cours') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-book "></i>
            <span>@lang('site.class')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            @can('edit cours', 'delete cours')
                <li><a href="{{ route('admin.cours.all') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.all class')
                    </a>
                </li>
            @endcan
            @can('create cours')
                <li><a href="{{ route('admin.cours.add') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.add class')
                    </a>
                </li>
            @endcan


        </ul>
    </li>
@endcan
