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
import {useStorage} from '@vueuse/core';
import axios from "axios";
// axios.create({
//                baseURL: '127.0.0.1:8000'
//              })

export default {
  components: {
    BaseJs, AppBottomMenu, AppHeader
  },
  methods   : {
    checkToken() {
      const token = localStorage.getItem('token');
      // console.log(token)
      if (!token && this.$route.name === 'ClientView_PageBuilder') {
        this.$router.push({name: 'ClientView_Index'});
      }
      if (token && this.$route.name === 'ClientView_Index') {
        this.$router.push({name: 'ClientView_PageBuilder'});
      }
    },
    checkLang() {
      // localStorage.removeItem('lang')
      useStorage('lang', 'en')
      var lang = useStorage('lang').value

      // console.log(lang)
      if (lang === 'en') {
        useStorage('lang', 'en')
      } else {
        useStorage('lang', 'fa')
      }
    }
  },
  beforeMount() {
    setTimeout(() => {
      this.checkToken()
    }, 10)
    localStorage.setItem("MobilekitDarkMode", "0")
  },
  mounted() {
    this.checkLang()
    document.addEventListener('contextmenu', event => event.preventDefault());
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

:root {
  --pri-color: #009606;
  --sec-color: #F0FCF3;
  --platform-width: 430px;
  --platform-width-1: 429px;
}
#app {
  max-width: 430px;
  margin: auto;
  overflow-x: hidden;
  height: 100vh;
}

a:hover {
  color: var(--pri-color);
  cursor: pointer;
}

body {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  overflow-y: hidden;
  //overscroll-behavior: contain !important;
}
</style>
