<template>
  <loading-spinner :loading="loading"></loading-spinner>
  <SideMenu/>
  <div id="appCapsule" class="relative bg-[#f9f9f9] bg-gradient-to-r from-indigo-950 to-red-900">
    <EditPageBuilderHeader @showMenu="showMenu"/>

    <div class="backImg relative pointer-events-none mb-[80px]"
         :class="{'mb-[150px]':!profile.profileBgImg,'!mb-[30px]':!profile.profileImg}">

      <img onerror="this.style.display='none'" id="bgImage"
           :src="profile.profileBgImg"
           style="mask-image: url(/assets/img/previewPageBuilder/backProfileCurve.png);mask-position: center;"
           class="border-0 w-full h-[200px] object-cover reverse-mask" alt="">

      <img onerror="this.style.display='none'"
           :src="profile.profileImg"
           :class="{'mt-3':!profile.profileBgImg,'d-none':!profile.profileImg}"
           class="top-[75%] w-[111px] h-[111px] absolute left-1/2 -translate-x-1/2 rounded-full object-cover rounded-circle"
           alt="">
    </div>

  </div>
</template>

<script>

import EditPageBuilderHeader from "@/components/pageBuilder/Edit/EditPageBuilderHeader.vue";
import axios from "axios";
import $ from "jquery";
import {useStorage} from "@vueuse/core";
import SideMenu from "@/components/pageBuilder/Includes/SideMenu.vue";
import LoadingSpinner from "@/components/pageBuilder/Loading/LoadingSpinner.vue";

export default {
  name      : "EditPageBuilder",
  components: {LoadingSpinner, SideMenu, EditPageBuilderHeader},
  data() {
    return {
      loading   : true,
      profile_id: this.$route.params.id,
      user_id   : useStorage('token'),
      profile   : {
        profile        : null,
        profileBgImg   : null,
        profileImg     : null,
        profileTitle   : null,
        profileSubtitle: null,
      },
      blocks    : {
        blocks     : [],
        blockTitles: [],
        blockLinks : [],
        blockWidth : [],
      },
    }
  },
  methods: {
    showMenu(showMenu) {
      if (showMenu === true) {
        $('#appCapsule').addClass('show-menu')
        $('#sideMenu').addClass('sideMenu')
      } else {
        $('#appCapsule').removeClass('show-menu')
        $('#sideMenu').removeClass('sideMenu')
      }
    },
  },
  mounted() {
    axios({
            method: 'post',
            url   : 'v1/pb/edit',
            data  : {
              profile_id: this.profile_id,
              user_id   : JSON.parse(this.user_id).id
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