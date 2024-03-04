<template>
  <!-- App Capsule -->
  <div id="appCapsule" class="container">
    <img src="assets/img/logo.svg" :class="{'fade':fadedLogo}"
         class="left-1/2 position-absolute top-1/2 -translate-x-1/2 -translate-y-1/2">
    <div class="intro fade" dir="rtl" :class="{'show':showIntro}">
      <div class="header-large-title">
        <p class="title mb-4 max-w-fit text-truncate">به <span class="text-[#009606]">ایزی کانکت</span> خوش اومدی</p>
        <p class="subtitle mb-3 max-w-fit text-truncate">برای ورود به اپلیکیشن، شماره موبایلت را وارد کن.</p>
      </div>
      <div class="section mt-3 mb-3">
        <input type="text"
               class="w-100 border-solid border-2 border-[#009606] focus-visible:outline-0 leading-10 text-center rounded-[10px] bg-[#F0FCF3] text-[#009606]">
        <p class="subtitle mb-3 max-w-fit text-truncate">با ثبت نام و ورود <a href="#" class="text-[#6772E5]">قوانین و مقررات</a> ایزی کانکت را
          می‌پذیرم.</p>
        <div class="text-center">
          <button class="btn text-[#F0FCF3] bg-[#009606]">ثبت نام و ورود</button>
        </div>

      </div>
    </div>
  </div>
  <!-- * App Capsule -->
</template>

<script>
export default {
  name: 'Index',
  data() {
    return {
      fadedLogo: false,
      showIntro: false
    }
  },
  components: {},
  methods   : {},
  mounted() {
    setTimeout(() => {
    setTimeout(() => {
      this.showIntro = true
    }, 500)
      this.fadedLogo = true
    }, 1500)
  },

}
</script>
