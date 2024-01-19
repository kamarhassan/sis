<header id="header" class="transparent-header">
   <div id="header-wrap">
       <div class="container">
           <div class="header-row">


          
               <div id="logo" class="me-lg-5">
                   <a href="{{ route('web.index') }}">
                        
                        <img class="logo-default" srcset="{{URL::asset('public/files/logo.jpg')}}" src="{{URL::asset('public/files/logo.jpg')}}"
                           title="advanced computer technology center" alt="advanced computer technology center" style="border-radius: 50%;">
                      {{-- <img class="logo-dark" srcset="images/logo-dark.png, images/logo-dark@2x.png 2x"
                           src="images/logo-dark@2x.png" alt="Canvas Logo"> --}}
                   </a>
               </div><!-- #logo end -->

           
                <div id="logo" class="me-lg-5">
                    <a href="{{ route('web.index') }}">
                         
                         <img class="logo-default" srcset="{{URL::asset('public/files/logo.jfif')}}" src="{{URL::asset('public/files/logo.jfif')}}"
                            title="advanced computer technology center" alt="advanced computer technology center" style="border-radius: 50%;">
                       {{-- <img class="logo-dark" srcset="images/logo-dark.png, images/logo-dark@2x.png 2x"
                            src="images/logo-dark@2x.png" alt="Canvas Logo"> --}}
                    </a>
                </div><!-- #logo end -->


               <div class="header-misc ms-auto ms-xl-0">
                   <div class="header-buttons me-3">
                       @guest

                           <a class="button button-rounded button-border button-small m-0"
                               href="{{ route('login') }}">{{ __('Login') }}</a>


                           @if (Route::has('register'))
                               <a class="button button-rounded button-border button-small m-0"
                                   href="{{ route('register') }}">{{ __('Register') }}</a>
                           @endif
                       @else
                           <li class="nav-item dropdown" style="list-style: none;">
                               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   {{ Auth::user()->name }}
                               </a>
                               <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="{{ route('web.user.dashboard') }}">@lang('site.Dashboard')</a>
                                   <a class="dropdown-item" href="{{ route('web.student.profile') }}">@lang('site.personal information')</a>
                                   <div class="dropdown-divider"></div>
                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }} </a>
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                       @csrf
                                   </form>
                               </div>
                           </li>
                       @endguest

                            @if (Route::has('register'))
                                <a class="button button-rounded button-border button-small m-0"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="list-style: none;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('web.user.dashboard') }}">@lang('site.Dashboard')</a>
                                    <a class="dropdown-item" href="{{ route('web.student.profile') }}">@lang('site.personal information')</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest



                   </div>


             
                   {{-- @include('frontend.layouts.Header-sub-view.top-search') --}}

                
                   {{-- @include('frontend.layouts.Header-sub-view.top-cart') --}}
               </div>

               <div class="primary-menu-trigger">
                   <button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
                       <span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
                   </button>

               </div>

             
               @include('frontend.layouts.Header-sub-view.nav-bar')


           </div>
       </div>
   </div>
{{--    <div class="header-wrap-clone"></div>--}}
  {{-- {{dd  ( Modules\Cms\Entities\HeaderMenu::menu(null))}} --}}
</header><!-- #header end -->
