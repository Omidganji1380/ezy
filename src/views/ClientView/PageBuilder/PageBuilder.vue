<template>
  <SideMenu/>
  <div id="appCapsule" class=" relative !pt-[29px] bg-[#f9f9f9]">
    <Header @showMenu="showMenu"/>

    <div class="section mt-[46px] mb-3" v-if="!profiles.length">
      <img src="/assets/img/PageBuilder/nothing.svg" class="mx-auto" alt="">
      <p class="text-center fs-4 my-4 font-shabnam-bold">هنوز صفحه ای ایجاد نکردی</p>
    </div>

    <div class="pb-[170px] bg-[#f9f9f9] pt-1" v-else>
      <div :class="[{'mt-0':index===0,'mb-0':profiles.length-1===index}]"
           :id="'contextMenuProfiles_'+index"
           @mousedown.right.prevent="contextMenu(index)"
           @pointerdown.prevent="contextMenu(index)"
           class="section m-[29px] px-[23px] rounded-[15px] bg-[#f9fffb] drop-shadow-md py-[16px]"
           v-for="(profile,index) in profiles" :key="index">
        <div class="row overflow-hidden flex-nowrap content-start bg-pri-color h-[31px] rounded-[7px] px-[10px]">
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
          <span class="col-auto p-0 text-white self-center ml-auto text-[12.7px]">رایگان</span>
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
          <button
              class="col-12 mt-[30px] mb-[20px] h-[39px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
            دسته بندی و مشاوره رایگان
          </button>
          <div class="col-12">
            <div class="row flex-nowrap w-[99%]">
              <a
                  class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 mb-[8px] h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                حساب تجاری
                <img src="/assets/img/PageBuilder/diamond.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </a>
              <a
                  class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 mb-[8px] h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                ذخیره خودکار
                <img src="/assets/img/PageBuilder/vcf.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </a>
            </div>
            <div class="row flex-nowrap w-[99%]">
              <a @click.prevent="showPreviewModal(profileLinks[index])"
                 class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                پیش نمایش
                <img src="/assets/img/PageBuilder/preview-eye.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </a>
              <a
                  class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 h-[52px] bg-sec-color rounded-[7px] border-solid border-1 border-pri-color text-pri-color">
                ویرایش
                <img src="/assets/img/PageBuilder/pen-edit.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <Footer @toggleCreateModal="toggleCreateModal"/>

    <NewProfile v-if="createModal" @toggleCreateModal="toggleCreateModal"/>
  </div>
  <PreviewModal :link="PreviewLink" @closeModal="showPreview=false" v-if="showPreview"/>
  <div class="absolute w-[100px] z-[999999999999999] fade" style="left: 0" id="contextMenu">
    <div class="menu">
      <ul class="text-white rounded-xl list-group">
        <li class="px-2 py-1 list-group-item bg-gray-300 list-group-item-action transition-all delay-75 text-gray-600">
          test
        </li>
        <li class="px-2 py-1 list-group-item bg-gray-300 list-group-item-action transition-all delay-75 text-gray-600">
          test
        </li>
        <li class="px-2 py-1 list-group-item bg-gray-300 list-group-item-action transition-all delay-75 text-danger">
          delete
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import NewProfile from "@/components/pageBuilder/newProfile/NewProfile.vue";
import Footer from "@/components/pageBuilder/Includes/Footer.vue";
import Header from "@/components/pageBuilder/Includes/Header.vue";
import SideMenu from "@/components/pageBuilder/Includes/SideMenu.vue";
import PreviewModal from "@/components/pageBuilder/Preview/PreviewModal.vue";
import $ from 'jquery'

export default {
  components: {NewProfile, Footer, Header, SideMenu, PreviewModal},
  data() {
    return {
      createModal     : false,
      profiles        : [],
      profileImgs     : {},
      profileTitles   : {},
      profileSubtitles: {},
      profileLinks    : {},
      ezyLink         : '',
      PreviewLink     : null,
      showPreview     : false,
    }
  },
  methods: {
    showPreviewModal(link) {
      this.PreviewLink = link
      this.showPreview = true
    },
    showMenu(showMenu) {
      if (showMenu === true) {
        document.getElementById('appCapsule').classList.add('show-menu')
      } else {
        document.getElementById('appCapsule').classList.remove('show-menu')
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
            this.contextMenu()

          })
          .catch(err => console.log(err))

      this.ezyLink = axios.defaults.baseURL;
      this.ezyLink = this.ezyLink.replace(/(^\w+:|^)\/\//, '');
      this.ezyLink = this.ezyLink.replace('api/', '')
    },
    contextMenu(index) {
      var menu                = $("#contextMenu");
      var contextMenuProfiles = document.getElementById("contextMenuProfiles_" + index);
      // for (var i = 0; i < this.profiles.length; i++) {
      //   if (i === index ) {
      //
      //     contextMenuProfiles.addEventListener('contextmenu', (e) => {
      //       menu.addClass('show');
      //       menu.css({'top': e.clientY + 'px'})
      //       menu.css({'left': e.clientX + 'px'})
      //       window.event.returnValue = false;
      //     });
      //   }
      //   if (i === index) {
      //     contextMenuProfiles.addEventListener('contextmenu', (e) => {
      //       menu.addClass('show');
      //       menu.css({'top': e.clientY + 'px'})
      //       menu.css({'left': e.clientX + 'px'})
      //       window.event.returnValue = false;
      //     });
      //   }
      // }
      // if (document.addEventListener) {
      //   document.addEventListener('contextmenu', function (e) {
      //     // alert("You've tried to open context menu"); //here you draw your own menu
      //     e.preventDefault();
      //   }, false);
      // } else {
        // document.addEventListener('contextmenu', event => event.preventDefault());

        contextMenuProfiles.addEventListener('contextmenu', (e) => {
          menu.addClass('show');
          menu.css({'top': e.clientY + 'px'})
          menu.css({'left': e.clientX + 'px'})
          window.event.returnValue = false;
        });
      // }
      // var contextMenuProfiles = $("#contextMenuProfiles_" + index);

      setTimeout(() => {

      }, 50)


      document.addEventListener("click", () => {
        menu.removeClass('show')
      });
      // setTimeout(() => {
      //   if (menu.hasClass('show')) {
      //     contextMenuProfiles.on('scroll touchmove mousewheel', function (e) {
      //       e.preventDefault();
      //       e.stopPropagation();
      //       return false;
      //     })
      //   }
      // }, 1000)
    },
  },
  mounted() {
    this.firstMount()
    // if (document.addEventListener) {
    //   document.addEventListener('contextmenu', function(e) {
    //     // alert("You've tried to open context menu"); //here you draw your own menu
    //     e.preventDefault();
    //   }, false);
    // } else {
    // document.addEventListener('contextmenu', event => event.preventDefault());
    // var menu = $("#contextMenu");
    // // var contextMenuProfiles = document.getElementById("contextMenuProfiles_" + index);
    //
    // document.addEventListener('contextmenu', (e) => {
    //   menu.addClass('show');
    //   menu.css({'top': e.clientY + 'px'})
    //   menu.css({'left': e.clientX + 'px'})
    //   window.event.returnValue = false;
    // });
    // }
    // setTimeout(() => {
    //   this.contextMenu()
    // }, 1000)
    // if (document.addEventListener) {

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