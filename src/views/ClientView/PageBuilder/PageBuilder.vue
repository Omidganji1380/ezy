<template>
  <loading-spinner :loading="loading"></loading-spinner>
  <SideMenu/>
  <div id="appCapsule" class=" relative !pt-[15%] bg-[#f9f9f9] transition-all">
    <Header @showMenu="showMenu"/>

    <div class="section mt-[46px] mb-3" v-if="!profiles.length">
      <img src="/assets/img/PageBuilder/nothing.svg" class="mx-auto" alt="">
      <p class="text-center fs-4 my-4 font-shabnam-bold">هنوز صفحه ای ایجاد نکردی</p>
    </div>

    <div class="pb-[170px] bg-[#f9f9f9] pt-1" v-else>
      <div :class="[{'mt-0':index===0,'mb-0':profiles.length-1===index}]"
           class="section m-[29px] px-[23px] rounded-[15px] bg-[#f9fffb] drop-shadow-md py-[16px]"
           v-for="(profile,index) in profiles" :key="index">
        <div class="row h-[31px] px-[10px] relative">
          <div class="col-11 p-0">
            <div class="row bg-pri-color rounded-[7px] overflow-hidden flex-nowrap content-start">
          <span class="col-auto p-0 self-center">
            <img src="/assets/img/PageBuilder/copy-profile-url.svg" alt="">
          </span>
              <span class="col-auto py-0 self-center px-1">
          <img src="/assets/img/PageBuilder/share-profile-url.svg" alt="">
       </span>
              <span class="col-auto p-0 border-[#92929277] border-l-[1px] my-1"> </span>
              <span class="col-auto py-0 text-white self-center text-[12px] px-[8px]">
            {{ ezyLink + profileLinks[index] }}
          </span>
            </div>
          </div>
          <div class="col-1 self-center p-0">
            <span class="col-auto p-0 text-white self-center ml-auto text-[12.7px]"
                  @click.prevent="profileMenuDots(index)">
              <img src="/assets/img/PageBuilder/profileMenuDots.svg" class="ml-auto" alt="">
            </span>
          </div>
          <div :id="'profileMenuDots-'+index" dir="rtl"
               class="profileMenuDots absolute d-none fade overflow-hidden shadow-md border-b-2 px-0 border-b-gray-300 bg-white top-full w-[106px] right-[12px] rounded-[6px]">
            <a class="row items-center justify-between flex-nowrap py-[9px] px-3">
              <span class="col-auto text-[12.75px] p-0 text-gray-600 font-shabnam-medium-fd">حذف</span>
              <span class="col-auto text-[12.75px] p-0 text-gray-600 font-shabnam-medium-fd">
                <img src="/assets/img/PageBuilder/profileMenuDotsTrash.svg" alt="">
              </span>
            </a>
            <hr>
            <a class="row items-center justify-between flex-nowrap py-[9px] px-3">
              <span class="col-auto text-[12.75px] p-0 text-gray-600 font-shabnam-medium-fd">جابه جایی</span>
              <span class="col-auto text-[12.75px] p-0 text-gray-600 font-shabnam-medium-fd">
                <img src="/assets/img/PageBuilder/profileMenuDotsMove.svg" alt="">
              </span>
            </a>
          </div>
        </div>
        <div class="row overflow-hidden mt-[15px] content-end flex-nowrap" dir="rtl">
        <span class="col-auto p-0">
          <img :src="profileImgs[index]" class="w-[91px] h-[91px] rounded-circle object-cover" alt=" ">
        </span>
          <div class="col-auto py-0 self-center pl-0 pr-[8px] max-w-[100%] text-truncate">
            <p class="font-shabnam-fd-wol text-[18px] pr-[8px]">{{ profileTitles[index] }}</p>
            <p class="font-shabnam-light-fd text-[16px]">{{ profileSubtitles[index] }}</p>
          </div>
        </div>
        <div class="row gap-x-10">
<!--          <button-->
<!--              class="col-12 mt-[30px] mb-[20px] h-[39px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">-->
<!--            دسته بندی و مشاوره رایگان-->
<!--          </button>-->
          <div class="col-12 mt-[30px]">
            <div class="row flex-nowrap w-[99%]">
              <a
                  class="hover:text-pri-color flex justify-center items-center whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 mb-[8px] h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                دسته بندی
              </a>
              <a
                  class="hover:text-pri-color flex justify-end items-center whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 mb-[8px] h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                ذخیره خودکار
                <img src="/assets/img/PageBuilder/vcf.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </a>
            </div>
            <div class="row flex-nowrap w-[99%]">
              <a @click.prevent="showPreviewModal(profileLinks[index])"
                 class="hover:text-pri-color flex justify-end items-center whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                پیش نمایش
                <img src="/assets/img/PageBuilder/preview-eye.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </a>
              <router-link :to="{name:'ClientView_PageBuilder_Edit',params:{id:profile.id}}"
                           class="hover:text-pri-color flex justify-end items-center whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                ویرایش
                <img src="/assets/img/PageBuilder/pen-edit.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>


    <Footer @toggleCreateModal="toggleCreateModal"/>

    <NewProfile v-if="createModal" @toggleCreateModal="toggleCreateModal"/>
  </div>
  <PreviewModal :link="PreviewLink" @closeModal="showPreview=false" v-if="showPreview"/>
  <!--  <ContextMenu :contextOptions="contextMenuProfilesOptions"
                 :contextMenuProfiles="contextMenuProfiles"
                 v-if="contextMenuProfiles"
                 @closeContextMenu="contextMenuProfiles=null"/>-->
</template>

<script>
import axios from "axios";
import NewProfile from "@/components/pageBuilder/newProfile/NewProfile.vue";
import Footer from "@/components/pageBuilder/Includes/Footer.vue";
import Header from "@/components/pageBuilder/Includes/Header.vue";
import SideMenu from "@/components/pageBuilder/Includes/SideMenu.vue";
import PreviewModal from "@/components/pageBuilder/Preview/PreviewModal.vue";
import $ from 'jquery'
import LoadingSpinner from "@/components/pageBuilder/Loading/LoadingSpinner.vue";
// import ContextMenu from "@/components/pageBuilder/Includes/ContextMenu.vue";

export default {
  components: {
    LoadingSpinner,
    NewProfile,
    Footer,
    Header,
    SideMenu,
    PreviewModal,
  },
  data() {
    return {
      loading         : true,
      createModal     : false,
      profiles        : [],
      profileImgs     : {},
      profileTitles   : {},
      profileSubtitles: {},
      profileLinks    : {},
      ezyLink         : '',
      PreviewLink     : null,
      showPreview     : false,
      /*contextMenuProfiles       : null,
      contextMenuProfilesOptions: null,*/
    }
  },
  methods: {
    profileMenuDots(index) {
      setTimeout(() => {
        $('.profileMenuDots').removeClass('d-none show')
      }, 60)
      setTimeout(() => {
        $('#profileMenuDots-' + index).addClass('show')
      }, 200)
    },
    showPreviewModal(link) {
      this.PreviewLink = link
      this.showPreview = true
    },
    showMenu(showMenu) {
      if (showMenu === true) {
        $('#appCapsule').addClass('show-menu')
        $('#sideMenu').addClass('sideMenu')
      } else {
        $('#appCapsule').removeClass('show-menu')
        $('#sideMenu').removeClass('sideMenu')
      }
    },
    toggleCreateModal() {
      this.createModal = !this.createModal
      this.firstMount()
    },
    firstMount() {
      var userToken = JSON.parse(localStorage.getItem('token'))
      axios({
              url   : 'v1/dashboard',
              method: 'POST',
              data  : {
                userId: userToken.id
              }
            })
          .then(res => {
            this.profiles         = res.data.profiles
            this.profileImgs      = res.data.profileImgs
            this.profileTitles    = res.data.profileTitles
            this.profileSubtitles = res.data.profileSubtitles
            this.profileLinks     = res.data.profileLinks
            // this.contextMenu()
            setTimeout(() => {
              this.loading = false
            }, 100)
          })
          .catch(err => console.log(err))

      this.ezyLink = axios.defaults.baseURL;
      this.ezyLink = this.ezyLink.replace(/(^\w+:|^)\/\//, '');
      this.ezyLink = this.ezyLink.replace('api/', '')
    },
    /*contextMenu(index) {
      this.contextMenuProfiles = document.getElementById("contextMenuProfiles_" + index)
      this.contextMenuProfilesOptions={
        omid:'dsa',
        ganji:'asd'
      }
    },*/
  },
  mounted() {
    this.firstMount()
    document.addEventListener('click', () => {
      $('.profileMenuDots').removeClass('show')
      setTimeout(() => {
        $('.profileMenuDots').addClass('d-none')
      }, 50)
    })
  },

}
</script>

<style>
.show-menu {
  transform: scale(0.8) !important;
  right: 60% !important;
  overflow: auto;
  pointer-events: none;
  transition: all ease-in-out 250ms !important;
  top: 20% !important;
  height: 80vh !important;
  padding-bottom: 0 !important;
  box-shadow: 0 0 30px 0 !important;
}

#appCapsule {
//scale: 1; right: 0; height: 100vh; border-radius: 20px; top: 0; transition: all ease-in-out 250ms; box-shadow: 0 0 0 0;
}
</style>