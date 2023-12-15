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
    'create fee
    type',
    'delete fee type',
    'edit supervisor',
    'delete supervisor',
    'add supervisor',
    'edit sponsor',
    'delete sponsor',
    'add sponsor',
    ])

    @php
        $class_setting = '';
        if (Str::contains($prefix, 'setting')) {
            $class_setting = 'active';
        }
        $class_supervisor_menu = '';
        if (Str::contains($prefix, 'supervisor')) {
            $class_supervisor_menu = 'active';
        }
    @endphp
    <li class="treeview {{ $class_setting }}">
        <a href="#">
            <i class="ti-settings"></i>
            <span>@lang('site.setting')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @canany(['edit supervisor', 'delete supervisor', 'add supervisor'])
                <li class="treeview   {{ $class_supervisor_menu }}     ">
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

            @canany(['create setting services', 'edit setting services', 'delete setting services'])
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
            @canany(['edit certificate', 'create certificate', 'delete certificate'])

                <li>
                    <a class="menu-item" href="{{ route('admin.certificate.all') }}"> <i
                            class="ti-more"></i>@lang('site.certificate')</a>
                </li>

            @endcan

            <li>
                <a class="menu-item" href="{{ route('admin.categories.all') }}"> <i
                        class="ti-more"></i>@lang('site.categories')</a>
            </li>

            @canany(['edit sponsor', 'delete sponsor', 'add sponsor'])
                <li><a href="{{ route('admin.sponsor.all') }}">
                        <i class="ti-more"></i>
                        @lang('site.sponsor')
                    </a>
                </li>
            @endcan
            @canany(['edit slider', 'delete slider', 'add slider'])
                <li><a href="{{ route('admin.slider.all') }}">
                        <i class="ti-more"></i>
                        @lang('site.slider')
                    </a>
                </li>
            @endcan

            @canany(['edit institue information', 'delete institue information', 'add institue information'])
                <li><a href="{{ route('admin.institue.all') }}">
                        <i class="ti-more"></i>
                        @lang('site.institue information')
                    </a>
                </li>
            @endcan

            @canany(['add school year', 'edit school year', 'delete school year'])
                <li><a href="{{ route('admin.schoolyear.all') }}">
                        <i class="ti-more"></i>
                        @lang('site.school year')
                    </a>
                </li>
            @endcan

            {{-- @canany(['fee type', 'edit fee type', 'create fee type', 'delete fee type']) --}}
            {{-- @if (Auth::user()->email == 'sadmin@gmail.com')
                <li><a href="{{ route('admin.setting.artisan','$index') }}">
                        <i class="ti-more"></i>
                        @lang('site.artisan')
                    </a>
                </li>
            @endif --}}
            {{-- @endcan --}}
        </ul>
    </li>
@endcan
