<template>
  <div class="header-wrapper">
    <div class="logo-wrap">
      <a href="/">
        <img
          src="\images\icon\light-bulb.png"
          alt="bright-lamp"
        >
        <div class="text-image">
          WarungIde.com
        </div>
      </a>
    </div>
    <div v-if="isInLanding" class="category-wrap">
      <router-link class="btn-main" to="/home">Home</router-link>
      <router-link class="btn-main" to="/discover">Discover</router-link>
      <router-link class="btn-main" to="/aboutus">About Us</router-link>
    </div>
    <div v-else class="category-wrap">
      <router-link to="/category/arts">Arts</router-link>
      <router-link to="/category/technology">Technology</router-link>
      <router-link to="/category/games">Games</router-link>
      <router-link to="/category/books">Books</router-link>
      <router-link to="/category/movies">Movie</router-link>
      <router-link to="/category/health-and-fitness">Health & Fitness</router-link>
    </div>
    <div v-if="isLoggedIn" class="button-wrap">
      <div class="dropdown">
        <button
          class="btn button-login dropdown-toggle"
          type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          💡 Campaign
        </button>
        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdownMenuButton">
          <router-link to="/campaign/create" class="dropdown-item item-click-menu">
            ➕ Create New Campaign
          </router-link>
          <router-link to="/campaign/history" class="dropdown-item item-click-menu">
            🏬 Campaign History
          </router-link>
          <router-link to="/campaign/history/donation" class="dropdown-item item-click-menu">
            🏢 History Donation Page
          </router-link>
          <router-link to="/campaign/collaboration" class="dropdown-item item-click-menu">
            🏨 Campaign Collaboration
          </router-link>
        </div>
      </div>
      <div class="dropdown">
        <button
          class="btn button-login dropdown-toggle"
          type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ✉️ Notif
        </button>
        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdownMenuButton">
          <router-link to="/campaign/create" class="dropdown-item item-click-menu">
            ➕ New Notification
          </router-link>
        </div>
      </div>
      <div class="dropdown">
        <button
          class="btn button-login dropdown-toggle"
          type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          🙍 {{userNameText}}
        </button>
        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdownMenuButton">
          <h6 class="dropdown-header">{{ userEmailText }}</h6>
          <div class="dropdown-divider"></div>
          <router-link to="/profile" class="dropdown-item item-click-menu">
            Profile
          </router-link>
          <router-link to="/profile/invitation" class="dropdown-item item-click-menu" @click.native="markNotifAsRead">
            Invitation <span class="badge badge-pill badge-primary" v-if="getCountNotification > 0">{{getCountNotification}}</span>
          </router-link>
          <router-link to="/chat" class="dropdown-item item-click-menu">
            Chat Message
          </router-link>
          <a @click="logout" class="dropdown-item item-click-menu">
            Logout
          </a>
        </div>
      </div>
    </div>
    <div v-else class="button-wrap">
      <router-link to="/register" class="button-register">
        Register
      </router-link>
      <router-link to="/login" class="button-login">
        Login
      </router-link>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from "axios"

export default {
  name: "HeaderTemplate",
  data: () => {
    return {
      loginMock: true,
      notifications: []
    }
  },
  created() {
    this.$store
      .dispatch('getNotifications')
      .then(() => {
        this.notifications = this.$store.state.notifications
      })
  },
  computed: {
    ...mapGetters({
      isLoggedIn: 'isLoggedIn',
      user: 'user'
    }),
    currentRouteName () {
      return this.$route.name
    },
    isInLanding () {
      return this.$route.name === 'LandingPage' || this.$route.name === 'AboutUsPage' || this.$route.name === 'DiscoveryPage'
    },
    isUserLoggedIn() {
      return this.loginMock
    },
    userNameText() {
      return this.user.name || 'Default Name'
    },
    userEmailText() {
      return this.user.email || 'Default Email'
    },
    getCountNotification() {
      return this.notifications.count
    }
  },
  methods: {
    logout () {
      this.$swal({
        title: 'Are you sure?',
        text: "You are going to logout",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store
            .dispatch('logout')
            .then(() => {
              this.$swal({
                title: 'Logout Success',
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
              })
              this.$router.push('/')
            })
        }
      })
    },
    async markNotifAsRead() {
      try {
        await axios.get('notifications/markNotifAsRead')
        this.$store.dispatch('getNotifications')
          .then(() => {
            this.notifications = this.$store.state.notifications
          })
      } catch(e) {
        console.error(e)
      }
    }
  }
}
</script>

<style lang="less" scoped>

.header-wrapper {
  border-bottom: 1px solid rgba(0,0,0,.1);
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  height: 4rem;
  background-color: rgba(0,0,0,.01);


  .logo-wrap {
    width: 15%;
    a {
      display: flex;
      flex-direction: row;
      margin-left: 2rem;
      text-decoration: none;
      color: black;
    }
    .text-image {
      margin-left: .7rem;
      font-size: 1.4rem;
      font-family: 'Zen Antique Soft', serif;
    }
    img {
      height: 34px;
      width: 28px;
    }
  }

  .category-wrap {
    width: 30%;
    display: flex;
    flex-direction: row;
    justify-content: space-around;

    .btn-main {
      font-weight: 500;
      letter-spacing: 2px;
    }

    a {
      text-decoration: none;
      color: black;
      &:hover {
        color: #83BD75;
      }
    }
  }

  .button-wrap {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 20%;
    margin-right: 2rem;

    .item-click-menu{
      &:hover {
        color: white;
        background-color: #55D8C1;
      }
      &:active {
        color: white;
        background-color: #4E944F;
      }
    }

    a {
      text-decoration: none;
      color: black;
    }

    .button-login {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid black;
      color: black;
      background-color: white;
      margin-left: 1rem;
      min-width: 7rem;
      height: 2rem;
      border-radius: 20px;
      &:hover {
        background-color: #55D8C1;
        color: white;
      }
    }
    .button-register {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid black;
      margin-right: 1rem;
      min-width: 7rem;
      height: 2rem;
      border-radius: 20px;
      &:hover {
        background-color: #55D8C1;
        color: white;
      }
    }

    .button-profile {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid black;
      margin-right: 1rem;
      width: 40%;
      height: 2rem;
      border-radius: 20px;
      &:hover {
        background-color: black;
        color: white;
      }
    }

    .button-logout {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid black;
      margin-right: 1rem;
      width: 40%;
      height: 2rem;
      border-radius: 20px;
      &:hover {
        background-color: black;
        color: white;
        cursor: pointer;
      }
    }
  }

}
</style>
