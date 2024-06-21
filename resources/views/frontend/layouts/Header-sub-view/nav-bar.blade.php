<nav class="primary-menu mobile-menu-off-canvas flex-xl-fill me-auto">
   <ul class="menu-container">
   
      {{-- <li class="menu-item">
         <a class="menu-link" href="{{ route('web.index') }}">
            <div><strong>Home</strong> </div>
         </a>
      </li>   <li class="menu-item">
         <a class="menu-link" href="{{ route('cms.web.blog.index') }}">
            <div><strong>news</strong> </div>
         </a>
      </li> --}}
      <li class="menu-item">

         @include('cms::frontend.layouts.render-menu')
      </li>
   </ul>


  


</nav>
