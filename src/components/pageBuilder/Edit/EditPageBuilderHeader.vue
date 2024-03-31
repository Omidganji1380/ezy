<template>
  <div
      class="pt-[12px] px-[34px] overflow-hidden whitespace-nowrap mx-auto fixed-top container max-w-[430px] bg-[#f9f9f9] header-large-title row flex-nowrap justify-content-between border-b-2 pb-1 shadow-[0_10px_15px_-20px] flex-row-reverse">
      <span class="p-0 title fs-3 col-auto self-center row pointer-events-auto" @click.prevent="showMenu">
        <img src="/assets/img/PageBuilder/sidebarHambergery.png" alt="">
      </span>
<!--    <span class="p-0 title fs-3 col-auto self-center font-shabnam-bold">-->
<!--        صفحه ساز ایزی-->
<!--      </span>-->
    <span class="p-0 title fs-3 col-auto self-center" @click.prevent="$router.go(-1)">
      <-
<!--        <img src="/assets/img/PageBuilder/headerEzyLogo.png" alt="">-->
      </span>
  </div>
</template>

<script>
export default {
  name: "EditPageBuilderHeader",
  data() {
    return {
      sideMenu: false
    }
  },
  emits:['showMenu'],
  methods: {
    showMenu() {
      this.sideMenu = !this.sideMenu
      this.$emit('showMenu', this.sideMenu)
    }
  },
}
</script>

<style scoped lang="scss">
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
</style>