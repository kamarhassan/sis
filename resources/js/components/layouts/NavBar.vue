<template>
  <div>
  


   <header id="header" class="fixed-top">
      <div
        class="navbar-container main-menu-content"
        data-menu="menu-container"
      >
        <ul
          class="nav navbar-nav"
          id="main-menu-navigation"
          data-menu="menu-navigation"
        >
          <li class="nav-item">
            <a class="nav-link" href="cours"><i class="la la-home"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=""
              ><i class="la la-book"></i>@lang('site.categories')</a
            >
          </li>
        </ul>
      </div>
</header>




  </div>
</template>

<script>
export default {
  mounted() {
    console.log("nav bar mounted");
  },
};
</script>
