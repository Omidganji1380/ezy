<template>
  <div class="appBottomMenu">
    <router-link :to="{name: 'ClientView_Index'}" active-class="active" class="item">
      <div class="col">
        <ion-icon name="home-outline"></ion-icon>
      </div>
    </router-link>
    <a href="#" class="item">
      <div class="col">
        <ion-icon name="cube-outline"></ion-icon>
      </div>
    </a>
    <router-link :to="{name: 'ClientView_PageBuilder'}" active-class="active" class="item">
      <div class="col ">
        <ion-icon name="add-circle-outline"></ion-icon>
      </div>
    </router-link>
    <a href="#" class="item">
      <div class="col">
        <ion-icon name="layers-outline"></ion-icon>
      </div>
    </a>
    <a href="#sidebarPanel" class="item" data-bs-toggle="offcanvas">
      <div class="col">
        <ion-icon name="menu-outline"></ion-icon>
      </div>
    </a>
  </div>
</template>

<script>
import {IonIcon} from "@ionic/vue";
import {logoIonic} from 'ionicons/icons';

export default {
  name      : "AppBottomMenu",
  components: {IonIcon, logoIonic}
}
</script>

<style scoped lang="scss">

</style>