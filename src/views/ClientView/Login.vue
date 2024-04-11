<template>
  <!--  <Fa v-if="lang==='fa'"/>-->
  <!--  <En v-if="lang==='en'"/>-->
  <div id="appCapsule" class="container p-0 dark-mode">
    <img src="/assets/img/logo.svg" :class="{'fade':fadedLogo}" v-if="!fadedLogo"
         class="left-1/2 position-absolute top-1/2 -translate-x-1/2 -translate-y-1/2" alt="">
    <div class="intro fade" :dir="$i18n.locale==='fa'?'ltr':'rtl'" :class="{'show':showIntro}">
      <div class="header-large-title p-0">
        <div
            class="row px-[10px] mx-auto bg-sec-color rounded-b-[8px] flex-nowrap flex-row-reverse h-[54px]">
          <span :class="{'!mr-0 ml-auto':$i18n.locale==='fa'}"
              class="col-auto p-0 mr-auto whitespace-nowrap truncate text-[calc(24px+0.01vw)] self-center text-[#d8d8d8]">
            {{ $t('LoginView.header.header1') }}
            <span class="text-pri-color">
              {{ $t('LoginView.header.header2') }}
            </span>
            <span v-if="$i18n.locale==='fa'">
              {{ $t('LoginView.header.header3') }}
            </span>
          </span>
          <span class="col-auto px-[18px] self-center">
            <img src="/assets/img/PageBuilder/Login-SmsForm/darkMode.svg"
                 alt="">
          </span>
          <span class="col-auto p-0 self-center">
            <img src="/assets/img/PageBuilder/Login-SmsForm/en-to-fa.svg" v-if="$i18n.locale==='en'"
                 @click.prevent="enToFa"
                 alt="">
            <img src="/assets/img/PageBuilder/Login-SmsForm/en-to-fa.svg" v-if="$i18n.locale==='fa'"
                 @click.prevent="faToEn"
                 alt="">
          </span>
        </div>
      </div>
      <div class="section mt-[55px] mb-3 px-[32px]">
        <div class="p-0 m-0 !mb-[24px]" :dir="$i18n.locale!=='fa'?'ltr':'rtl'">
          <p class="subtitle !text-d8 !text-[calc(14px+0.01vw)] max-w-fit text-truncate" v-if="!showSmsCodeForm">
            {{ $t('LoginView.enterYourPhone') }}
          </p>
          <p class="subtitle !text-d8 !text-[calc(14px+0.01vw)] max-w-fit text-truncate" v-else>
            {{ $t('LoginView.enterDigits') }}
          </p>
        </div>
        <span class="text-center my-3 row justify-center flex-nowrap cursor-pointer w-fit mx-auto"
              v-if="showSmsCodeForm" @click="showIntroForm">
          <img src="/assets/img/PageBuilder/Login-SmsForm/Edit.svg" class="d-inline-block col-auto pr-0" alt="">
          <span class="pb-0 underline-offset-4 underline col-auto px-0 d-ltr">{{ dialCode }} {{ data.phone }}</span>
        </span>
        <div class=" font-shabnam-fd" name="inputs">
          <input type="text" @keydown.prevent="handleInputPhoneNumber($event)" v-model="data.phone" dir="ltr"
                 id="phoneNumberInput" v-if="!this.showSmsCodeForm" :class="{'font-shabnam-fd':$i18n.locale==='fa'}"
                 class="w-100 text-[20px] px-0 !pl-[100px] h-[56px] focus-visible:outline-0 rounded-[8px] bg-sec-color text-d8">
          <div class="" name="smsCodeForm" v-if="this.showSmsCodeForm">
            <otp @InputDigitsFull="activeSubmitButton" @otpCode="loginByOtp" :otpCodeTrue="otpCodeTrue"/>
          </div>
        </div>
        <p class="subtitle my-3 text-[calc(0.5em+0.8vw)] text-d8" :dir="$i18n.locale!=='fa'?'ltr':'rtl'" v-if="!showSmsCodeForm">
          {{ $t('LoginView.rules.rule1') }}
          <a href="#" class="text-pri-color hover:text-pri-color">
            {{ $t('LoginView.rules.rule2') }}
          </a>
          <span v-if="$i18n.locale==='fa'">
              {{ $t('LoginView.rules.rule3') }}
            </span>
        </p>
        <div class="text-center mt-3">
          <button @click.prevent="showSmsCodeFormMethod" v-if="!showSmsCodeForm"
                  class="rounded-[20px] <!--py-[18.6px] px-[43.5px]--> h-[56px] w-[170px] text-sec-color bg-pri-color">
            {{ $t('LoginView.registerButton') }}
          </button>
          <button @click.prevent="loginByOtp" v-if="showSmsCodeForm"
                  :class="{'!bg-sec-color !border-pri-color border-solid border-2 !text-pri-color':!SubmitButton}"
                  class="rounded-[20px] h-[56px] w-[170px] text-sec-color bg-pri-color">
            {{ $t('LoginView.submitButton') }}
          </button>
        </div>
        <div name="sendSmsCodeAgain" class="mx-auto my-4 row flex-nowrap w-fit" v-if="showSmsCodeForm">
          <img :class="{'d-none':!countDownTimer}" src="/assets/img/PageBuilder/Login-SmsForm/timeCircle.svg"
               class="d-inline-block col-auto pr-0" alt="">
          <span class="col-auto pr-0 underline-offset-8 underline" @click="otpSendAgain">
            {{ $t('LoginView.resentCode') }}
            {{ countDownTimer ? $t('LoginView.countDown') + countDownTimer : '' }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useStorage} from "@vueuse/core";
import LoadingSpinner from "@/components/pageBuilder/Loading/LoadingSpinner.vue";
import loadingSpinner from "@/components/pageBuilder/Loading/LoadingSpinner.vue";
import otp from "@/components/pageBuilder/otp/otp.vue";
import axios from "axios";

export default {
  name      : 'Login',
  components: {
    otp,
    LoadingSpinner,
  },
  data() {
    return {
      lang           : useStorage('lang').value,
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
      otpCodeTrue    : false,
      dialCode       : null,
    }
  },
  methods: {
    enToFa() {
      localStorage.removeItem('lang')
      // this.$router.go(this.$router.currentRoute)
      this.$i18n.locale = 'fa';
      useStorage('lang', this.$i18n.locale)

    },
    faToEn() {
      localStorage.removeItem('lang')
      // useStorage('lang', 'fa')
      // this.$router.go(this.$router.currentRoute)
      this.$i18n.locale = 'en';
      useStorage('lang', this.$i18n.locale)

    },
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
                url    : 'v1/auth/login',
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
      var phone     = this.dialCode + this.data.phone;
      phone         = this.data.phone.replace(/\s/g, '')
      axios({
              url    : "v1/auth/p",
              method : 'POST',
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
        formatOnDisplay      : true,
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
      var arrow     = document.querySelector('.iti__selected-flag')
      var dial_code = document.querySelector('.iti__selected-dial-code')
      arrow.lastChild.remove()
      dial_code.innerHTML=' '
      // dial_code.classList.add('font-shabnam-fd')
    }
  },

  mounted() {
    // console.log(this.$i18n.locale)
    this.$i18n.locale = this.lang
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
  //border-right: 1px solid #ddd !important;
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
  width: 20px !important;
  height: unset !important;
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
  //padding-left: 3px;
  margin: 0 !important;
  color: #009606;
  height: 44px;
  //display: none;
}

.iti__country.iti__standard {
  justify-content: space-between;
}

.iti.iti--container.iti--country-search.iti--fullscreen-popup {
  padding: 70px 10px;
}
</style>