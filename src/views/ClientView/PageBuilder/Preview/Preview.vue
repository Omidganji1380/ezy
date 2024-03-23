<template>
  <div class="backImg relative pointer-events-none mb-[80px]" :class="{'mb-[150px]':!profile.profileBgImg,'!mb-[30px]':!profile.profileImg}">
    <img src="/assets/img/previewPageBuilder/backProfileCurve.png" class="absolute bottom-0" alt="" :class="{'d-none':!profile.profileImg}">
    <img :src="profile.profileBgImg" class="w-full max-h-[200px] object-cover" alt="">
    <!--    <div class=" w-[111.5px] h-[111.5px] "-->

    <!--    >-->
    <img :src="profile.profileImg" :class="{'mt-3':!profile.profileBgImg}"
         class="top-[75%] absolute left-1/2 -translate-x-1/2 rounded-full object-cover rounded-circle" alt="">
    <!--    </div>-->
  </div>
  <div class="row justify-center">
    <h1 class="col-12 text-center text-[18px] font-shabnam-medium-fd mb-[8px]">{{ profile.profileTitle }}</h1>
    <h2 class="col-12 text-[16px] font-shabnam-light-fd text-center description">{{ profile.profileSubtitle }}</h2>
  </div>
  <div class="row mx-[44px] mt-[24px] text-[18px]">
    <div class="col-12 px-0 mb-[16px]">
      <button
          class="mb-[14px] d-flex px-2 flex-nowrap overflow-hidden text-nowrap flex-row-reverse rounded-[8px] items-center h-[44px] border-2 border-black w-full justify-between">
        <span class="font-shabnam-medium-fd col-auto">©</span>
        <span class="font-shabnam-medium-fd col-auto">0938 94 97 958</span>
      </button>
      <button
          class="d-flex px-2 flex-nowrap overflow-hidden text-nowrap flex-row-reverse rounded-[8px] items-center h-[44px] border-2 border-black w-full justify-between">
        <span class="font-shabnam-medium-fd col-auto">©</span>
        <span class="font-shabnam-medium-fd col-auto">0938 94 97 958</span>
      </button>
    </div>
    <div class="col-12 px-0">
      <div class="row">
        <div class="col-6">
          <button
              class="mb-[14px] d-flex px-2 flex-nowrap overflow-hidden text-nowrap flex-row-reverse rounded-[8px] items-center h-[44px] border-2 border-black w-full justify-start">
            <span class="font-shabnam-medium-fd col-auto ml-[11px]">©</span>
            <span class="font-shabnam-medium-fd col-auto">تماس</span>
          </button>
        </div>
        <div class="col-6">

          <button
              class="d-flex px-2 flex-nowrap overflow-hidden text-nowrap flex-row-reverse rounded-[8px] items-center h-[44px] border-2 border-black w-full justify-start">
            <span class="font-shabnam-medium-fd col-auto ml-[11px]">©</span>
            <span class="font-shabnam-medium-fd col-auto">پیامک</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name : "Preview",
  props: {
    link: ''
  },
  data() {
    return {
      profile: {
        profile        : null,
        profileBgImg   : null,
        profileImg     : null,
        profileTitle   : null,
        profileSubtitle: null,
      },
      blocks : [],
    }
  },
  methods: {
    j_stringify($json) {
      return JSON.stringify($json)
    }
  },
  beforeMount() {
    document.querySelector('body').classList.add('!bg-white')
  },
  mounted() {
    axios({
            method: 'post',
            url   : 'v1/dashboard/getView',
            data  : {
              link: this.link
            }
          })
        .then(res => {
          var profile                  = res.data.profile
          this.profile.profile         = profile.profile
          this.profile.profileBgImg    = profile.profileBgImg
          this.profile.profileImg      = profile.profileImg
          this.profile.profileTitle    = profile.profileTitle
          this.profile.profileSubtitle = profile.profileSubtitle
          // console.log(this.profileBgImg)
          this.blocks                  = this.j_stringify(res.data.blocks)
          // console.log(this.profile)
          // console.log(this.blocks)
        })
        .catch(err => console.log(err))
  },
}
</script>

<style>
.description {
  unicode-bidi: plaintext;
  word-break: break-word;
}
</style>