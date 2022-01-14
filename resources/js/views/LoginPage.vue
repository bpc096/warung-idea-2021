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
              <label for="username">Username</label>
              <input
                v-model="form.email"
                type="text"
                class="form-control"
                placeholder="Username.." >
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
    userLogin() {
      console.log(this.form)
      this.$store.dispatch('login', this.form)
      .then(res => {
        console.log(res)
        this.$router.push({name: 'HomePage', path: '/home'})
      }).catch(err => {
        console.log(err.response)
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
