<template>
  <div class="header bg-sec-color h-[54px] content-center" dir="rtl">
    <div class="row relative mx-auto justify-between flex-nowrap">
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto px-[32px] self-center">
            <img src="/assets/img/darkMode/sidebarHambergery.svg" alt="">
          </span>
        </div>
      </div>
      <span class="col-auto p-0 text-[20px] absolute left-1/2 -top-[3px] translate-middle-x">
        {{headerTitle}}
      </span>
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto -mx-[18px] mr-auto">
            <img src="/assets/img/Login-SmsForm/darkMode.svg"
                 alt="">
          </span>
          <span class="col-auto px-[32px]">
            <img src="/assets/img/Login-SmsForm/en-to-fa.svg" v-if="$i18n.locale==='en'"
                 @click.prevent="enToFa"
                 alt="">
            <img src="/assets/img/Login-SmsForm/fa-to-en.svg" v-if="$i18n.locale==='fa'"
                 @click.prevent="faToEn"
                 alt="">
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useStorage} from "@vueuse/core/index";

export default {
  name: "Header",
  props: ['headerTitle','shadow3d'],
  data() {
    return {
      sideMenu   : false,
    }
  },
  emits  : ['showMenu'],
  methods: {
    showMenu() {
      this.sideMenu = !this.sideMenu
      this.$emit('showMenu', this.sideMenu)
    },
    enToFa() {
      localStorage.removeItem('lang')
      this.$i18n.locale = 'fa';
      useStorage('lang', this.$i18n.locale)

    },
    faToEn() {
      localStorage.removeItem('lang')
      this.$i18n.locale = 'en';
      useStorage('lang', this.$i18n.locale)

    },
  },
}
</script>

<style scoped lang="scss">

</style>