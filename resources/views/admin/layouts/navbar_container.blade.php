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



            <li class="treeview   {{ $prefix == getprefix('language') ? 'active' : '' }}">
                <a href="#">
                    <i class="ti-settings"></i>
                    <span>@lang('site.website language')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    {{-- @can('create_edit grades') --}}

                    {{-- @endcan --}}
                    {{-- @can('create_edit grades') --}}
                    <li><a href="{{ route('admin.language') }}">
                            <i class="ti-more">
                            </i>
                            @lang('site.show all')
                        </a>
                    </li>
                    {{-- @endcan --}}


                </ul>
            </li>



       <!--     <li class="treeview">
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
 -->


          @can ('setting')
              <li class="treeview   {{ $prefix == getprefix('setting') ? 'active' : '' }}     ">
                  <a href="#">
                      <i class="ti-settings"></i>
                      <span>@lang('site.setting')</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      @can('create_edit_grades')
                          <li><a href="{{ route('admin.grades.add') }}">
                                  <i class="ti-more"></i>@lang('site.add new grade')</a></li>
                      @endcan

                      @can('create_edit_levels')
                          <li><a href="{{ route('admin.level.add') }}">
                                  <i class="ti-more"></i>@lang('site.add new level')</a></li>
                      @endcan

                      @can('activate_currency')
                          <li><a href="{{ route('admin.Currency.get') }}">
                                  <i class="ti-more"></i>@lang('site.add new Currency')</a></li>
                      @endcan

                      @can('create_edit_services')
                      <li><a href="{{ route('admin.Services.add') }}">
                              <i class="ti-more"></i>
                              @lang('site.add and edit services')
                          </a>
                      </li>
                      @endcan
                     @can('create_edit_roles')
                      <li><a href="{{ route('admin.setting.role') }}">
                              <i class="ti-more"></i>
                              @lang('site.role and permission')
                          </a>
                      </li>
                   @endcan
                  </ul>
              </li>

          @endcan


           @can ('cours')
             <li class="treeview   {{ $prefix == getprefix('Cours') ? 'active' : '' }}     ">
                 <a href="#">
                     <i class="fa fa-book "></i>
                     <span>@lang('site.cours')</span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-right pull-right"></i>
                     </span>
                 </a>

                 <ul class="treeview-menu">
                     @can('show_all_cours')
                     <li><a href="{{ route('admin.cours.all') }}">
                             <i class="ti-more">
                             </i>
                             @lang('site.all cours')
                         </a>
                     </li>
                     @endcan
                     @can('add_cours')
                     <li><a href="{{ route('admin.cours.add') }}">
                             <i class="ti-more">
                             </i>
                             @lang('site.add new cours')
                         </a>
                     </li>
                     @endcan


                 </ul>
             </li>

           @endcan

          @can ('students')
              <li class="treeview   {{ $prefix == getprefix('Students') ? 'active' : '' }}     ">
                  <a href="#">
                      <i class="fa fa-user-circle"></i>
                      <span>@lang('site.students')</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                      </span>
                  </a>

                  <ul class="treeview-menu">
                      @can('show all students')
                      <li><a href="{{ route('admin.students.all') }}">
                              <i class="ti-more">
                              </i>
                              @lang('site.all students')
                          </a>
                      </li>
                      @endcan
                       @can('register_students')
                      <li><a href="{{ route('admin.students.Registration-1') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                              <i class="ti-more">
                              </i>
                              @lang('site.register Student in Course')
                          </a>
                      </li>
                      @endcan
                      @can('payment_students')
                      <li><a href="{{ route('admin.students.get_std_to_payment') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                              <i class="ti-more">
                              </i>
                              @lang('site.register Student pay fee')
                          </a>
                      </li>
                      @endcan
                      @can('receipt')
                      <li><a href="{{ route('admin.all-receipt') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                              <i class="ti-more">
                              </i>
                              @lang('site.edit receipt and payment')
                          </a>
                      </li>
                      @endcan


                  </ul>
              </li>

          @endcan

          @can ('reports')
              <li class="treeview   {{ $prefix == getprefix('reports') ? 'active' : '' }}     ">
                  <a href="#">
                      <i class="fa fa-user-circle"></i>
                      <span>@lang('site.report')</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                      </span>
                  </a>

                  <ul class="treeview-menu">
                      @can('view report')
                      <li><a href="{{ route('admin.report') }}">
                              <i class="ti-more">
                              </i>
                              @lang('site.report')
                          </a>
                      </li>
                      @endcan

                  </ul>
              </li>
          @endcan
@can ('services')
            <li class="treeview   {{ $prefix == getprefix('services') ? 'active' : '' }}     ">
                <a href="#">
                    <i class="fa fa-user-circle"></i>
                    <span>@lang('site.services')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('register service to client')
                    <li><a href="{{ route('admin.Services.to.client') }}">
                            <i class="ti-more"></i>
                            @lang('site.services')
                        </a>
                    </li> @endcan
@can('all services receipt')
                    <li><a href="{{ route('admin.Services.all-receipt') }}" {{-- onclick='open_link("{{route("admin.students.register")}}");' --}}>
                        <i class="ti-more">
                        </i>
                        @lang('site.edit receipt and payment')
                    </a>
                </li>@endcan
                </ul>
            </li>
 @endcan

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
