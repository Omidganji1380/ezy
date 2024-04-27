<template>
  <Header :headerTitle="$t('HomeView.Header')"/>
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
      <router-link :to="{name:'ClientView_PageBuilder'}" class="col-6 rounded-[28px] px-0 bg-sec-color h-[163px]">
        <img src="/assets/img/darkMode/VisitCardHomeIcon.svg" class="w-full" alt="">
        {{ $t('HomeView.Boxes.CardVisit') }}
      </router-link>
      <router-link :to="{name:'ClientView_DigitalMenu'}" class="col-6 rounded-[28px] px-0 bg-sec-color h-[163px]">
        <img src="/assets/img/darkMode/DigitalMenuHomeIcon.svg" class="w-full" alt="">
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
  <Footer/>
</template>

<script>
import {useStorage} from "@vueuse/core/index";
import axios from "axios";
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import Footer from "@/components/Home/Includes/Footer.vue";
import Header from "@/components/Home/Includes/Header.vue";

export default {
  name      : "Home",
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Footer,
    Header
  },
  data() {
    return {
      sliders: []
    }
  },
  methods: {
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