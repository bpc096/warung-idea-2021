<template>
  <div class="user-profile-page">
    <div class="user-profile-card">
      <div class="user-profile-content">
        <div class="user-image">
          <img :src="imageUrl" alt="icon-user-image" class="image">
        </div>
        <div class="user-name">
          <div class="text-label">Name</div>
          <div class="text-value">{{ user.name }}</div>
        </div>
        <div class="user-username">
          <div class="text-label">Username</div>
          <div class="text-value">{{ user.name }}_Username</div>
        </div>
        <div class="user-email">
          <div class="text-label">Email</div>
          <div class="text-value">{{ user.email }}</div>
        </div>
        <div class="user-gender">
          <div class="text-label">Gender</div>
          <div class="text-value">{{ profile.gender }}</div>
        </div>
        <div class="user-phonenumber">
          <div class="text-label">Phone Number</div>
          <div class="text-value">{{ profile.phonenumber }}</div>
        </div>
      </div>
      <div class="button-wrap">
        <a
          class="button-edit-profile"
          @click="editProfile"
          >
          Edit Profile
        </a>
        <a
          class="button-change-password"
          @click="changePassword"
        >
          Change Password
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'UserProfile',
  data: () => {
    return {
      profile : {
        name: 'TestingName',
        username: 'Testing_Username',
        email: 'testing@gmail.com',
        gender: 'Male',
        phonenumber: '088210248494',
      }
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    imageUrl () {
      return this.user.avatar
      // return 'https://images.unsplash.com/photo-1436128003323-97dab5d267a9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80'
    }
  },
  methods: {
    changePassword() {
      this.$router.push({
        path: '/profile/changepassword'
      })
    },
    editProfile() {
      this.$router.push({
        path: '/profile/editprofile'
      })
    }
  }

}
</script>

<style lang="less" scoped>
.user-profile-page {
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
    .user-username,
    .user-email,
    .user-gender,
    .user-phonenumber {
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

        a {
          text-decoration: none;
          color: black;

          &:hover {
            cursor: pointer;
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
