<template>
  <div class="user-profile-edit-page">
    <div class="user-profile-card">
      <form @submit.prevent="submitPassword">
        <div class="user-profile-content">
          <div class="user-avatar">
            <div class="text-label">New Password</div>
            <div class="text-value">
              <input
                v-model="newPassword"
                type="password"
                class="form-control"
                placeholder="New Password.."
              >
            </div>
          </div>
          <div class="user-name">
            <div class="text-label">New Password Confirmation</div>
            <div class="text-value">
              <input
                v-model="passwordConfirmation"
                type="password"
                class="form-control"
                placeholder="Password Confirmation.."
              >
            </div>
          </div>
        </div>
        <div class="button-wrap">
          <button
            type="submit"
            class="button-edit-profile"
            >
            Reset Password
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'ForgotPassword',
  data: () => {
    return {
      passwordConfirmation: '',
      newPassword: '',
      token : '',
    }
  },
  created() {
    this.setToken()
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    imageUrl () {
      return this.previewImage ? this.previewImage : this.user.avatar
      // return 'https://images.unsplash.com/photo-1436128003323-97dab5d267a9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80'
    },
  },
  mounted () {
    this.setToken()
  },
  methods: {
    setToken() {
      console.log('Set Token')
      const getToken = this.$route.params.token || 'none'
      this.token = getToken
    },
    submitPassword() {
      if(!this.newPassword || !this.passwordConfirmation) return

      let data = new FormData()
      data.append('password', this.newPassword)
      data.append('password_confirm', this.passwordConfirmation)
      data.append('token', this.token)

      this.$store
        .dispatch('submitPassForgot', data)
        .then(res => {
          this.$swal({
            title: 'Reset Request Success',
            text: 'Please Check Your Email To Confirm It!',
            icon: 'success',
          }).then((res) => {
            this.$router.push({
              name: 'LoginPage'
            })
          })
        })
        .catch(err => {
          const errorMessage = err && err.message ? err.message : 'Something went wrong!'
          this.$swal({
              icon: 'error',
              title: 'Oops...',
              text: errorMessage,
            })
        })
    }
  }

}
</script>

<style lang="less" scoped>
.user-profile-edit-page {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;

  .user-profile-card {
    width: 600px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    border-radius: 20px;
    padding: 10px;

    .user-profile-content {
      margin: 5rem 0;
    }

    .user-image {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      .image {
        width: 100px;
        height: 100px;
        background-color: gray;
        border-radius: 50%;
      }
    }

    .user-name,
    .user-avatar {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin: 4rem 0;

      .text-label {
        margin-left: 3rem;
      }

      .text-value {
        margin-right: 3rem;
      }
    }

      .button-wrap {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        margin-bottom: 3rem;

        button {
          text-decoration: none;
          color: black;

          &:hover {
            cursor: pointer;
            background-color: pink;
          }
        }

        .button-edit-profile {
          background-color: #4FBDBA;
          width: 13rem;
          height: 2.5rem;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 20px;
        }

        .button-change-password {
          background-color: #F05454;
          width: 13rem;
          height: 2.5rem;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 20px;
        }

      }

  }
}
</style>
