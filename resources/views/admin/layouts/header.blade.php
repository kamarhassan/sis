<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu"
                        role="button">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                <ul>
                    {{-- @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach --}}



                </ul>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
                {{-- <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
                        <i class="ti-check-box"></i>
                    </a>
                </li> --}}
                {{-- <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="" class="waves-effect waves-light nav-link rounded svg-bt-icon"
                        title="current years {{ current_school_year() }}">
                        <i class="ti-calendar"></i>
                    </a>
                </li> --}}
            </ul>
        </div>



        {{-- <a id="chmode"
                onclick="changemodetheme('{{ route('admin.dashborad.changemode') }}', '{{ csrf_token() }}');"
                active><i class="wi wi-day-sunny"> </i></a> --}}


        <div class="nav">
            {{-- <li> <button id="chmode" class="btn"
                onclick="changemodetheme('{{ route('admin.dashborad.changemode') }}', '{{ csrf_token() }}');">
               @if (Config::get('modetheme.mode') == 'dark-skin')
               <i class="text-white wi wi-day-sunny active"></i>
               @else
               <i class="text-white   wi wi-moon-waning-crescent-4 active"></i>
               @endif

            </button>
           </li> --}}
            <li class="dropdown dropdown-language nav-item">
                <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-gb"></i>
                    <span class="selected-language"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                    <ul class="menu">
                        {{-- @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{$localeCode }}
                            </a>
                        </li>
                    @endforeach --}}
                        @php   $lang=get_active_Language() @endphp
                        @foreach ($lang as $localeCode => $properties)
                            {{-- {{ $properties ->code }} --}}
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($properties->code, null, [], true) }}">
                                    {{ $properties->code }}
                                </a>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </li>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- full Screen -->
                {{--
                <li class="search-bar">
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="s">
                    </div>
                </li> --}}
                <!-- Notifications -->


                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0"
                        data-toggle="dropdown" title="User">
                        <img src="{{ URL::asset('assets/images/avatar/1.jpg') }}" alt="">
                        {{-- {{Session::get('admin_name')}} --}}
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i>
                                Profile</a>
                            <a class="dropdown-item" href="#"><i class="ti-wallet text-muted mr-2"></i> My
                                Wallet</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i>
                                Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('get.admin.logout') }}"><i
                                    class="ti-lock text-muted mr-2"></i> Logout</a>
                        </li>
                    </ul>
                </li>

                @include('admin.layouts.admin-notification-bar')
                {{-- <li>
                    <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
                        <i class="ti-settings"></i>
                    </a>
                </li> --}}

            </ul>
        </div>
    </nav>
</header>
