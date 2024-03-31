<template>
  <loading-spinner :loading="loading"/>
  <div id="profileImg"
       class="-mt-[100%] transition-all duration-1000 fixedHeader fixed-top w-[430px] mx-auto p-05 !bg-white !bg-opacity-40 backdrop-blur-[6px] shadow-[0_10px_10px_-15px] rounded-b-3xl">
    <div class="row justify-between flex-nowrap">
      <div class="col-auto">
        <img onerror="this.style.display='none'"
             :src="profile.profileImg" id="profileImg"
             class="w-[70px] h-[70px] object-cover rounded-full"
             alt="">
      </div>
      <div class="col-auto self-center">
        <h1 class="text-center text-[18px] font-shabnam-medium-fd mb-[8px]">{{ profile.profileTitle }}</h1>
      </div>
      <div class="col-auto self-center d-none">
        <h1 class="btn btn-success text-center text-[18px] font-shabnam-medium-fd mb-[8px]">ذخیره مخاطب</h1>
      </div>
    </div>
  </div>
  <div class="backImg relative pointer-events-none mb-[80px]"
       :class="{'mb-[150px]':!profile.profileBgImg,'!mb-[30px]':!profile.profileImg}">
    <img onerror="this.style.display='none'"
         src="/assets/img/previewPageBuilder/backProfileCurve.png"
         class="absolute bottom-0" alt=""
         :class="{'d-none':!profile.profileImg||!profile.profileBgImg}">
    <img onerror="this.style.display='none'"
         :src="profile.profileBgImg"
         class="border-0 w-full h-[200px] object-cover" alt="">
    <img onerror="this.style.display='none'"
         :src="profile.profileImg"
         :class="{'mt-3':!profile.profileBgImg,'d-none':!profile.profileImg}"
         class="top-[75%] w-[111px] h-[111px] absolute left-1/2 -translate-x-1/2 rounded-full object-cover rounded-circle"
         alt="">
  </div>
  <div class="row justify-center mb-2 ">
    <h1 class="col-12 text-center text-[18px] font-shabnam-medium-fd mb-[8px]">{{ profile.profileTitle }}</h1>
    <h2 class="col-12 text-[16px] font-shabnam-light-fd text-center description">{{ profile.profileSubtitle }}</h2>
  </div>
  <div class="mx-[44px]">
    <div class="row mb-[16px] text-[18px] justify-between" v-for="(block,key) in blocks.blocks">
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
      <PbOptions :blocks="blocks" :block="block" :arrayKey="key"/>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import PbOptions from "@/components/pageBuilder/Preview/Blocks/PbOptions.vue";
import LoadingSpinner from "@/components/pageBuilder/Loading/LoadingSpinner.vue";

export default {
  name      : "Preview",
  props     : {
    link: ''
  },
  components: {
    LoadingSpinner,
    PbOptions,
  },
  data() {
    return {
      loading:true,
      profile: {
        profile        : null,
        profileBgImg   : null,
        profileImg     : null,
        profileTitle   : null,
        profileSubtitle: null,
      },
      blocks : {
        blocks     : [],
        blockTitles: [],
        blockLinks : [],
        blockWidth : [],
      },
      // pbOptions : [],
    }
  },
  methods: {

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

          this.blocks.blocks           = res.data.blocks.blocks
          this.blocks.blockTitles      = res.data.blocks.blockTitles
          this.blocks.blockLinks       = res.data.blocks.blockLinks
          this.blocks.blockWidth       = res.data.blocks.blockWidth
          setTimeout(() => {
            this.loading = false
          }, 100)
        })
        .catch(err => console.log(err))
    document.querySelector('body').classList.add('!overflow-y-auto');
    // document.querySelector('#app').classList.add('!h-[unset]');
  },
  updated() {
    window.addEventListener("scroll", function () {
      if (window.scrollY >= 300) {
        document.querySelector('#profileImg').classList.add('mt-0')
      } else {
        document.querySelector('#profileImg').classList.remove('mt-0')
      }
    });
  },
}
</script>

<style>
a:hover {
  color: unset;
}

.description {
  unicode-bidi: plaintext;
  word-break: break-word;
}

.w-half-block {
  width: 48.5%;
  margin-bottom: 0 !important;
}

.col-12 {
  width: 100% !important;
}

</style>