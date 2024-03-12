<template>
  <div id="appCapsule">
    <div class="header-large-title">
      <span class="title fs-3">Your Profiles</span>
    </div>
    <button class="btn btn-danger" @click.prevent="logoutMethod">logout</button>
    <div class="section mt-3 mb-3">
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
                  <img src="assets/img/PageBuilder/userGray.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props  : ['baseURL'],
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
  mounted() {
    // localStorage.storedData
    // localStorage.setItem('token',[omid=>'omid',])
    var a = JSON.parse(localStorage.getItem('token'))

    console.log(a)

  },
}
</script>

<style lang="scss" scoped>

</style>