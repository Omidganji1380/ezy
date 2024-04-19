<template>
  <div :class="{'shadow-3d':shadow3d}"
      class="header fixed-top max-w-p mx-auto bg-sec-color h-[54px] content-center rounded-b-[8px]"
       dir="rtl">
    <div class="row relative mx-auto justify-between flex-nowrap">
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto px-[32px] self-center">
            <img src="/assets/img/darkMode/sidebarHambergery.svg" alt="">
          </span>
        </div>
      </div>
      <span class="col-auto p-0 text-[20px] text-d8 absolute left-1/2 -top-[3px] translate-middle-x">
            {{ headerTitle }}
      </span>
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto mr-auto px-[32px]" @click.prevent="$router.go(-1)">
            <img src="/assets/img/darkMode/HeaderBack.svg"
                 alt="">
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
  props: ['headerTitle','shadow3d'],
  data() {
    return {
      sideMenu   : false,
    }
  },
  emits  : ['showMenu'],
  methods: {
    showMenu() {
      this.sideMenu = !this.sideMenu
      this.$emit('showMenu', this.sideMenu)
    }
  },
}
</script>

<style scoped lang="scss">

</style>