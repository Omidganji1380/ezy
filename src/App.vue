<template>
<!--  <AppHeader/>-->
<!--  <AppBottomMenu/>-->

  <router-view/>
  <BaseJs/>
</template>

<script>
import BaseJs from '@/components/baseJs/BaseJs.vue'
import AppBottomMenu from '@/components/ClientIncludes/AppBottomMenu.vue'
import AppHeader from "@/components/ClientIncludes/AppHeader.vue";

export default {
  components: {
    BaseJs, AppBottomMenu, AppHeader
  },
}
</script>

<style lang="scss">
/*#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}*/
//#app{
//  input:focus-visible{
//    outline: none;
//  }
//}
</style>
