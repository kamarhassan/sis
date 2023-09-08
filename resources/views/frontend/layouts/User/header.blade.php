<header class="main-header">
   <!-- Header Navbar -->
   <nav class="navbar navbar-static-top pl-30 navbar-user-dashborad">
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
               {{-- <li class="btn-group nav-item">
                   <a href="#" data-provide="fullscreen"
                       class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                       <i class="nav-link-icon mdi mdi-crop-free"></i>
                   </a>
               </li> --}}
               
           </ul>
       </div>



      


       <div class="nav">
            
      
           <li class="dropdown dropdown-language nav-item">
               
               <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                   <ul class="menu">
                  

                   </ul>
               </div>
           </li>
       </div>

       <div class="navbar-custom-menu r-side">
           <ul class="nav navbar-nav">
              
            
               <li class="dropdown user user-menu">
                   <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0"
                       data-toggle="dropdown" title="User">
                       <img src="{{ URL::asset(Auth::user()->photo)}}" alt="">
                       {{-- {{Session::get('admin_name')}} --}}
                    <span class="text-white">   {{ Auth::user()->name }} </span>
                   </a>
                   <ul class="dropdown-menu animated flipInX">
                       <li class="user-body">
                           <a class="dropdown-item" href="{{route('web.student.profile')}}"><i class="ti-user text-muted mr-2"></i>
                               Profile</a>
                           {{-- <a class="dropdown-item" href="#"><i class="ti-wallet text-muted mr-2"></i> My
                               Wallet</a>
                           <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i>
                               Settings</a> --}}
                           <div class="dropdown-divider"></div>
                           <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }} </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </li>
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
