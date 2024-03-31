<template>
  <loading-spinner :loading="loading"></loading-spinner>
  <SideMenu/>
  <div id="appCapsule" class=" relative !pt-[29px] bg-[#f9f9f9]">
  <EditPageBuilderHeader @showMenu="showMenu"/>
    
    <div class="row">
      <img src="/assets/img/PageBuilder/demoImg.jpg" alt="">
    </div>
  </div>
</template>

<script>

import EditPageBuilderHeader from "@/components/pageBuilder/Edit/EditPageBuilderHeader.vue";
import axios from "axios";
import {useStorage} from "@vueuse/core";
import SideMenu from "@/components/pageBuilder/Includes/SideMenu.vue";
import LoadingSpinner from "@/components/pageBuilder/Loading/LoadingSpinner.vue";

export default {
  name      : "EditPageBuilder",
  components: {LoadingSpinner, SideMenu, EditPageBuilderHeader},
  data() {
    return {
      loading         : true,
      profile_id: this.$route.params.id,
      user_id   : useStorage('token'),
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
    }
  },
  methods: {
    showMenu(showMenu) {
      if (showMenu === true) {
        document.getElementById('appCapsule').classList.add('show-menu')
      } else {
        document.getElementById('appCapsule').classList.remove('show-menu')
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

          this.blocks.blocks           = res.data.blocks.blocks
          this.blocks.blockTitles      = res.data.blocks.blockTitles
          this.blocks.blockLinks       = res.data.blocks.blockLinks
          this.blocks.blockWidth       = res.data.blocks.blockWidth
          setTimeout(() => {
            this.loading = false
          }, 100)
          console.log(profile)
        })
        .catch(err => console.log(err))
  },
}
</script>

<style scoped lang="scss">

</style>