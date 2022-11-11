@canany([
    'edit language',
    'edit grades',
    'create grades',
    'delete grades',
    'levels',
    'edit levels',
    'create levels',
    'delete levels',
    'activate_currency',
    'setting services',
    'create setting services',
    'edit setting services',
    'delete
    setting services',
    'roles',
    'create roles',
    'edit roles',
    'delete roles',
    'fee type',
    'edit fee type',
    'create fee type',
    'delete fee type',
    'edit supervisor',
    'delete supervisor',
    'add supervisor',
    ])


    <li class="treeview {{ $prefix == getprefix('setting') ? 'active' : '' }}">
        <a href="#">
            <i class="ti-settings"></i>
            <span>@lang('site.setting')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @canany(['edit supervisor', 'delete supervisor', 'add supervisor'])
                <li class="treeview   {{ $prefix == getprefix('supervisor') ? 'active' : '' }}     ">
                    <a href="#">
                        <i class="si si-people"></i>
                        <span>@lang('site.supervisor')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @canany(['edit supervisor', 'delete supervisor'])
                            <li><a href="{{ route('admin.supervisor.all') }}">
                                    <i class="ti-more">
                                    </i>
                                    @lang('site.all supervisor')
                                </a>
                            </li>
                        @endcan
                        @can('add supervisor')
                            <li><a href="{{ route('admin.supervisor.add') }}">
                                    <i class="ti-more">
                                    </i>
                                    @lang('site.supervisor add')
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('edit language')
                <li><a href="{{ route('admin.language') }}">
                        <i class="ti-more">
                        </i>
                        @lang('site.website language')
                    </a>
                </li>
            @endcan
            @canany(['edit grades', 'create grades', 'delete grades'])
                <li><a href="{{ route('admin.grades.add') }}">
                        <i class="ti-more"></i>@lang('site.add new grade')</a></li>
            @endcan

            @canany(['edit levels', 'create levels', 'delete levels'])
                <li><a href="{{ route('admin.level.add') }}">
                        <i class="ti-more"></i>@lang('site.add new level')</a></li>
            @endcan

            @can('activate_currency')
                <li><a href="{{ route('admin.Currency.get') }}">
                        <i class="ti-more"></i>@lang('site.add new Currency')</a></li>
            @endcan

            @canany([ 'create setting services', 'edit setting services', 'delete setting services'])
                <li><a href="{{ route('admin.Services.add') }}">
                        <i class="ti-more"></i>
                        @lang('site.add and edit services')
                    </a>
                </li>
            @endcan
            @canany(['create roles', 'edit roles', 'delete roles'])
                <li><a href="{{ route('admin.setting.role') }}">
                        <i class="ti-more"></i>
                        @lang('site.role and permission')
                    </a>
                </li>
            @endcan

            @canany(['fee type', 'edit fee type', 'create fee type', 'delete fee type'])
                <li><a href="{{ route('admin.setting.fee') }}">
                        <i class="ti-more"></i>
                        @lang('site.fees')
                    </a>
                </li>
            @endcan
            {{-- @canany(['fee type', 'edit fee type', 'create fee type', 'delete fee type']) --}}
            @if (Auth::user()->email =="sadmin@gmail.com") 
                 
                <li><a href="{{ route('admin.setting.artisan') }}">
                            <i class="ti-more"></i>
                            @lang('site.artisan')
                        </a>
                    </li>
                
            @endif
            {{-- @endcan --}}
        </ul>
    </li>
@endcan
