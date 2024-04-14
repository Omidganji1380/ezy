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
            {{ $t('HomeView.Header') }}
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
  <div class="slider bg-sec-color rounded-b-[8px]">
    <div class="slider-box w-full px-[18px] py-[43px]">
      <Carousel :items-to-show="1.2" :wrap-around="true">
        <Slide v-for="slider in sliders" :key="slider">
          <div class="carousel__item mx-1">
            <img :src="slider" alt="" class="max-w-full ">
          </div>
        </Slide>
        <template #addons>
          <Navigation/>
          <Pagination/>
        </template>
      </Carousel>
    </div>
  </div>
  <div class="mainContent px-[24px] mb-[95px]">
    <p class="my-[15px] text-[14px]" :dir="$i18n.locale==='fa'?'rtl':''">
      {{ $t('HomeView.FirstTitle.one') }}
      <span class="text-pri-color">
      {{ $t('HomeView.FirstTitle.two') }}
    </span>
    </p>
    <div class="row mx-auto gap-3 justify-between">
      <router-link :to="{name:'ClientView_PageBuilder'}" class="col-6 rounded-[12px] bg-sec-color h-[94px]">
        {{ $t('HomeView.Boxes.CardVisit') }}
      </router-link>
      <router-link :to="{name:'ClientView_DigitalMenu'}" class="col-6 rounded-[12px] bg-sec-color h-[94px]">
        {{ $t('HomeView.Boxes.CafeManu') }}
      </router-link>
      <div class="col-6 rounded-[12px] bg-sec-color h-[94px]">
        {{ $t('HomeView.Boxes.ComingSoon') }}
      </div>
      <div class="col-6 rounded-[12px] bg-sec-color h-[94px]">
        {{ $t('HomeView.Boxes.ComingSoon') }}
      </div>
    </div>
  </div>
  <div
      class="foooter overflow-hidden content-center rounded-t-[30px] bg-sec-color fixed-bottom mx-auto max-w-p h-[80px]">
    <div class="row justify-between p-0 m-0 flex-nowrap">
      <div class="col-auto mx-4">
        <img src="/assets/img/darkMode/bottonMenu-Wallet.svg" alt="">
      </div>
      <div class="col-auto">
        <img src="/assets/img/darkMode/bottonMenu-Home.svg" alt="">
      </div>
      <div class="col-auto mx-4">
        <img src="/assets/img/darkMode/bottonMenu-Wallet.svg" alt="">
      </div>
    </div>
  </div>
</template>

<script>
import {useStorage} from "@vueuse/core/index";
import axios from "axios";
import {defineComponent} from 'vue'
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

export default {
  name      : "Home",
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data() {
    return {
      sliders: []
    }
  },
  methods: {
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
    getSlides() {
      axios({
              url   : 'v1/home/getSliders',
              method: 'get',
            })
          .then(res => {
            this.sliders = res.data
          })
          .catch(err => console.log(err))
    },
  },
  mounted() {
    this.getSlides()
  },
}
</script>

<style scoped>
.col-6 {
  flex: 0 0 calc(50% - 0.5rem);
  max-width: calc(50% - 0.5rem);
  text-align: center;
  align-content: end;
  font-size: 14px;
  padding-bottom: 8px;
}
</style>