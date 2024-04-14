<template>
  <div class="header bg-sec-color h-[54px] content-center rounded-b-[8px]" dir="rtl">
    <div class="row relative mx-auto justify-between flex-nowrap">
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto px-[32px] self-center">
            <img src="/assets/img/darkMode/sidebarHambergery.svg" alt="">
          </span>
        </div>
      </div>
      <span class="col-auto p-0 text-[20px] absolute left-1/2 -top-[3px] translate-middle-x">
            {{ $t('DigitalMenu.Index.Header') }}
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
  <div class="mainContent">
    <div class="noContent -z-10 text-center absolute left-1/2 top-1/2 translate-middle">
      <img src="/assets/img/digitalMenu/no-content-digital-menu.svg" class="mb-[50px] mx-auto" alt="">
      <span class="text-[20px]">
        {{ $t('DigitalMenu.Index.noContent') }}
      </span>
    </div>
  </div>
  <div class="bottomAddButton mx-[24px] mb-[50px] top-100 sticky">
    <button :dir="$i18n.locale==='fa'?'rtl':''" class="row justify-center bg-pri-color text-sec-color h-[55px] text-[20px] w-full rounded-full">
      <span class="col-auto px-[5px] self-center">
      <img src="/assets/img/digitalMenu/create-menu-plus.svg" alt="">
      </span>
      <span class="col-auto px-0 self-center font-shabnam-medium">
      {{ $t('DigitalMenu.Index.AddMenuButton') }}
        </span>
    </button>
  </div>
</template>

<script>
export default {
  name: "DigitalMenuIndex"
}
</script>

<style scoped>

</style>