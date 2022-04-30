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
      <router-link to="/profile" class="button-profile">
        Profile
      </router-link>
      <router-link to="/campaign/history" class="button-profile">
        Campaign
      </router-link>
      <a @click="logout" class="button-logout">
        Logout
      </a>
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

export default {
  name: "HeaderTemplate",
  data: () => {
    return {
      loginMock: true,
    }
  },
  computed: {
    ...mapGetters({
      isLoggedIn: 'isLoggedIn',
      user: 'user',
    }),
    currentRouteName () {
      return this.$route.name
    },
    isInLanding () {
      return this.$route.name === 'LandingPage' || this.$route.name === 'AboutUsPage' || this.$route.name === 'DiscoveryPage'
    },
    isUserLoggedIn() {
      return this.loginMock
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
        color: blue;
      }
    }
  }

  .button-wrap {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 20%;
    margin-right: 2rem;

    a {
      text-decoration: none;
      color: black;
    }

    .button-login {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid black;
      margin-left: 1rem;
      min-width: 7rem;
      height: 2rem;
      border-radius: 20px;
      &:hover {
        background-color: black;
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
        background-color: black;
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
