<template>
  <div :class="{'px-2':step===0}"
       class="fixed bg-body top-0 bottom-0 bg-opacity-10 translate-middle-x w-[100vw] left-1/2 z-[2000] backdrop-blur-sm">
    <div :class="{'d-none':step!==0}"
         class="bg-back mx-auto px-[24px] max-w-p fixed-bottom rounded-t-[16px] z-[2001]">
        <span class="absolute top-[16.5px] right-[25.5px]" @click.prevent="toggleCreateModal">
          <img src="/assets/img/PageBuilder/modal-Close-Square.svg" alt="">
        </span>
      <h3 dir="rtl" class="text-center pt-[17.5px] text-d8 text-[20px]">لینک خود را وارد کنید</h3>
      <div class="row flex-nowrap justify-center mt-[40px] mx-auto">
        <input
            :class="{'border-danger':!nextButton}"
            type="text"
            @keydown.enter.prevent="nextButton?step++:''"
            @keyup.prevent="checkReservedLinks"
            placeholder="ID"
            v-model="usernameInput"
            class="lowercase col-auto text-left border-solid border-b-2 border-pri-color w-full h-[44px] shadow-3d focus-visible:outline-0 leading-10 rounded-[16px] bg-sec-color text-d8">
      </div>
      <div
          :class="{'text-danger':!nextButton}"
          class="mx-auto w-full text-d8 text-[12.9px] mt-[7.5px]">
        {{ ezyLink }}{{ usernameInput }}
        <span class="float-right" dir="rtl" v-if="!usernameInput">به طور مثال cafe.ezy</span>
        <p :class="{'opacity-0':nextButton}" class="text-center text-d8 pt-1">
          این لینک
          <span class="text-danger">
            تکراری
          </span>
          است</p>

      </div>
      <div class="continueButton mt-2 mb-[50px]">
        <button :dir="$i18n.locale==='fa'?'rtl':''"
                :disabled="!nextButton || !usernameInput"
                @click.prevent="step++"
                class="row justify-center bg-pri-color h-[55px] text-[20px] mx-auto w-full rounded-[16px]">
          <span class="self-center text-sec-color">
          ادامه
          </span>
        </button>
      </div>
    </div>

    <div :class="{'d-none':step!==1}"
         class="z-[99999999999] px-[24px] max-w-p bg-back text-center rounded-t-[16px] fixed-bottom mx-auto">
        <span class="absolute top-[16.5px] right-[25.5px]" @click.prevent="toggleCreateModal">
          <img src="/assets/img/PageBuilder/modal-Close-Square.svg" alt="">
        </span>
      <h3 dir="rtl" class="text-center pt-[17.5px] text-d8 text-[20px]">قالب منو</h3>
      <div class="slider-box w-full py-[43px]">
        <Carousel :items-to-show="1">
          <Slide v-for="slider in sliders" :key="slider">
            <div class="carousel__item relative overflow-hidden">
              <img :src="slider" alt="" class="max-w-full">
              <div
                  class="absolute bottom-0 py-[10px] mx-auto w-full bg-gradient-to-b from-[#fff] to-[#999]">
                <span class="text-[#313131]">
                قالب استارباکس
                  </span>
              </div>
            </div>
          </Slide>
          <template #addons>
            <Navigation/>
            <!--            <Pagination/>-->
          </template>
        </Carousel>
      </div>
      <div class="mb-[50px]">
        <button @click.prevent="submitNewMenu"
                class="row justify-center bg-pri-color h-[55px] text-[20px] mx-auto w-full rounded-[16px]">
          <span class="self-center text-sec-color">
          ادامه
          </span>
        </button>
      </div>
    </div>
  </div>

</template>

<script>
import Header from "@/components/pageBuilder/Includes/Header.vue";
import axios from "axios";
import {useStorage} from "@vueuse/core";
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import {useStore} from "vuex";

export default {
  name      : "newMenu",
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
    Header,
  },
  data() {
    return {
      sliders         : [],
      usernameInput   : null,
      step            : 0,
      allReservedLinks: [],
      nextButton      : true,
      ezyLink         : '',
      user_id         : useStore().state.user_id,
    }
  },
  mounted() {
    this.ezyLink = axios.defaults.baseURL;
    this.ezyLink = this.ezyLink.replace(/(^\w+:|^)\/\//, '');
    this.ezyLink = this.ezyLink.replace('api/', '')

    axios({
            method: 'post',
            url   : 'v1/dashboard/getAllReservedLinks',
          })
        .then(res => {
          this.allReservedLinks = res.data
        })
        .catch(err => {
          console.log(err)
        })
    axios({
            url   : 'v1/home/getSliders',
            method: 'get',
          })
        .then(res => {
          this.sliders = res.data
        })
        .catch(err => console.log(err))
  },
  methods: {
    submitNewMenu() {
      if (this.usernameInput) {
        axios({
                method : 'POST',
                url    : 'v1/digitalMenu/submitNewMenu',
                data   : {
                  'user_id': this.user_id,
                  'link'   : this.usernameInput,
                },
                headers: {
                  'Content-Type': 'multipart/form-data',
                }
              })
            .then(res => {
              if (res.status === 201) {
                this.$router.push({name:'ClientView_DigitalMenu_Edit',params:{id:res.data.id}})
              }
            })
            .catch(err => {
              console.log(err)
            })
      }
    },
    searchStringInArray(input, array) {
      for (let i = 0; i <= Object.keys(array).length; i++) {
        if (array[i] === input) {
          navigator.vibrate([400])
          return input;
        }
      }
    },
    checkReservedLinks() {
      this.usernameInput = this.usernameInput.toLowerCase()
      const regex        = /^[a-z0-9.\-_+]+$/i;
      if (!regex.test(this.usernameInput)) {
        this.usernameInput = this.usernameInput.replace(/[^a-z0-9.\-_+]/g, '');
      }
      var linkExists  = this.searchStringInArray(this.usernameInput, this.allReservedLinks)
      this.nextButton = !(linkExists || this.usernameInput.length < 3);
      if (!this.usernameInput.length) {
        this.nextButton = true
      }
    },
    setCoverImg(e) {
      this.coverImage        = e.target.files[0]
      this.coverImagePreview = URL.createObjectURL(e.target.files[0])
    },
    setProfileImg(e) {
      this.profileImage        = e.target.files[0]
      this.profileImagePreview = URL.createObjectURL(e.target.files[0])
    },
    toggleCreateModal() {
      this.step = 0
      this.$emit('toggleCreateModal', false)
    }
  },
}
</script>

<style scoped>
.carousel__item {
  height: 60vh;
  width: 80%;
  background-color: var(--vc-clr-primary);
  color: var(--vc-clr-white);
  font-size: 20px;
  border-radius: 16px;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>