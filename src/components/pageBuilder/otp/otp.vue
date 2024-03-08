<template>
  <div ref="otpCont" dir="ltr" class="row w-100 flex-nowrap mx-auto justify-between">
    <input
        type="text" @keydown.prevent="handleKeyDown($event, ind)"
        class="digit-box w-[56px] text-center fs-3 h-[56px] border-solid border-2 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]"
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
  name: "otp",
  data() {
    return {
      default   : '',
      digits    : reactive([]),
      digitCount: 5,
    }
  },
  updated() {
    if (this.digits[0] === null) {
      document.getElementById('otpInput0').focus()
    }
  },
  methods: {
    handleKeyDown(event, index) {
      if (event.key === 'Backspace') {
        this.digits[index] = null;
        document.getElementById('otpInput' + (index - 1)).focus()
        document.getElementById('otpInput' + index).value = ''
      }
      if ((new RegExp('^([0-9])$')).test(event.key)) {
        this.digits[index] = event.key;
        document.getElementById('otpInput' + (index + 1)).focus()
      }
    }
  },
  mounted() {
    if (this.default && this.default.length === this.digitCount) {
      for (let i = 0; i < this.digitCount; i++) {
        this.digits[i] = this.default.charAt(i)
      }
    } else {
      for (let i = 0; i < this.digitCount; i++) {
        this.digits[i] = null;
      }
    }
  },
}
</script>

<style scoped>

</style>