<template>
  <div class="fixed-bottom container p-[12px] pt-0 bg-[#F9F9F9] max-w-[430px]">
    <div class="section my-3 px-0 font-shabnam-bold">
      <button class="btn bg-[#009606] text-white w-100" @click.prevent="toggleCreateModal">
        ساخت صفحه
        <img src="/assets/img/PageBuilder/createPagePlus.svg" alt="" class="ml-1">
      </button>
    </div>
    <div class="bg-[#62DF85] rounded-full">
      <div class="row h-[56px] flex-nowrap">
        <button class="btn h-[57px] bg-[#F0FCF3] col-5 drop-shadow-md rounded-r-[250rem] rounded-l-full">
          <img src="/assets/img/PageBuilder/shopping-cart.svg" alt="">
        </button>
        <button class="btn h-[57px] col-2 px-0">
          <img src="/assets/img/PageBuilder/Category-insertBtn.svg" alt="">
        </button>
        <button class="btn h-[57px] bg-[#F0FCF3] col-5 drop-shadow-md rounded-l-[250rem] rounded-r-full">
          <img src="/assets/img/PageBuilder/ProfileIcon.svg" alt="">
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
  methods: {
    toggleCreateModal() {
      this.$emit('toggleCreateModal',true)
    }
  },
}
</script>

<style scoped lang="scss">

</style>