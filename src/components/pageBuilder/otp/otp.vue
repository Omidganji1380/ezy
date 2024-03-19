<template>
  <div ref="otpCont" dir="ltr" class="row w-100 flex-nowrap mx-auto justify-between">
    <input
        type="number" @keydown.prevent="handleKeyDown($event, ind)"
        :class="{'!text-red-600 !border-red-600':otpCodeTrue}"
        class="digit-box w-[56px] text-center fs-3 h-[56px] border-solid border-2 border-pri-color focus-visible:outline-0 leading-10 rounded-[20px] bg-sec-color text-pri-color"
        v-for="(el, ind) in digits"
        :key="el+ind"
        v-model="digits[ind]"
        :autofocus="ind===0"
        :placeholder="ind+1"
        maxlength="1"
        autocomplete="off"
        :id="'otpInput'+ind"
    >
  </div>
</template>

<script>
import {ref, reactive} from 'vue';

export default {
  name : "otp",
  props: ['otpCodeTrue'],
  data() {
    return {
      default          : '',
      digits           : reactive([]),
      digitCount       : 5,
      isInputDigitsFull: false,
      otpCode          : null,
      otpCodeIsTrue    : true,
    }
  },
  updated() {
    if (this.digits[0] === null) {
      document.getElementById('otpInput0').focus()
    }
    // console.log(this.smsCodeSent,this.otpCode,this.smsCodeSent === this.otpCode)
    // this.otpCodeIsTrue = this.smsCodeSent !== this.otpCode;
  },
  methods: {
    // otpCodeTrue(){
    //   return !!this.otpCodeTrue;
    // },
    isDigitsFull(index) {
      if (index + 1 === this.digitCount) {
        this.isInputDigitsFull = true
        this.$emit('InputDigitsFull', this.isInputDigitsFull)
        this.otpCode = this.digits.join('')
        this.otpCode = parseInt(this.otpCode)
        this.$emit('otpCode', this.otpCode)
      }
    },
    handleKeyDown(event, index) {
      this.isInputDigitsFull = false
      this.$emit('InputDigitsFull', this.isInputDigitsFull)

      if (event.key === 'Backspace') {
        this.digits[index] = null;
        var otpInputM      = document.getElementById('otpInput' + (index - 1))
        if (otpInputM) {
          otpInputM.focus()
        } else {
          this.isDigitsFull(index)
        }
        document.getElementById('otpInput' + index).value = ''
      }

      if ((new RegExp('^([0-9])$')).test(event.key)) {
        this.digits[index] = event.key;
        var otpInputP      = document.getElementById('otpInput' + (index + 1));
        if (otpInputP) {
          otpInputP.focus()
        } else {
          this.isDigitsFull(index)
        }
      }
    }
  },
  mounted() {
    for (let i = 0; i < this.digitCount; i++) {
      this.digits[i] = this.default.charAt(i)
    }
  },
}
</script>

<style scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>