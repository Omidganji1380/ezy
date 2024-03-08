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
        <span class="text-center my-3 row justify-center flex-nowrap cursor-pointer w-fit mx-auto"
              v-if="showSmsCodeForm" @click="showIntroForm">
          <img src="assets/img/PageBuilder/Login-SmsForm/Edit.svg" class="d-inline-block col-auto pr-0">
          <span class="pb-0 underline-offset-4 underline col-auto px-0">{{ phone }}</span>
        </span>
        <div class="" name="inputs">
          <input type="text" @keydown.prevent="handleInputPhoneNumber($event)" v-model="phone" dir="ltr"
                 id="phoneNumberInput" v-if="!this.showSmsCodeForm"
                 class="w-100 px-0 !pl-14 fs-3 h-[56px] border-solid border-2 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
          <div class="" name="smsCodeForm" v-if="this.showSmsCodeForm">
            <otp @InputDigitsFull="activeSubmitButton"/>
          </div>
        </div>
        <p class="subtitle my-3 max-w-fit text-truncate" v-if="!showSmsCodeForm">
          با ثبت نام و ورود
          <a href="#" class="text-[#6772E5]">
            قوانین و مقررات
          </a>
          ایزی کانکت را می‌پذیرم.</p>
        <div class="text-center mt-3">
          <button @click="showSmsCodeFormMethod" v-if="!showSmsCodeForm"
                  class="rounded-[20px] h-[56px] w-[170px] text-[#F0FCF3] bg-[#009606]">
            ثبت نام و ورود
          </button>
          <button @click="showSmsCodeFormMethod" v-if="showSmsCodeForm"
                  :class="{'!bg-[#F0FCF3] !border-[#009606] border-solid border-2 !text-[#009606]':!SubmitButton}"
                  class="rounded-[20px] h-[56px] w-[170px] text-[#F0FCF3] bg-[#009606]">
            تائید
          </button>
        </div>
        <div name="sendSmsCodeAgain" class="mx-auto my-4 row flex-nowrap w-fit" v-if="showSmsCodeForm">
          <img :class="{'d-none':!countDownTimer}" src="assets/img/PageBuilder/Login-SmsForm/timeCircle.svg"
               class="d-inline-block col-auto pr-0">
          <span class="col-auto pr-0 underline-offset-8 underline">
            ارسال مجدد کد
            {{ countDownTimer ? 'بعد از ' + countDownTimer : '' }}
          </span>
        </div>
      </div>
    </div>
  </div>
  <!-- * App Capsule -->
</template>

<script>
import otp from '@/components/pageBuilder/otp/otp.vue';
import axios from 'axios';
// import {ref} from "vue";

export default {
  name : 'Login',
  props: ['baseURL'],
  data() {
    return {
      fadedLogo      : true,
      showIntro      : true,
      showSmsCodeForm: false,
      phoneInput     : null,
      phone          : '',
      sendAgainTime  : null,
      countDownTimer : '-1 : -1',
      SubmitButton   : false,
      smsCodeSent    : null,
    }
  },
  updated() {
    // alert(this.baseURL + 'auth/' + this.phone)
  },
  components: {otp},
  methods   : {
    activeSubmitButton(bool) {
      this.SubmitButton = bool
    },
    showSmsCodeFormMethod() {
      axios({
              method: 'get',
              url   : this.baseURL + 'auth/' + this.phone,
              // data  : {
              //   phone: this.phone
              // }
            })
          .then(res => {
            if (res.data.status === 200) {
              if (this.countDownTimer === '-1 : -1' && !this.showSmsCodeForm) {
                this.sendAgainTime = res.data.sendAgainTime
                this.smsCodeSent = res.data.smsCodeSent
                this.countDownSmsCode()
              }
              this.phone = this.phone.replace(/\s/g, '')
              if (!this.showSmsCodeForm) {
                this.showSmsCodeForm = true;
                this.phoneInput.destroy()
              }
            }
          })
          .catch(err => console.log(err))
    },
    showIntroForm() {
      this.showSmsCodeForm = false;
      setTimeout(() => {
        this.intlTelInput()
      }, 100)
    },
    intlTelInput() {
      const phoneInputField = document.querySelector("#phoneNumberInput");
      this.phoneInput       = window.intlTelInput(phoneInputField, {
        showSelectedDialCode : false,
        autoInsertDialCode   : false,
        formatOnDisplay      : false,
        placeholderNumberType: 'MOBILE',
        useFullscreenPopup   : true,
        initialCountry       : "ir",
        utilsScript          : "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js"

      },);
    },
    countDownSmsCode() {
      this.countDownTimer = '';
      var countDownDate   = new Date().getTime() + (this.sendAgainTime);
      var x               = setInterval(() => {
        var now             = new Date().getTime();
        var distance        = countDownDate - now;
        var minutes         = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds         = Math.floor((distance % (1000 * 60)) / 1000);
        this.countDownTimer = seconds + " : " + minutes;
        if (distance < 0) {
          clearInterval(x);
          this.countDownTimer = false
        }
      })
    },
    handleInputPhoneNumber(event) {
      if (event.key === 'Backspace') {
        this.phone = this.phone.slice(0, -1);
      }
      if ((new RegExp('^([0-9])$')).test(event.key)) {
        this.phone += event.key;
      }
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

.iti__country.iti__standard {
  justify-content: space-between;
}

.iti.iti--container.iti--country-search.iti--fullscreen-popup {
  padding: 70px 10px;
}
</style>