<template>
  <div :class="{'px-2':step===0}"
       class="fixed top-0 bottom-0 bg-[#000] bg-opacity-10 translate-middle-x w-[100vw] left-1/2 z-[2000] backdrop-blur-sm">
    <div :class="{'d-none':step!==0}"
         class="bg-white mx-auto max-w-[430px] h-[318px] top-1/2 relative translate-middle-y rounded-[20px] z-[2001]">
        <span class="absolute top-[16.5px] right-[25.5px]" @click.prevent="toggleCreateModal">
          <img src="/assets/img/PageBuilder/modal-Close-Square.svg" alt="">
        </span>
      <h3 dir="rtl" class="text-center pt-[17.5px] text-[#101010] text-[12.9px]">ساخت صفحه</h3>
      <p dir="rtl" class="text-center mt-[7px] text-[#707070] text-[12.9px]">از صفحه ساز ایزی کانکت لذت ببرید !</p>
      <div class="row flex-nowrap justify-center mt-[40px]">
        <span class="col-auto px-0 self-center font-shabnam-fd text-[#009606] text-[16.5px]">www.ezy.company / </span>
        <input type="text" placeholder="نام کاربری" v-model="usernameInput"
               class="col-auto text-center px-0.5 w-[137px] h-[31px] rounded-pill border-solid border-1 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
      </div>
      <div class="w-[290px] mx-auto text-[#707070] text-[12.9px] mt-[7.5px]">
        Https://ezy.company/{{ usernameInput }}
      </div>
      <div class="row justify-center flex-nowrap bottom-[70px] mx-auto absolute translate-middle-x left-1/2">
        <button @click.prevent="toggleCreateModal"
                class="col-auto w-[138px] h-[51.5px] bg-[#F0FCF3] rounded-[18px] mx-[8.25px] border-solid border-1 border-[#009606] text-[#009606]">
          لغو
        </button>
        <button @click.prevent="step++"
                class="d-flex justify-center col-auto w-[138px] h-[51.5px] bg-[#009606] rounded-[18px] mx-[8.25px] text-white">
          <span class="self-center">ادامه</span>
          <img class="self-center ml-[9px]" src="/assets/img/PageBuilder/modal-next-arrow.svg" alt="">
        </button>
      </div>
    </div>

    <div :class="{'d-none':step!==1}"
         class="z-[99999999999] relative max-w-[430px] bg-white text-center mx-auto h-[100vh]">
      <Header/>
      <div class="pt-[60px]">
        <div class="row">
          <div class="col-12">
            <label for="coverImage"
                   class="d-block overflow-hidden bg-[#F0FCF3] relative rounded-b-[80px] h-[100px] mx-[25px] border-solid border-1 border-[#009606]">
              <img :src="coverImagePreview" :class="{'opacity-0':!coverImagePreview}" class="object-cover w-full h-full" alt="">

              <div :class="{'d-none':coverImagePreview}"
                  class="row top-[40%] flex-nowrap overflow-hidden left-1/2 translate-middle absolute"
                   dir="rtl">
                <div class="col-auto p-0 !pl-[6px]">
                  <img src="/assets/img/PageBuilder/upload-cover.svg" width="22" height="22" alt="">
                </div>
                <div class="col-auto p-0 text-[13px] self-end">
                  عکس کاور
                </div>
              </div>

            </label>
            <label for="profileImage" :class="{'overflow-hidden':profileImagePreview}"
                   class="d-block mx-auto bg-[#F0FCF3] rounded-circle relative -top-[20%] h-[120px] max-w-[120px] border-solid border-1 border-[#009606]">
              <img :src="profileImagePreview" :class="{'opacity-0':!profileImagePreview}" class="object-cover w-full h-full" alt="">

              <img src="/assets/img/PageBuilder/upload-cover.svg" :class="{'d-none':profileImagePreview}"
                   class="top-1/2 left-1/2 translate-middle absolute"
                   width="30" height="30" alt="">
              <span :class="{'d-none':profileImagePreview}"
                  class="bg-[#009606] w-[31px] h-[31px] d-block bottom-0 right-0 absolute rounded-circle">
                <img src="/assets/img/PageBuilder/upload-image-camera.svg"
                     class="top-1/2 left-1/2 translate-middle absolute"
                     width="14" height="11" alt="">
              </span>
            </label>
          </div>
        </div>
        <div class="row px-[55px]">
          <div class="col-12 mb-[18px]">
            <input type="text" placeholder="عنوان" v-model="title"
                   class="col-auto w-100 text-center px-0.5 h-[34px] rounded-pill border-solid border-1 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
          </div>
          <div class="col-12 mb-[18px]">
            <input type="text" placeholder="زیرعنوان"
                   class="col-auto w-100 text-center px-0.5 h-[34px] rounded-pill border-solid border-1 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
          </div>
          <div class="col-12 mb-[18px] relative overflow-hidden">
            <input type="text" placeholder="جستجو مثال املاک"
                   class="col-auto w-100 text-center px-0.5 h-[34px] rounded-pill border-solid border-1 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
            <img src="/assets/img/PageBuilder/template-search.svg"
                 class="top-1/2 left-[13.5px] translate-middle-y absolute"
                 width="13" height="13" alt="">
          </div>
        </div>
        <div class="row px-[50px] mx-auto overflow-x-auto whitespace-nowrap flex-nowrap">
          <div class="col-auto">
            <span class="w-[130px] rounded-[10px] h-[270px] bg-gray-400 d-block"></span>
          </div>
          <div class="col-auto">
            <span class="w-[130px] rounded-[10px] h-[270px] bg-gray-400 d-block"></span>
          </div>
          <div class="col-auto">
            <span class="w-[130px] rounded-[10px] h-[270px] bg-gray-400 d-block"></span>
          </div>
          <div class="col-auto">
            <span class="w-[130px] rounded-[10px] h-[270px] bg-gray-400 d-block"></span>
          </div>
          <div class="col-auto">
            <span class="w-[130px] rounded-[10px] h-[270px] bg-gray-400 d-block"></span>
          </div>
        </div>
      </div>


      <div class="row justify-center flex-nowrap bottom-[50px] mx-auto absolute translate-middle-x left-1/2">
        <button @click.prevent="toggleCreateModal"
                class="col-auto w-[138px] h-[51.5px] bg-[#F0FCF3] rounded-[18px] mx-[8.25px] border-solid border-1 border-[#009606] text-[#009606]">
          لغو
        </button>
        <button
            class="d-flex justify-center col-auto w-[138px] h-[51.5px] bg-[#009606] rounded-[18px] mx-[8.25px] text-white">
          <span class="self-center">ادامه</span>
          <img class="self-center ml-[9px]" src="/assets/img/PageBuilder/modal-next-arrow.svg" alt="">
        </button>
      </div>
    </div>

    <input type="file" class="d-none" @input="event => coverImage = event.target.files[0]" id="coverImage"
           v-on:change="setImg">
    <input type="file" class="d-none" @input="event => profileImage = event.target.files[0]" id="profileImage"
           v-on:change="setImg">
  </div>

</template>

<script>
import Header from "@/components/pageBuilder/Includes/Header.vue";

export default {
  name      : "NewProfile",
  components: {
    Header,
  },
  data() {
    return {
      usernameInput      : null,
      step               : 0,
      coverImage         : null,
      profileImage       : null,
      coverImagePreview  : null,
      profileImagePreview: null,
      title              : null,
    }
  },
  updated() {


    // if (this.profileImage){
    //   alert('asd')
    // }
  },
  methods: {
    setImg() {
      if (this.coverImage) {
        this.coverImagePreview = URL.createObjectURL(this.coverImage)
      }
      if (this.profileImage) {
        this.profileImagePreview = URL.createObjectURL(this.profileImage)
      }
    },
    toggleCreateModal() {
      this.step = 0
      this.$emit('toggleCreateModal', false)
    }
  },
}
</script>

<style scoped lang="scss">

</style>