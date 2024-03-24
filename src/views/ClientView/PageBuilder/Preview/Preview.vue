<template>
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
  <div class="row justify-center">
    <h1 class="col-12 text-center text-[18px] font-shabnam-medium-fd mb-[8px]">{{ profile.profileTitle }}</h1>
    <h2 class="col-12 text-[16px] font-shabnam-light-fd text-center description">{{ profile.profileSubtitle }}</h2>
  </div>
  <div class="row mx-[44px] mt-[24px] text-[18px] justify-between" v-for="(block,key) in blocks.blocks">
    <div
        class="px-0 mb-[16px]"
        :class="blocks.blockWidth[key][index].setBlockWidth+' '+blocks.blockWidth[key][index].lastHalf"
        v-for="(option,index) in block.pb_option"
        :key="index">

      <a :href="blocks.blockLinks[index]" target="_blank"
          class="mb-[14px] d-flex px-2 flex-nowrap overflow-hidden text-nowrap flex-row-reverse rounded-[8px] items-center h-[44px] border-2 border-black w-full justify-between">
        <span class="font-shabnam-medium-fd col-auto">©</span>
        <span class="font-shabnam-medium-fd col-auto">{{ blocks.blockTitles[key][index] }}</span>
      </a>
    </div>
    <!--    <div class="col-12 px-0">
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
        </div>-->
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
    j_stringify($json) {
      return JSON.stringify($json)
    },
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
          // setTimeout(()=>{
          var profile                  = res.data.profile
          this.profile.profile         = profile.profile
          this.profile.profileBgImg    = profile.profileBgImg
          this.profile.profileImg      = profile.profileImg
          this.profile.profileTitle    = profile.profileTitle
          this.profile.profileSubtitle = profile.profileSubtitle
          // console.log(this.profileBgImg)
          this.blocks.blocks           = res.data.blocks.blocks
          this.blocks.blockTitles      = res.data.blocks.blockTitles
          this.blocks.blockLinks       = res.data.blocks.blockLinks
          this.blocks.blockWidth       = res.data.blocks.blockWidth
          console.log(this.blocks.blockWidth)
          // },2000)
        })
        .catch(err => console.log(err))
  },
}
</script>

<style scoped>
a:hover{
  color: unset;
}
.description {
  unicode-bidi: plaintext;
  word-break: break-word;
}
.w-half-block{
  width: 48.5%;
}
.col-12{
  width: 100% !important;
}
</style>