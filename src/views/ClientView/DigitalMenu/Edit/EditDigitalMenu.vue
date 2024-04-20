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
</template>

<script>

import axios from "axios";
import $ from "jquery";
import {useStorage} from "@vueuse/core";
import {useStore} from 'vuex'
import Header from "@/components/digitalMenu/Includes/Header.vue";

export default {
  name      : "EditDigitalMenu",
  components: {Header},
  data() {
    return {
      menu_id: this.$route.params.id,
      user_id: useStore().state.user_id,
      lang   : useStore().state.lang??'fa',
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