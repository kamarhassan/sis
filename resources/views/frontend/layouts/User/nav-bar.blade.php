<aside class="main-sidebar" style="background-color: white">
    <!-- sidebar-->
    <section class="sidebar sidebar_user_dashboard" style="color: black">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('web.index') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="">
                        <h3><b>@lang('site.site name')</h3>
                    </div>
                </a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            <li>
                <a href="{{ route('admin.dashborad') }}">
                    <i data-feather="pie-chart"></i>
                    <span>@lang('site.Dashboard')</span>
                </a>
            </li>

            <li>
                <a href="{{ route('web.user.cours') }}">
                    <i class="ti-bookmark-alt"></i>
                    <span>@lang('site.my cours and classes')</span>
                </a>
            </li>
           
            <li>
                <a href="{{ route('web.user.cours.reserved') }}">
                    <i class="ti-bookmark-alt"></i>
                    <span>@lang('site.my cours reserved')</span>
                </a>
            </li>



        </ul>

    </section>


</aside>
