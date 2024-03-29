<template>
  <!--  <div class="relative top-100 ">-->
  <div class="!bg-[#ffffff80] backdrop-blur-sm bottom-0 closeModal left-0 right-0 fixed z-[4000]" id="backdrop"></div>
    <div id="modalHeader" class="mt-[15%] fixed-top bg-white closeModal w-[430px] mx-auto z-[999999999] rounded-t-[30px]">
     <span class="absolute right-[28px] top-[19px] z-[9999]" @click.prevent="closeModal">
        <img src="/assets/img/PageBuilder/modal-Close-Square.svg" alt="">
      </span>
      <div class="row relative">
        <p class="text-center text-[12.86px] text-gray-600 mt-[19px] mb-[7px]">پیش نمایش</p>
        <p class="text-center text-[12.86px] text-gray-400 mb-[4px]">وقتی کسی وارد لینک شما بشه این صفحه نمایش داده
          میشه</p>
      </div>
    </div>
    <div
        class="mt-[15%] absolute rounded-t-[30px] overflow-y-scroll w-[430px] bottom-0 z-[5000] closeModal bg-white drop-shadow-md "
        id="modall">

      <div class="mt-[15%]">
        <Preview :link="link"/>
      </div>
    </div>
  <!--  </div>-->
</template>

<script>
import Preview from "@/views/ClientView/PageBuilder/Preview/Preview.vue";

export default {
  name      : "PreviewModal",
  props     : ['link'],
  components: {
    Preview,
  },
  methods   : {
    closeModal() {
      document.querySelector('#app').classList.remove('!h-[unset]')
      document.querySelector('#modall').classList.remove('showModal')
      document.querySelector('#backdrop').classList.remove('showModal')
      document.querySelector('#modalHeader').classList.remove('showModal')
      document.querySelector('#modalHeader').classList.add('closeModal')
      document.querySelector('#modall').classList.add('closeModal')
      document.querySelector('#backdrop').classList.add('closeModal')
      setTimeout(() => {
        this.$emit('closeModal')
      }, 500)
    }
  },
  mounted() {
    document.querySelector('body').classList.remove('!bg-white')
    setTimeout(() => {
      document.querySelector('#modall').classList.add('showModal')
      document.querySelector('#backdrop').classList.add('showModal')
      document.querySelector('#modalHeader').classList.add('showModal')
      document.querySelector('#modalHeader').classList.remove('closeModal')
      document.querySelector('#modall').classList.remove('closeModal')
      document.querySelector('#backdrop').classList.remove('closeModal')
    }, 100)
  },
}
</script>

<style>
.showModal {
  top: 0 !important;
  transition: all ease-in-out 500ms;
}

.closeModal {
  top: 100% !important;
  transition: all ease-in-out 500ms;
}

body {
  overflow-y: hidden !important;
}
</style>