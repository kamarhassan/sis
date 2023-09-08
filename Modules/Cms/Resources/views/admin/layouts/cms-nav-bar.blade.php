@canany(['create menu', 'edit menu', 'delete menu', 'create page', 'edit page', 'edit design page', 'delete page'])

  








    <li class="treeview {{ $prefix == getprefix('cms') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>@lang('site.cms')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            @canany(['create menu', 'edit menu', 'delete menu'])
                <li><a href="{{ route('cms.admin.menu') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.create menu')
                    </a>
                </li>
            @endcan

            @canany(['create page', 'edit page', 'delete page'])
                <li><a href="{{ route('cms.admin.page') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.pages')
                    </a>
                </li>
            @endcan
            {{--            @canany(['create page', 'edit page', 'delete page']) --}}
            <li><a href="{{ route('footerSetting.footer.index') }}">
                    <i class="ti-more">
                    </i>
                    @lang('site.footer')
                </a>
            </li>
            {{--            @endcan --}}
            <li><a href="{{ route('cms.blogs.index') }}">
                    <i class="ti-more">
                    </i>
                    @lang('site.blogs')
                </a>
            </li>
            {{--            @endcan --}}

        </ul>
    </li>









@endcan
