<template>
  <loading-spinner :loading="loading"></loading-spinner>
  <SideMenu/>
  <div id="appCapsule" class=" relative !pt-[29px] bg-[#f9f9f9]">
    <EditPageBuilderHeader @showMenu="showMenu"/>

    <div class="backImg relative pointer-events-none mb-[80px]"
         :class="{'mb-[150px]':!profile.profileBgImg,'!mb-[30px]':!profile.profileImg}">
<!--            <img onerror="this.style.display='none'"-->
<!--                 src="/assets/img/previewPageBuilder/backProfileCurve.svg"-->
<!--                 class="absolute -bottom-[2px]" alt="" style="fill: red"-->
<!--                 :class="{'d-none':!profile.profileImg||!profile.profileBgImg}">-->
      <div class="absolute -bottom-[2px] w-full"
           :class="{'d-none':!profile.profileImg||!profile.profileBgImg}">
        <svg viewBox="0 0 1712 301" fill="#ff00ff" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_2822_15127)">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M844.5 -0.5C848.167 -0.5 851.833 -0.5 855.5 -0.5C956.024 2.1669 1044.69 35.6669 1121.5 100C1148.83 126 1175.5 152.667 1201.5 180C1287 256.461 1387.33 296.628 1502.5 300.5C1074.17 300.5 645.833 300.5 217.5 300.5C258.235 299.044 298.235 292.378 337.5 280.5C340.716 280.655 343.383 279.655 345.5 277.5C391.919 261.134 434.252 237.8 472.5 207.5C474.749 206.92 476.415 205.587 477.5 203.5C477.5 202.833 477.833 202.5 478.5 202.5C480.749 201.92 482.415 200.587 483.5 198.5C484.167 197.167 485.167 196.167 486.5 195.5C489.427 194.243 491.761 192.243 493.5 189.5C500.5 181.833 507.833 174.5 515.5 167.5C516.906 167.027 517.573 166.027 517.5 164.5C525.473 154.227 534.14 144.56 543.5 135.5C544.906 135.027 545.573 134.027 545.5 132.5C548.167 131.833 549.833 130.167 550.5 127.5C553.167 124.167 556.167 121.167 559.5 118.5C563.771 115.899 567.437 112.566 570.5 108.5C571.167 107.167 572.167 106.167 573.5 105.5C576.089 104.581 578.089 102.914 579.5 100.5C618.322 65.9024 662.656 40.2358 712.5 23.5C717.165 22.9431 721.498 21.6098 725.5 19.5C764.221 7.10203 803.888 0.435362 844.5 -0.5Z"
                  />
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M345.5 277.5C343.383 279.655 340.716 280.655 337.5 280.5C339.936 279.129 342.603 278.129 345.5 277.5Z"
                  />
          </g>
          <defs>
            <clipPath id="clip0_2822_15127">
              <rect width="1712" height="301" />
            </clipPath>
          </defs>
        </svg>
      </div>

      <img onerror="this.style.display='none'"
           :src="profile.profileBgImg"
           class="border-0 w-full h-[200px] object-cover" alt="">
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