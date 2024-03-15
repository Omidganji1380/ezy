<template>
  <div id="appCapsule" class="h-[100vh] relative !pt-[29px]">
    <div class="px-[34px] header-large-title row flex-nowrap justify-content-between border-b-2 pb-1 flex-row-reverse">
      <span class="p-0 title fs-3 col-auto self-center">
        <img src="/assets/img/PageBuilder/sidebarHambergery.png" alt="">
      </span>
      <span class="p-0 title fs-3 col-auto self-center font-shabnam-bold">
        صفحه ساز ایزی
      </span>
      <span class="p-0 title fs-3 col-auto self-center">
        <img src="/assets/img/PageBuilder/headerEzyLogo.png" alt="">
      </span>
    </div>
    <div class="section mt-[46px] mb-3">
      <img src="/assets/img/PageBuilder/nothing.svg" class="mx-auto" alt="">
      <p class="text-center fs-4 my-4 font-shabnam-bold">هنوز صفحه ای ایجاد نکردی</p>
    </div>
    <div class="section mt-3 mb-3 d-none">
      <div class="row">
        <div class="col-12 mb-2">
          <div class="card px-4">
            <div class="card-header">
              <div class="bg-gray-100 mx-0 overflow-hidden flex-nowrap px-2 py-2 rounded row">
                <i class="self-center col-auto px-1 fa fa-copy"></i>
                <i class="self-center col-auto px-1 fa fa-share-alt"></i>
                <span class="self-center col-auto px-0">|</span>
                <span class="self-center px-1 col-auto text-truncate">ezy.company/omidganji1380</span>
              </div>
            </div>
            <div class="card-body">
              <div class="rounded border-1 row justify-content-end p-4">
                <div class="col-10 text-right">
                  <!--                  <img src="assets/img/PageBuilder/userGray.png" alt="">-->
                  omid
                </div>
                <div class="col-2">
                  <img src="/assets/img/PageBuilder/userGray.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--    <button class="btn btn-danger" @click.prevent="logoutMethod">logout</button>-->
    <div class="fixed-bottom container pb-[34px] bg-[#F9F9F9] max-w-[430px]">
      <div class="section my-3 px-0 font-shabnam-bold">
        <button class="btn bg-[#009606] text-white w-100" @click.prevent="toggleCreateModal">
          ساخت صفحه
          <img src="/assets/img/PageBuilder/createPagePlus.svg" alt="" class="ml-1">
        </button>
      </div>
      <div class="bg-[#62DF85] rounded-full">
        <div class="row h-[56px] flex-nowrap">
          <button class="btn h-[57px] bg-[#F0FCF3] col-5 drop-shadow-md rounded-r-[250rem] rounded-l-full">
            <img src="/assets/img/PageBuilder/shopping-cart.svg" alt="">
          </button>
          <button class="btn h-[57px] col-2 px-0">
            <img src="/assets/img/PageBuilder/Category-insertBtn.svg" alt="">
          </button>
          <button class="btn h-[57px] bg-[#F0FCF3] col-5 drop-shadow-md rounded-l-[250rem] rounded-r-full">
            <img src="/assets/img/PageBuilder/ProfileIcon.svg" alt="">
          </button>
        </div>
      </div>
    </div>

    <div v-show="createModal"
        class="absolute px-2 top-0 bottom-0 bg-[#000] bg-opacity-10 translate-middle-x w-[100vw] left-1/2 z-[2000] backdrop-blur-sm">
      <div class="bg-white mx-auto max-w-[430px] h-[318px] top-1/2 relative translate-middle-y rounded-[20px] z-[2001]">
        <span class="absolute top-[16.5px] right-[25.5px]" @click.prevent="toggleCreateModal">
          <img src="/assets/img/PageBuilder/modal-Close-Square.svg" alt="">
        </span>
        <h3 dir="rtl" class="text-center pt-[17.5px] text-[#101010] text-[12.9px]">ساخت صفحه</h3>
        <p dir="rtl" class="text-center mt-[7px] text-[#707070] text-[12.9px]">از صفحه ساز ایزی کانکت لذت ببرید !</p>
        <div class="row flex-nowrap justify-center mt-[40px]">
          <span class="col-auto px-0 self-center font-shabnam-fd text-[#009606] text-[16.5px]">www.ezy.company / </span>
          <input type="text" placeholder="نام کاربری" v-model="usernameInput"
                 class="col-auto text-center px-0.5 w-[137px] h-[31px] rounded-pill border-solid border-1 border-[#009606] focus-visible:outline-0 leading-10 rounded-[20px] bg-[#F0FCF3] text-[#009606]">
        </div>
        <div class="w-[290px] mx-auto text-[#707070] text-[12.9px] mt-[7.5px]">
          Https://ezy.company/{{ usernameInput }}
        </div>
        <div class="row justify-center flex-nowrap bottom-[70px] mx-auto absolute translate-middle-x left-1/2">
          <button @click.prevent="toggleCreateModal"
              class="col-auto w-[138px] h-[51.5px] bg-[#F0FCF3] rounded-[18px] mx-[8.25px] border-solid border-1 border-[#009606] text-[#009606]">
            لغو
          </button>
          <button
              class="d-flex justify-center col-auto w-[138px] h-[51.5px] bg-[#009606] rounded-[18px] mx-[8.25px] text-white">
            <span class="self-center">ادامه</span>
            <img class="self-center ml-[9px]" src="/assets/img/PageBuilder/modal-next-arrow.svg" alt="">
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ['baseURL'],
  data() {
    return {
      usernameInput: null,
      createModal  : false
    }
  },
  methods: {
    toggleCreateModal() {
      this.createModal = !this.createModal
    },
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
  mounted() {
    // localStorage.storedData
    // localStorage.setItem('token',[omid=>'omid',])
    var a = JSON.parse(localStorage.getItem('token'))

    console.log(a)

  },
}
</script>

<style>

</style>