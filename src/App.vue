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
      if (!token && this.$route.name === 'ClientView_Dashboard') {
        this.$router.push({name: 'ClientView_Index'});
      }
      if (token && this.$route.name === 'ClientView_Index') {
        this.$router.push({name: 'ClientView_Dashboard'});
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
      this.$i18n.locale = lang
    },
    adjustElementScale() {
      const element     = document.querySelector('#app');
      const windowWidth = window.innerWidth;

      // محاسبه مقدار scale بر اساس اندازه صفحه
      var scaleValue = 0;
      if (windowWidth > 400) {
        scaleValue = 0.9
      } else if (windowWidth > 300) {
        scaleValue = 0.8
      } else {
        scaleValue = 1
      }
      // scaleValue = windowWidth < 400 ? 0.5 : 1; // مثالی از مقدار scale

      // تنظیم scale جدید بر اساس محاسبات
      element.style.transform = `scale(${scaleValue})`;
    }

  },
  beforeMount() {
    setTimeout(() => {
      this.checkToken()
    }, 10)
    localStorage.setItem("MobilekitDarkMode", "0")
  },
  mounted() {

    // this.adjustElementScale()
    // window.addEventListener('resize', this.adjustElementScale);
    this.checkLang()
    document.addEventListener('contextmenu', event => event.preventDefault());
  },
}
</script>


<style>

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
  background-color: #1A1A1A;
//overscroll-behavior: contain !important;
}
span,h1,h2,h3,p,a,div{
  color: var(--d8-color);
}
</style>
