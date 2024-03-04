<template>
  <div class="appHeader bg-primary scrolled">
    <div class="left">
      <a href="#" class="headerButton" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanel">
        <ion-icon name="menu-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">
      Discover
    </div>
    <div class="right">
      <a href="#" class="headerButton toggle-searchbox">
        <ion-icon name="search-outline"></ion-icon>
      </a>
    </div>
  </div>
  <div id="search" class="appHeader">
    <form class="search-form">
      <div class="form-group searchbox">
        <input type="text" class="form-control" placeholder="Search...">
        <i class="input-icon">
          <ion-icon name="search-outline"></ion-icon>
        </i>
        <a href="#" class="ms-1 close toggle-searchbox">
          <ion-icon name="close-circle"></ion-icon>
        </a>
      </div>
    </form>
  </div>
  <AppSidebar/>
</template>

<script>
import AppSidebar from "@/components/ClientIncludes/AppSidebar.vue";

export default {
  name: "AppHeader",
  components:{AppSidebar}
}
</script>

<style scoped lang="scss">

</style>