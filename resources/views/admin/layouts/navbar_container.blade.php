@php
$prefix = Request::route()->getprefix();
$routes = Route::current()->getName();
// dd($prefix);
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashborad') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="">
                        <h3><b>@lang('site.site name')</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li>
                <a href="{{ route('admin.dashborad') }}">
                    <i data-feather="pie-chart"></i>
                    <span>@lang('site.Dashboard')</span>
                </a>
            </li>



            <li class="treeview  {{ $prefix == getprefix('language') ? 'active' : '' }}    ">
                <a href="#">
                    {{-- <i data-feather="message-circle"></i> --}}
                    <span> @lang('site.website language') </span>
                    {{-- <span class="badge-danger badge-pill  mr-2">{{ App\Models\Language::count() }}</span> --}}
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.language') }}"><i class="ti-more">
                                @lang('site.show all')</i></a></li>
                    {{-- <li><a href="{{ route('admin.language.create') }}"><i class="ti-more">اضافة لغات</i></a></li> --}}
                </ul>
            </li>



            <li class="treeview">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Application</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    {{-- @can('edit articles') --}}
                    <li><a href=""><i class="ti-more"></i>Add user</a></li>
                    {{-- @endcan --}}

                    <li><a href="calendar.html"><i class="ti-more"></i></a></li>
                </ul>
            </li>


            <li class="treeview   {{ $prefix == getprefix('grade') ? 'active' : '' }}     ">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>supervaisor</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    {{-- @can('super admin') --}}


                    <li><a href=""><i class="ti-more"></i></a></li>
                    {{-- @endcan --}}
                </ul>
            </li>



            <li class="treeview   {{ $prefix == getprefix('Setting') ? 'active' : '' }}     ">
                <a href="#">
                    <i class="ti-settings"></i>
                    <span>@lang('site.setting')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('create_edit grades')
                        <li><a href="{{ route('admin.grades.add') }}">
                                <i class="ti-more">@lang('site.add new grade')</i></a></li>
                    @endcan

                    @can('create_edit levels')
                        <li><a href="{{ route('admin.level.add') }}">
                                <i class="ti-more">@lang('site.add new level')</i></a></li>
                    @endcan

                    @can('activate currency')
                        <li><a href="{{ route('admin.Currency.get') }}">
                                <i class="ti-more">@lang('site.add new Currency')</i></a></li>
                    @endcan
                </ul>
            </li>



            <li class="treeview   {{ $prefix == getprefix('Cours') ? 'active' : '' }}     ">
                <a href="#">
                    <i class="ti-settings"></i>
                    <span>@lang('site.cours')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    {{-- @can('create_edit grades') --}}
                        <li><a href="{{ route('admin.cours.add') }}">
                                <i class="ti-more">@lang('site.add new cours')</i></a></li>
                    {{-- @endcan --}}


                </ul>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
