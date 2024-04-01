<template>
  <div id="sideMenu" class="h-[100vh] w-[429px] bg-gradient-to-br from-pri-color to-[#009E28] fixed pr-[25px]" dir="rtl">
    <span
        class="border-1 w-[50px] h-[50px] bg-[#62df85] mb-[55px] d-block sticky right-[25px] top-[47px] rounded-circle">
      <img src="" alt="">
    </span>
    <span class="sticky text-white font-shabnam-medium-fd text-[22px] right-[25px]">امید</span>
    <br>
    <span class="sticky text-white font-shabnam-medium-fd text-[22px] right-[25px]">برنامه نویس</span>
    <br>
    <button
        class="sticky whitespace-nowrap right-[25px] my-[25px] text-[14px] h-[26px] w-[124.5px] border-1 rounded-pill text-white">
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
        <img src="/assets/img/PageBuilder/sidebar-language.svg" alt="">
        زبان
      </li>
      <li>
        <img src="/assets/img/PageBuilder/sidebar-faq.svg" alt="">
        سوالات متداول
      </li>
      <li>
        <img src="/assets/img/PageBuilder/sidebar-blog.svg" alt="">
        بلاگ
      </li>
      <li>
        <img src="/assets/img/PageBuilder/sidebar-support.svg" alt="">
        پشتیبانی
      </li>
      <li>
        <img src="/assets/img/PageBuilder/sidebar-contactUs.svg" alt="">
        ارتباط با ما
      </li>
      <li>
        <img src="/assets/img/PageBuilder/diamond.svg" alt="">
        حساب تجاری
      </li>

    </ul>
    <span class="hr bg-gradient-to-l from-[#ffffff] to-[#ffffff00]"></span>
    <ul class="text-white sticky right-[25px] d-inline-block text-[16px]">
      <li @click.prevent="logoutMethod">
        <img src="/assets/img/PageBuilder/sidebar-exit.svg" alt="">
        خروج
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name   : "SideMenu",
  methods: {
    logoutMethod() {

      let token = localStorage.getItem('token')
      token     = JSON.parse(token)
      // console.log(token.id)
      axios({
              method : 'POST',
              url    :  'v1/auth/logout',
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
.hr {
  margin: 12px 0;
  position: sticky;
  right: 25px;
  display: block;
  height: 1px;
  width: 266px;
//background-color: red;
}

ul li {
  display: flex;
  gap: 12px;
  margin-bottom: 10px;
}
.show-menu {
  transform: scale(0.8) translate(20%, -60%) !important;
  overflow: auto;
  pointer-events: none;
  transition: all ease-in-out 250ms !important;
  height: 80vh !important;
  padding-bottom: 0 !important;
  box-shadow: 0 0 30px 0 !important;
}
.sideMenu{
  transform: scale(1) translate(0) !important;
  transition: all ease-in-out 250ms;
}
#sideMenu{
  transform: scale(0) translate(-50%);
  transition: all ease-in-out 250ms;
}
</style>