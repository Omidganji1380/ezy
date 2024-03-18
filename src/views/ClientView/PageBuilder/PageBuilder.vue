<template>
  <SideMenu :baseURL="baseURL"/>
  <div id="appCapsule" class=" relative !pt-[29px] bg-[#f9f9f9] show-menu">
    <Header @showMenu="showMenu"/>

    <div class="section mt-[46px] mb-3" v-if="!profiles.length">
      <img src="/assets/img/PageBuilder/nothing.svg" class="mx-auto" alt="">
      <p class="text-center fs-4 my-4 font-shabnam-bold">هنوز صفحه ای ایجاد نکردی</p>
    </div>

    <div class="pb-[170px] bg-[#f9f9f9] pt-1" v-else>
      <div class="section m-[29px] px-[23px] rounded-[15px] bg-[#f9fffb] drop-shadow-md py-[16px]">
        <div class="row overflow-hidden flex-nowrap content-start bg-[#009606] h-[31px] rounded-[7px] px-[10px]">
       <span class="col-auto p-0 self-center">
          <img src="/assets/img/PageBuilder/copy-profile-url.svg" alt="">
       </span>
          <span class="col-auto py-0 self-center px-1">
          <img src="/assets/img/PageBuilder/share-profile-url.svg" alt="">
       </span>
          <span class="col-auto p-0 border-[#92929277] border-l-[1px] my-1"> </span>
          <span class="col-auto py-0 text-white self-center text-[12px] px-[8px]">ezy.company/Omid</span>
          <span class="col-auto p-0 text-white self-center ml-auto text-[12.7px]">رایگان</span>
        </div>
        <div class="row overflow-hidden mt-[15px] content-end flex-nowrap" dir="rtl">
        <span class="col-auto p-0">
          <img src="/assets/img/PageBuilder/demoImg.jpg" class="w-[91px] h-[91px] rounded-circle" alt="">
        </span>
          <div class="col-auto py-0 self-center pl-0 pr-[8px] max-w-[100%] text-truncate">
            <p class="font-shabnam-fd-wol text-[18px] pr-[8px]">امید گنجی</p>
            <p class="font-shabnam-light-fd text-[16px]">برنامه نویس asdasdasdada sdsadasdasd </p>
          </div>
        </div>
        <div class="row gap-x-10">
          <button
              class="col-12 whitespace-nowrap overflow-hidden mt-[30px] mb-[20px] h-[39px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
            دسته بندی و مشاوره رایگان
          </button>
          <div class="col-12">
            <div class="row flex-nowrap w-[99%]">
              <button
                  class="whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 mb-[8px] h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                حساب تجاری
                <img src="/assets/img/PageBuilder/diamond.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
              <button
                  class="whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 mb-[8px] h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                ذخیره خودکار
                <img src="/assets/img/PageBuilder/vcf.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
            </div>
            <div class="row flex-nowrap w-[99%]">
              <button
                  class="whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                پیش نمایش
                <img src="/assets/img/PageBuilder/preview-eye.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
              <button
                  class="whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                ویرایش
                <img src="/assets/img/PageBuilder/pen-edit.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="section m-[29px] px-[23px] rounded-[15px] bg-[#f9fffb] drop-shadow-md py-[16px]">
        <div class="row overflow-hidden flex-nowrap content-start bg-[#009606] h-[31px] rounded-[7px] px-[10px]">
       <span class="col-auto p-0 self-center">
          <img src="/assets/img/PageBuilder/copy-profile-url.svg" alt="">
       </span>
          <span class="col-auto py-0 self-center px-1">
          <img src="/assets/img/PageBuilder/share-profile-url.svg" alt="">
       </span>
          <span class="col-auto p-0 border-[#92929277] border-l-[1px] my-1"> </span>
          <span class="col-auto py-0 text-white self-center text-[12px] px-[8px]">ezy.company/Omid</span>
          <span class="col-auto p-0 text-white self-center ml-auto text-[12.7px]">رایگان</span>
        </div>
        <div class="row overflow-hidden mt-[15px] content-end flex-nowrap" dir="rtl">
        <span class="col-auto p-0">
          <img src="/assets/img/PageBuilder/demoImg.jpg" class="w-[91px] h-[91px] rounded-circle" alt="">
        </span>
          <div class="col-auto py-0 self-center pl-0 pr-[8px] max-w-[100%] text-truncate">
            <p class="font-shabnam-fd-wol text-[18px] pr-[8px]">امید گنجی</p>
            <p class="font-shabnam-light-fd text-[16px]">برنامه نویس asdasdasdada sdsadasdasd </p>
          </div>
        </div>
        <div class="row gap-x-10">
          <button
              class="col-12 mt-[30px] mb-[20px] h-[39px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
            دسته بندی و مشاوره رایگان
          </button>
          <div class="col-12">
            <div class="row flex-nowrap w-[99%]">
              <button
                  class="whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 mb-[8px] h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                حساب تجاری
                <img src="/assets/img/PageBuilder/diamond.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
              <button
                  class="whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 mb-[8px] h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                ذخیره خودکار
                <img src="/assets/img/PageBuilder/vcf.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
            </div>
            <div class="row flex-nowrap w-[99%]">
              <button
                  class="whitespace-nowrap overflow-hidden col-6 mr-[10px] text-right px-0 h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                پیش نمایش
                <img src="/assets/img/PageBuilder/preview-eye.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
              <button
                  class="whitespace-nowrap overflow-hidden col-6 ml-[10px] text-right px-0 h-[52px] bg-[#F0FCF3] rounded-[7px] border-solid border-1 border-[#009606] text-[#009606]">
                ویرایش
                <img src="/assets/img/PageBuilder/pen-edit.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <Footer @toggleCreateModal="toggleCreateModal"/>

    <NewProfile v-show="createModal" @toggleCreateModal="toggleCreateModal"/>
  </div>
</template>

<script>
import axios from "axios";
import NewProfile from "@/components/pageBuilder/newProfile/NewProfile.vue";
import Footer from "@/components/pageBuilder/Includes/Footer.vue";
import Header from "@/components/pageBuilder/Includes/Header.vue";
import SideMenu from "@/components/pageBuilder/Includes/SideMenu.vue";

export default {
  props     : ['baseURL'],
  components: {NewProfile, Footer, Header,SideMenu},
  data() {
    return {
      createModal: false,
      profiles   : [''],
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
    toggleCreateModal() {
      this.createModal = !this.createModal
    },
  },
  mounted() {
    // localStorage.storedData
    // localStorage.setItem('token',[omid=>'omid',])
    var a = JSON.parse(localStorage.getItem('token'))

    console.log(a)

  },
}
</script>

<style>
.show-menu {
  transform: scale(0.8) !important;
  right: 60% !important;
  overflow: auto;
  pointer-events: none;
  transition: all ease-in-out 300ms !important;
  top: 20% !important;
  height: 80vh !important;
  padding-bottom: 0 !important;
}

#appCapsule {
//scale: 1; right: 0; height: 100vh;
  border-radius: 20px;
  top: 0;
  transition: all ease-in-out 300ms;
}
</style>