<template>
  <div
      class="absolute px-2 top-0 bottom-0 bg-[#000] bg-opacity-10 translate-middle-x w-[100vw] left-1/2 z-[2000] backdrop-blur-sm">
    <div class="bg-white mx-auto max-w-[430px] h-[318px] top-1/2 relative translate-middle-y rounded-[20px] z-[2001]">
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
        <button
            class="d-flex justify-center col-auto w-[138px] h-[51.5px] bg-[#009606] rounded-[18px] mx-[8.25px] text-white">
          <span class="self-center">ادامه</span>
          <img class="self-center ml-[9px]" src="/assets/img/PageBuilder/modal-next-arrow.svg" alt="">
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NewProfile",
  data() {
    return {
      usernameInput: null,
    }
  },
  methods: {
    toggleCreateModal(){
      this.$emit('toggleCreateModal',false)
    }
  },
}
</script>

<style scoped lang="scss">

</style>