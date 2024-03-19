<template>
  <Fa v-if="lang==='fa'"/>
  <En v-if="lang==='en'"/>
</template>

<script>
import Fa from "@/components/Login/Fa.vue";
import En from "@/components/Login/En.vue";
import {useStorage} from "@vueuse/core";

export default {
  name:'Login',
  components: {
    Fa,En
  },
  data() {
    return {
      lang: useStorage('lang').value
    }
  },
  props: ['baseURL', 'lang'],
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
  width: 20px !important;
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