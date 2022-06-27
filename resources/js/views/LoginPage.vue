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
                placeholder="Email.." >
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                v-model="form.password"
                type="password"
                class="form-control"
                placeholder="Password..."
              >
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <hr class="solid">
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
    }
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

  .login-card {
    max-width: 30%;
  }
}
</style>
