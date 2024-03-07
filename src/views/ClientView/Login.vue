<template>
  <!-- App Capsule -->
  <div id="appCapsule" class="container">
    <img src="assets/img/logo.svg" :class="{'fade':fadedLogo}" v-if="!fadedLogo"
         class="left-1/2 position-absolute top-1/2 -translate-x-1/2 -translate-y-1/2">
    <div class="intro fade" dir="rtl" :class="{'show':showIntro}">
      <div class="header-large-title">
        <p class="title mb-4 max-w-fit text-truncate">به <span class="text-[#009606]">ایزی کانکت</span> خوش اومدی</p>
        <p class="subtitle mb-3 max-w-fit text-truncate" v-if="!showSmsCodeForm">برای ورود به اپلیکیشن، شماره موبایلت را
          وارد کن.</p>
        <p class="subtitle mb-3 max-w-fit text-truncate" v-else>کد 5 رقمی ارسال شده به شماره زیر را وارد کن.</p>
      </div>
      <div class="section mt-3 mb-3">
        <div class="text-center my-3 row justify-center flex-nowrap" v-if="showSmsCodeForm">
          <img src="assets/img/PageBuilder/Login-SmsForm/Edit.svg" class="d-inline-block col-auto pr-0">
          <span class="border-b-[1px] pb-0 border-[#101010] col-auto px-0">09389497958</span>
        </div>
        <input type="text" placeholder="" dir="ltr" id="phoneNumberInput"
               class="w-100 px-0 !pl-24 fs-3 h-[56px] border-solid border-2 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
        <p class="subtitle my-3 max-w-fit text-truncate" v-if="!showSmsCodeForm">
          با ثبت نام و ورود
          <a href="#" class="text-[#6772E5]">
            قوانین و مقررات
          </a>
          ایزی کانکت را می‌پذیرم.</p>
        <div class="text-center mt-3">
          <button @click="showSmsCodeFormMethod"
                  class="btn rounded-[20px] transition ease-in-out duration-500 hover:text-black hover:bg-[#00a807] h-[56px] w-[170px] text-[#F0FCF3] bg-[#009606]">
            ثبت نام و ورود
          </button>
        </div>

      </div>
    </div>
  </div>
  <!-- * App Capsule -->
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      fadedLogo      : true,
      showIntro      : true,
      showSmsCodeForm: false,
      phoneInput     : null,
    }
  },
  components: {},
  methods   : {
    showSmsCodeFormMethod() {
      this.showSmsCodeForm = !this.showSmsCodeForm;
      if (this.showSmsCodeForm) {
        this.phoneInput.destroy()
      } else {
        this.intlTelInput()
      }
    },
    intlTelInput() {
      const phoneInputField = document.querySelector("#phoneNumberInput");
      this.phoneInput       = window.intlTelInput(phoneInputField, {
        showSelectedDialCode : true,
        autoInsertDialCode   : false,
        formatOnDisplay      : false,
        placeholderNumberType: 'MOBILE',
        useFullscreenPopup   : false,
        initialCountry       : "ir",
        // customPlaceholder: function (selectedCountryPlaceholder, selectedCountryData) {
        //   return "e.g. " + selectedCountryPlaceholder;
        // },
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js"

      },);
    },
  },
  mounted() {
    // setTimeout(() => {
    //   setTimeout(() => {
    //     this.showIntro = true
    //   }, 100)
    //   this.fadedLogo = true
    // }, 1500)
    this.intlTelInput()

  },
}
</script>

<style>
.iti.iti--allow-dropdown {
  width: 100% !important;
}

.iti__flag-container {
  direction: ltr;
  left: 0 !important;
}

.iti--allow-dropdown .iti__flag-container .iti__selected-flag {
  background-color: unset;
}

.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
  background-color: unset;
}

.iti__arrow {
  margin: 0 10px !important;
  display: none !important;
}

.iti__flag {
  scale: 1.5;
  margin-left: 5px;
}

.iti__selected-flag {
  width: min-content;
}

.iti__selected-dial-code {
  margin-left: 15px !important;
  font-size: 20px;
}
</style>