<template>
  <div id="loader">
    <div class="spinner-border text-primary" role="status"></div>
  </div>

  <!-- App Header -->
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
  <!-- * App Header -->

  <!-- Search Component -->
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
  <!-- * Search Component -->

  <!-- App Bottom Menu -->
  <AppBottomMenu/>
  <!-- * App Bottom Menu -->

  <!-- App Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarPanel">
    <div class="offcanvas-body">
      <!-- profile box -->
      <div class="profileBox">
        <div class="image-wrapper">
          <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged rounded">
        </div>
        <div class="in">
          <strong>Julian Gruber</strong>
          <div class="text-muted">
            <ion-icon name="location"></ion-icon>
            California
          </div>
        </div>
        <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
          <ion-icon name="close"></ion-icon>
        </a>
      </div>
      <!-- * profile box -->

      <ul class="listview flush transparent no-line image-listview mt-2">
        <li>
          <a href="index.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="home-outline"></ion-icon>
            </div>
            <div class="in">
              Discover
            </div>
          </a>
        </li>
        <li>
          <a href="app-components.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="cube-outline"></ion-icon>
            </div>
            <div class="in">
              Components
            </div>
          </a>
        </li>
        <li>
          <a href="app-pages.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="layers-outline"></ion-icon>
            </div>
            <div class="in">
              <div>Pages</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
            </div>
            <div class="in">
              <div>Chat</div>
              <span class="badge badge-danger">5</span>
            </div>
          </a>
        </li>
        <li>
          <div class="item">
            <div class="icon-box bg-primary">
              <ion-icon name="moon-outline"></ion-icon>
            </div>
            <div class="in">
              <div>Dark Mode</div>
              <div class="form-check form-switch">
                <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodesidebar">
                <label class="form-check-label" for="darkmodesidebar"></label>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <div class="listview-title mt-2 mb-1">
        <span>Friends</span>
      </div>
      <ul class="listview image-listview flush transparent no-line">
        <li>
          <a href="page-chat.html" class="item">
            <img src="assets/img/sample/avatar/avatar7.jpg" alt="image" class="image">
            <div class="in">
              <div>Sophie Asveld</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="image">
            <div class="in">
              <div>Sebastian Bennett</div>
              <span class="badge badge-danger">6</span>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="assets/img/sample/avatar/avatar10.jpg" alt="image" class="image">
            <div class="in">
              <div>Beth Murphy</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="assets/img/sample/avatar/avatar2.jpg" alt="image" class="image">
            <div class="in">
              <div>Amelia Cabal</div>
            </div>
          </a>
        </li>
        <li>
          <a href="page-chat.html" class="item">
            <img src="assets/img/sample/avatar/avatar5.jpg" alt="image" class="image">
            <div class="in">
              <div>Henry Doe</div>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <!-- sidebar buttons -->
    <div class="sidebar-buttons">
      <a href="#" class="button">
        <ion-icon name="person-outline"></ion-icon>
      </a>
      <a href="#" class="button">
        <ion-icon name="archive-outline"></ion-icon>
      </a>
      <a href="#" class="button">
        <ion-icon name="settings-outline"></ion-icon>
      </a>
      <a href="#" class="button">
        <ion-icon name="log-out-outline"></ion-icon>
      </a>
    </div>
    <!-- * sidebar buttons -->
  </div>
  <!-- * App Sidebar -->

  <!-- welcome notification  -->
  <div id="notification-welcome" class="notification-box">
    <div class="notification-dialog android-style">
      <div class="notification-header">
        <div class="in">
          <img src="assets/img/icon/72x72.png" alt="image" class="imaged w24">
          <strong>Mobilekit</strong>
          <span>just now</span>
        </div>
        <a href="#" class="close-button">
          <ion-icon name="close"></ion-icon>
        </a>
      </div>
      <div class="notification-content">
        <div class="in">
          <h3 class="subtitle">Welcome to Mobilekit</h3>
          <div class="text">
            Mobilekit is a PWA ready Mobile UI Kit Template.
            Great way to start your mobile websites and pwa projects.
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- * welcome notification -->
  <router-view/>
  <BaseJs/>
</template>

<script>
import BaseJs from '@/components/baseJs/BaseJs.vue'
import AppBottomMenu from '@/components/ClientIncludes/AppBottomMenu.vue'
// import '../public/assets/js/base'
export default {
  components: {
    BaseJs,AppBottomMenu
  },
}
</script>

<style lang="scss">
/*#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}*/
</style>
