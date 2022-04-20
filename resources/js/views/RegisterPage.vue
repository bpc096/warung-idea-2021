<template>
  <div class="row justify-content-md-center wrap-register-page">
    <div class="col-md-6 register-card">
      <div class="card">
        <div class="card-header">
          Register WarungIdea
        </div>
        <div class="card-body">
          <div
            class="alert alert-danger"
            v-for="(error, index) in errors"
            :key="index"
          >
            {{ error[0] }}
          </div>
          <form @submit.prevent="register">
            <div class="form-group">
              <label for="name">Name</label>
              <input v-model="name" type="text" class="form-control" placeholder="Name..">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input v-model="email" type="email" class="form-control" placeholder="Email..">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input v-model="password" type="password" class="form-control" placeholder="Password..">
            </div>
            <div class="form-group">
              <label for="pass-confirmation">Password Confirmation</label>
              <input v-model="passwordConfirmation" type="password" class="form-control" placeholder="Password Confirmation...">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RegisterPage',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirmation: '',
      errors: null,
    }
  },
  methods: {
    register () {
      let data = {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      }
      this.$store
        .dispatch("register", data)
        .then(res => {
          this.$router.push({
            name: 'LoginPage'
          })
        })
        .catch(err => {
          this.errors = err.response.data || [['Register Failed Please Try Again!']]
        })
    }
  }
}
</script>

<style lang="less" scoped>
.wrap-register-page {
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
  .register-card {
    max-width: 30%;
  }
}
</style>
