<template>
  <div class="h-[100vh] w-[430px] bg-gradient-to-br from-[#009606] to-[#009E28] fixed pr-[25px]" dir="rtl">
    <span class="border-1 w-[50px] h-[50px] bg-[#62df85] mb-[55px] d-block sticky right-[25px] top-[47px] rounded-circle">
      <img src="" alt="">
    </span>
    <span class="sticky text-white font-shabnam-medium-fd text-[22px] right-[25px]">امید</span>
    <br>
    <span class="sticky text-white font-shabnam-medium-fd text-[22px] right-[25px]">برنامه نویس</span>
    <br>
    <button class="sticky whitespace-nowrap right-[25px] my-[25px] text-[14px] h-[26px] w-[124.5px] border-1 rounded-pill text-white">
      ویرایش پروفایل
      <img src="/assets/img/PageBuilder/profile-edit-pen.svg" class="d-inline-block" alt="">
    </button>
    <br>
    <span class="hr bg-gradient-to-l from-[#ffffff] to-[#ffffff00]"></span>
    <ul class="text-white sticky right-[25px] d-inline-block text-[16px]">
      <li>
        <img src="/assets/img/PageBuilder/sidebar-wallet.svg" alt="">
        کیف پول
      </li>
      <li>
        <img src="/assets/img/PageBuilder/sidebar-learning.svg" alt="">
        آموزش
      </li>
    </ul>
    <span class="hr bg-gradient-to-l from-[#ffffff] to-[#ffffff00]"></span>
    <ul class="text-white sticky right-[25px] d-inline-block text-[16px]">
      <li>
        <img src="/assets/img/PageBuilder/sidebar-wallet.svg" alt="">
        کیف پول
      </li>
      <li>
        <img src="/assets/img/PageBuilder/sidebar-learning.svg" alt="">
        آموزش
      </li><li>
      <button @click.prevent="logoutMethod" class="btn btn-danger">exit</button>
    </li>
    </ul>
  </div>

</template>

<script>
import axios from "axios";

export default {
  name: "SideMenu",
  props     : ['baseURL'],
  methods: {
    logoutMethod() {

      let token = localStorage.getItem('token')
      token     = JSON.parse(token)
      // console.log(token.id)
      axios({
              method : 'POST',
              url    : this.baseURL + 'api/v1/auth/logout',
              data   : {
                id: token.id
              },
              headers: {
                'Content-Type'                    : 'application/json',
                'Access-Control-Allow-Credentials': true,
              }
            })
          .then((res) => {
            console.log(res)
            if (res.data.status === 200) {
              this.$router.push('/')
              localStorage.removeItem('token')
            }
          })
          .catch(err => console.log(err))
    }
  },
}
</script>

<style scoped>
.hr{
  margin: 12px 0;
  position: sticky;
  right: 25px;
  display: block;
  height: 1px;
  width: 266px;
  //background-color: red;
}
ul li{
  display: flex;
  gap: 12px;
  margin-bottom: 10px;
}
</style>