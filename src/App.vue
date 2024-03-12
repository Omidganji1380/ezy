<template>
  <!--  <AppHeader/>-->
  <!--  <AppBottomMenu/>-->

  <router-view :baseURL="baseURL"/>
  <BaseJs/>
</template>

<script>
import BaseJs from '@/components/baseJs/BaseJs.vue'
import AppBottomMenu from '@/components/ClientIncludes/AppBottomMenu.vue'
import AppHeader from "@/components/ClientIncludes/AppHeader.vue";
import axios from "axios";
// axios.create({
//                baseURL: '127.0.0.1:8000'
//              })

export default {
  components: {
    BaseJs, AppBottomMenu, AppHeader
  },
  data() {
    return {
      baseURL: 'http://127.0.0.1:8000/'
    }
  },
  beforeMount() {
    const token=localStorage.getItem('token');
    console.log(token)
    if (!token) {
        this.$router.push('/');
    } else {
        this.$router.push('/page-builder');
    }
  },
  // mounted() {
  //   axios.create({
  //                  baseURL: '127.0.0.1:8000'
  //                })
  // },
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
#app {
  max-width: 430px;
  margin: auto;
}
</style>
