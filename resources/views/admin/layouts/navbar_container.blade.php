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


            @include('cms::admin.layouts.cms-nav-bar')
            {{-- @can('setting') --}}

            @include('admin.layouts.nav_bar_layouts.setting')
            {{-- @endcan --}}


            {{-- @can('cours') --}}
            @include('admin.layouts.nav_bar_layouts.cours')

            {{-- @endcan --}}
            @include('admin.layouts.nav_bar_layouts.accounting')
            {{-- @can('students') --}}

            @include('admin.layouts.nav_bar_layouts.students')
            {{-- @endcan --}}


            {{-- @can('reports') --}}
            @include('admin.layouts.nav_bar_layouts.service')
            {{-- @endcan --}}

            {{-- @can('reports') --}}

            @include('admin.layouts.nav_bar_layouts.reports')

            {{-- @endcan --}}





            {{-- @canany(['register_service_to_client', 'all_services_receipt']) --}}


            {{-- @can('services') --}}

            {{-- @endcan --}}
            {{-- @endcanany --}}
        </ul>

    </section>

    {{-- <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div> --}}
</aside>
