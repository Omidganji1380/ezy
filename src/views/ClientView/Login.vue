<template>
  <!-- App Capsule -->
  <div id="appCapsule" class="container d-ltr">
    <img src="/assets/img/logo.svg" :class="{'fade':fadedLogo}" v-if="!fadedLogo"
         class="left-1/2 position-absolute top-1/2 -translate-x-1/2 -translate-y-1/2" alt="">
    <div class="intro fade" dir="rtl" :class="{'show':showIntro}">
      <div class="header-large-title">
        <div class="row flex-nowrap justify-between">
          <span class="col-auto mb-4  whitespace-nowrap truncate  text-[calc(1.3em+1vw)]">به <span
              class="text-[#009606]">ایزی کانکت</span> خوش اومدی</span>
          <span class="col-auto left-0">
            <img src="/assets/img/PageBuilder/Login-SmsForm/fa-to-en.svg" alt="">
          </span>
        </div>
        <p class="subtitle mb-3 max-w-fit text-truncate" v-if="!showSmsCodeForm">برای ورود به اپلیکیشن، شماره موبایلت را
          وارد کن.</p>
        <p class="subtitle mb-3 max-w-fit text-truncate" v-else>کد 5 رقمی ارسال شده به شماره زیر را وارد کن.</p>
      </div>
      <div class="section mt-3 mb-3">
        <span class="text-center my-3 row justify-center flex-nowrap cursor-pointer w-fit mx-auto"
              v-if="showSmsCodeForm" @click="showIntroForm">
          <img src="/assets/img/PageBuilder/Login-SmsForm/Edit.svg" class="d-inline-block col-auto pr-0" alt="">
          <span class="pb-0 underline-offset-4 underline col-auto px-0 d-ltr">{{ dialCode }} {{ data.phone }}</span>
        </span>
        <div class="" name="inputs">
          <input type="text" @keydown.prevent="handleInputPhoneNumber($event)" v-model="data.phone" dir="ltr"
                 id="phoneNumberInput" v-if="!this.showSmsCodeForm"
                 class="w-100 text-[20px] px-0 !pl-[135px] h-[56px] border-solid border-2 border-[#009606] focus-visible:outline-0 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
          <div class="" name="smsCodeForm" v-if="this.showSmsCodeForm">
            <otp @InputDigitsFull="activeSubmitButton" @otpCode="loginByOtp" :otpCodeTrue="otpCodeTrue"/>
          </div>
        </div>
        <p class="subtitle my-3 max-w-fit text-truncate" v-if="!showSmsCodeForm">
          با ثبت نام و ورود
          <a href="#" class="text-[#6772E5]">
            قوانین و مقررات
          </a>
          ایزی کانکت را می‌پذیرم.</p>
        <div class="text-center mt-3">
          <button @click.prevent="showSmsCodeFormMethod" v-if="!showSmsCodeForm"
                  class="rounded-[20px] h-[56px] w-[170px] text-[#F0FCF3] bg-[#009606]">
            ثبت نام و ورود
          </button>
          <button @click.prevent="loginByOtp" v-if="showSmsCodeForm"
                  :class="{'!bg-[#F0FCF3] !border-[#009606] border-solid border-2 !text-[#009606]':!SubmitButton}"
                  class="rounded-[20px] h-[56px] w-[170px] text-[#F0FCF3] bg-[#009606]">
            تائید
          </button>
        </div>
        <div name="sendSmsCodeAgain" class="mx-auto my-4 row flex-nowrap w-fit" v-if="showSmsCodeForm">
          <img :class="{'d-none':!countDownTimer}" src="/assets/img/PageBuilder/Login-SmsForm/timeCircle.svg"
               class="d-inline-block col-auto pr-0" alt="">
          <span class="col-auto pr-0 underline-offset-8 underline" @click="otpSendAgain">
            ارسال مجدد کد
            {{ countDownTimer ? 'بعد از ' + countDownTimer : '' }}
          </span>
        </div>
      </div>
    </div>
  </div>
  <!-- * App Capsule -->
  <!--  <span id="arrowFlag" class="d-none">-->
  <!--    <img src="/assets/img/PageBuilder/Login-SmsForm/arrow-select-national.svg" alt="">-->
  <!--  </span>-->
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
      data           : {
        phone      : '',
        device_name: 'browser',
      },
      sendAgainTime  : 0,
      countDownTimer : '',
      SubmitButton   : false,
      smsCodeSent    : null,
      x              : null,
      otpCodeTrue    : true,
      dialCode       : null,
    }
  },
  updated() {
    // alert(this.baseURL + 'auth/' + this.data.phone)

  },
  components: {otp},
  methods   : {
    otpSendAgain() {
      if (!this.countDownTimer) {
        this.showSmsCodeFormMethod()
      }
    },
    loginByOtp(otpCode) {
      // console.log(this.smsCodeSent !== otpCode)
      if (this.smsCodeSent !== otpCode) {
        this.otpCodeTrue = true;
      } else {
        this.otpCodeTrue = false;
        axios({
                url    : this.baseURL + 'api/v1/auth/login',
                method : 'post',
                headers: {
                  'Content-Type'                    : 'application/json',
                  'Access-Control-Allow-Credentials': true,
                },
                data   : {
                  smsCode: otpCode,
                  phone  : this.data.phone
                }
              })
            .then((res) => {
              console.log(res.data.currentUser)
              localStorage.removeItem('token')
              localStorage.setItem('token', JSON.stringify(res.data.currentUser))
              this.$router.push('/user/page-builder')
            })
            .catch((err) => {
              console.log(err)
            })
      }
    },
    activeSubmitButton(bool) {
      this.SubmitButton = bool
    },
    showSmsCodeFormMethod: function () {
      this.dialCode = document.querySelector('.iti__selected-dial-code').innerHTML
      var phone = this.dialCode + this.data.phone;
      phone     = this.data.phone.replace(/\s/g, '')
      console.log(this.data.phone)
      axios({
              url    : this.baseURL + "api/v1/auth/p/" + this.data.phone,
              method : 'GET',
              headers: {
                'Content-Type': 'application/json',
                // 'Access-Control-Allow-Credentials': true,
              },
              data   : {
                phone: phone
              }
            })
          .then((res) => {
            // console.log(res, res.data)
            if (res.data.status === 200) {
              this.countDownTimer = '';
              this.sendAgainTime  = 0
              this.smsCodeSent    = null
              this.x              = clearInterval(this.x)
              this.sendAgainTime  = res.data.sendAgainTime
              this.smsCodeSent    = res.data.smsCodeSent
              console.log(this.smsCodeSent)
              this.countDownSmsCode()
              this.data.phone = this.data.phone.replace(/\s/g, '')
              if (!this.showSmsCodeForm) {
                this.showSmsCodeForm = true;
                this.phoneInput.destroy()
              }
            } else {
              console.log("Error: " + res.data.message);
            }
          })
          .catch((error) => {
            console.log("error :>> ", error);
          });
    },
    showIntroForm() {
      this.showSmsCodeForm = false;
      setTimeout(() => {
        this.intlTelInput()
        this.addArrow()
      }, 10)
    },
    intlTelInput() {
      const phoneInputField = document.querySelector("#phoneNumberInput");
      this.phoneInput       = window.intlTelInput(phoneInputField, {
        showSelectedDialCode : true,
        autoInsertDialCode   : false,
        formatOnDisplay      : false,
        placeholderNumberType: 'MOBILE',
        nationalMode         : false,
        useFullscreenPopup   : true,
        initialCountry       : "ir",
        utilsScript          : "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js"

      },);
    },
    countDownSmsCode() {
      var countDownDate = new Date().getTime() + (this.sendAgainTime * 1000);

      this.x = setInterval(() => {
        var now             = new Date().getTime();
        var distance        = countDownDate - now;
        var minutes         = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds         = Math.floor((distance % (1000 * 60)) / 1000);
        this.countDownTimer = seconds + " : " + minutes;
        if (distance < 0) {
          clearInterval(this.x);
          this.countDownTimer = false
        }
      }, 1000)
    },
    handleInputPhoneNumber(event) {
      if (event.key === 'Backspace') {
        this.data.phone = this.data.phone.slice(0, -1);
      }
      if (event.key === 'Enter') {
        this.showSmsCodeFormMethod();
      }
      if ((new RegExp('^([0-9])$')).test(event.key)) {
        this.data.phone += event.key;
      }
    },
    addArrow() {
      var el       = document.createElement('div')
      el.className = 'iti__arrow'
      el.innerHTML = "<img src=\"/assets/img/PageBuilder/Login-SmsForm/arrow-select-national.svg\" alt=\"\">"
      var flag     = document.querySelector('.iti__flag')

      flag.parentNode.insertBefore(el, flag.nextSibling);
      var arrow = document.querySelector('.iti__selected-flag')
      arrow.lastChild.remove()
    }
  },

  mounted() {
    setTimeout(() => {
      setTimeout(() => {
        this.showIntro = true
      }, 100)
      this.fadedLogo = true
    }, 1500)
    this.intlTelInput()

    this.addArrow()

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
  margin-left: 14.34px !important;
  margin-right: 9px !important;
  border-left: unset !important;
  border-right: unset !important;
  border-top: unset !important;
  width: 20px;
  height: unset;
}

.iti__flag {
  scale: 1.5;
  margin-left: 5px;
  border-radius: 3.68px;
}

.iti__selected-flag {
  width: min-content;
}

.iti__selected-dial-code {
  font-size: 20px !important;
  border-left: 1px solid #ddd !important;
  padding-left: 3px;
  color: #009606;
}

.iti__country.iti__standard {
  justify-content: space-between;
}

.iti.iti--container.iti--country-search.iti--fullscreen-popup {
  padding: 70px 10px;
}
</style>