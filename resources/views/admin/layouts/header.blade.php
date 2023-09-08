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
                </ul>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
            </ul>
        </div>


        <a id="chmode" href="#"
            onclick="changemodetheme('{{ route('admin.dashborad.changemode') }}', '{{ csrf_token() }}');" active>
            <i id="icon_theme"
                @if (Session::get('mode') == 'dark-skin') class="wi wi-day-sunny"
            @else class="wi wi-moon-1" @endif>
            </i></a>

        @php
            $years = App\Models\Years::orderBy('year', 'desc')->get();
        @endphp
       
        <div class="nav">
            <form id="changeyear">
                @csrf
                <label for="year">@lang('site.school year') </label>
                <select class="form-control select2" id="year" name="year"
                    onchange="changeyear('{{ route('admin.change.years') }}','changeyear');">

                    @foreach ($years as $year)
                        <option value="{{ $year->id }}" @if (current_school_year()['year'] == $year->year) selected @endif>
                            {{ $year->year }}</option>
                    @endforeach

                </select>
            </form>
            @if (last_school_year()['year'] != current_school_year()['year'])
            <span class="text-danger">@lang('site.is not last year')</span>
            @endif

        </div>


        <div class="nav">
            <li class="dropdown dropdown-language nav-item">
                <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-gb"></i>
                    <span class="selected-language"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                    <ul class="menu">
                        @php   $lang=get_active_Language() @endphp
                        @foreach ($lang as $localeCode => $properties)
                            <li style="list-style-type: none;">
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
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0"
                        data-toggle="dropdown" title="User">
                        <img src="{{ URL::asset(Auth::user()->photo) }}" alt="">
                        <span class="text-white"> {{ Auth::user()->name }} </span>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                    class="ti-user text-muted mr-2"></i>
                                Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('get.admin.logout') }}"><i
                                    class="ti-lock text-muted mr-2"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                @include('admin.layouts.admin-notification-bar')
            </ul>
        </div>
    </nav>
</header>
