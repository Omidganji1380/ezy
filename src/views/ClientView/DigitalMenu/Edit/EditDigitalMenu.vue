<template>
  <Header :headerTitle="$t('DigitalMenu.Edit.Header')"/>
  <div class="fixed-top max-w-p mx-auto mt-[40px] bg-sec-color">
    <div class="mt-[14px] overflow-x-scroll px-[24px]">
      <ul :class="{'flex-row-reverse':lang==='fa'}"
          class="flex flex-nowrap items-center text-gray-900 dark:text-white">
        <li class="text-[16px] bg-pri-color text-sec-color rounded-2 px-2 py-1 ml-1">
          جدید
        </li>
        <li class="text-[16px] bg-back text-sec-color rounded-2 px-2 py-1 ml-1">
          جدید
        </li>
      </ul>
    </div>
  </div>
  <div class="header">
<!--    <div id="profileImg"-->
<!--         class="-mt-[100%] transition-all duration-1000 fixedHeader fixed-top w-[430px] mx-auto p-05 !bg-white !bg-opacity-40 backdrop-blur-[6px] shadow-[0_10px_10px_-15px] rounded-b-3xl">-->
<!--      <div class="row justify-between flex-nowrap">-->
<!--        <div class="col-auto">-->
<!--          <img onerror="this.style.display='none'"-->
<!--               :src="profile.profileImg" id="profileImg"-->
<!--               class="w-[70px] h-[70px] object-cover rounded-full"-->
<!--               alt="">-->
<!--        </div>-->
<!--        <div class="col-auto self-center">-->
<!--          <h1 class="text-center text-[18px] font-shabnam-medium-fd mb-[8px]">{{ profile.profileTitle }}</h1>-->
<!--        </div>-->
<!--        <div class="col-auto self-center d-none">-->
<!--          <h1 class="btn btn-success text-center text-[18px] font-shabnam-medium-fd mb-[8px]">ذخیره مخاطب</h1>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
  </div>
</template>

<script>

import axios from "axios";
import $ from "jquery";
import {useStore} from 'vuex'
import Header from "@/components/digitalMenu/Includes/Header.vue";

export default {
  name      : "EditDigitalMenu",
  components: {Header},
  data() {
    return {
      menu_id: this.$route.params.id,
      user_id: useStore().state.user_id,
      lang   : useStore().state.langu,
    }
  },
  methods: {},
  mounted() {
    axios({
            method: 'post',
            url   : 'v1/digitalMenu/edit',
            data  : {
              menu_id: this.menu_id,
              user_id: this.user_id
            }
          })
        .then(res => {
          console.log(res)

          var profile                  = res.data.profile
          this.profile.profile         = profile.profile
          this.profile.profileBgImg    = profile.profileBgImg
          this.profile.profileImg      = profile.profileImg
          this.profile.profileTitle    = profile.profileTitle
          this.profile.profileSubtitle = profile.profileSubtitle

          this.blocks.blocks      = res.data.blocks.blocks
          this.blocks.blockTitles = res.data.blocks.blockTitles
          this.blocks.blockLinks  = res.data.blocks.blockLinks
          this.blocks.blockWidth  = res.data.blocks.blockWidth
          setTimeout(() => {
            this.loading = false
          }, 100)
          console.log(profile)
        })
        .catch(err => console.log(err))
  },
}
</script>

<style>

</style>