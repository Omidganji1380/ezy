<template>
    <div class="backImg relative">
      <img src="/assets/img/demoRect.jpg" class="w-full max-h-[200px] object-cover" alt="">
<!--      <div class="absolute left-1/2 translate-middle-x top-[calc(75%/1.1)] w-[calc(25%*1.3)] h-[calc(53.5%*1.3)] bg-white rounded-circle"></div>-->
      <img src="/assets/img/previewPageBuilder/backProfileCurve.png" class="absolute bottom-0" alt="">
      <img src="/assets/img/PageBuilder/demoImg.png" class="absolute left-1/2 translate-middle-x top-[75%] w-[25%] h-[53.5%] object-contain" alt="">
    </div>
</template>

<script>
import axios from "axios";

export default {
  name : "Preview",
  props: {
    link: ''
  },
  data() {
    return {
      profile: null,
      blocks : [],
    }
  },
  methods: {
    j_stringify($json) {
     return JSON.stringify($json)
    }
  },
  mounted() {
    axios({
            method: 'post',
            url   : 'v1/dashboard/getView',
            data  : {
              link: this.link
            }
          })
        .then(res => {
          this.profile = this.j_stringify(res.data.profile)
          this.blocks  = this.j_stringify(res.data.blocks)
          // console.log(this.profile)
          // console.log(this.blocks)
        })
        .catch(err => console.log(err))
  },
}
</script>

<style>
body{
  background-color: white !important;
}
</style>