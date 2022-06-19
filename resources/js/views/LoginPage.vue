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
          <!-- <hr class="solid">
          <button @click="AuthProvider('google')">auth Google</button> -->
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
}
</style>
