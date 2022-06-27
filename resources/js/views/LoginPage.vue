<template>
  <div class="row justify-content-md-center wrap-login-page">
    <div class="col-md-6 login-card">
      <div class="card">
        <div class="card-header">
          Login WarungIdea
        </div>
        <div class="card-body">
          <div
            class="alert alert-danger"
            v-if="errors.length > 0">
            {{ errors }}
          </div>
          <form @submit.prevent="userLogin">
            <div class="form-group">
              <label for="username">Email</label>
              <input
                v-model="form.email"
                type="email"
                class="form-control"
                :placeholder="emailPlaceholder">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                v-model="form.password"
                type="password"
                class="form-control"
                :placeholder="passwordPlaceholder"
              >
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <div class="divider-wrap">
            <div class="divider-line">
              <hr class="solid">
            </div>
            <h5>OR</h5>
            <div class="divider-line">
              <hr class="solid">
            </div>
          </div>
          <!-- <button @click="AuthProvider('google')">auth Google</button> -->
          <button @click="btnForgotPassword" class="btn btn-primary">Forgot Password</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',
  data() {
    return {
      emailPlaceholder: '\ue4e8 Enter Your Email Address',
      passwordPlaceholder: '\uf023 Enter Your Password',
      form: {
        email: '',
        password: '',
      },
      errors: '',
    }
  },
  methods: {
    btnForgotPassword() {
      this.$swal({
        title: 'Forgot Your Password ?',
        input: 'email',
        inputLabel: 'Input your email address',
        inputPlaceholder: 'your email address'
      }).then((result) => {
        console.log(result)
        if(result.isConfirmed) {
          let data = new FormData()
          data.append('email', result.value)

          this.$store.dispatch('requestResetPassword',data)
          .then((res) => {
            this.$swal({
              title: 'Reset Request Success',
              text: 'Please Check Your Email To Confirm It!',
              icon: 'success',
            })
          })
          .catch((err) => {
            const errorMessage = err && err.message ? err.message : 'Something went wrong!'
            this.$swal({
              icon: 'error',
              title: 'Oops...',
              text: errorMessage,
            })
          })
        }
      })
    },
    userLogin() {
      this.$store.dispatch('login', this.form)
      .then(res => {
        this.$toasted.success("Login Successfull", {position: 'top-left', duration: 1500})
        this.$router.push({name: 'HomePage', path: '/home'})
      }).catch(err => {
        this.errors = err.response.data.message
      })
    },
    AuthProvider(provider) {
      var self = this
      this.$auth.authenticate(provider)
        .then(response =>{
          console.log(response)
          self.SocialLogin(provider,response)
        }).catch(err => {
          console.log({err:err})
        })
    },
    SocialLogin(provider,response){
      this.$http
      .post('/sociallogin/'+provider,response)
      .then(response => {
        console.log(response.data)
      }).catch(err => {
          console.log({err:err})
      })
    },
  }
}
</script>

<style lang="less" scoped>
.wrap-login-page {
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

  hr.solid {
    border-top: 3px solid #bbb;
    margin: 2rem 0;
  }

  .login-card {
    max-width: 30%;
  }

  input{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif,'FontAwesome';
  }

  .divider-wrap {
    display: flex;
    flex-direction: row;
    width: 100%;
    align-items: center;
    justify-content: center;;

    .divider-line {
      width: 40%;
    }

    h5 {
      text-align: center;
      margin: 0 15px;
    }
  }
}
</style>
