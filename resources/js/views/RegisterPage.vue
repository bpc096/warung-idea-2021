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
              <input v-model="form.name" type="text" class="form-control" placeholder="Name..">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input v-model="form.email" type="email" class="form-control" placeholder="Email..">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input v-model="form.password" type="password" class="form-control" placeholder="Password..">
            </div>
            <div class="form-group">
              <label for="pass-confirmation">Password Confirmation</label>
              <input v-model="form.passwordConfirmation" type="password" class="form-control" placeholder="Password Confirmation...">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

const defaultForm = {
  name: '',
  email: '',
  password: '',
  passwordConfirmation: '',
}

export default {
  name: 'RegisterPage',
  data() {
    return {
      form: { ...defaultForm },
      errors: null,
    }
  },
  watch: {
    form: {
      handler(newForm, oldForm) {
        if(this.errors) {
          this.errors = null
        }
      },
      deep: true,
    }
  },
  methods: {
    register () {
      let data = {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        password_confirmation: this.form.passwordConfirmation,
      }
      this.$store
        .dispatch("register", data)
        .then(res => {
          let toast = this.$toasted.success('Register Success, Please Login First! ✅', {position: 'top-center'})
          toast.goAway(1500)
          this.$router.push({
            name: 'LoginPage'
          })
        })
        .catch(err => {
          if (err.response.data) {
            this.errors = err.response.data || [['Register Failed Please Try Again!']]
          } else {
            this.$swal({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
            })
          }
        })
    }
  }
}
</script>



<style lang="less" scoped>
.wrap-register-page {
  min-height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
  .register-card {
    max-width: 30%;
    input {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif,'FontAwesome';
    }
  }
}
</style>
