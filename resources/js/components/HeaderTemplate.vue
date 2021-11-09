<template>
  <div class="header-wrapper">
    <div class="logo-wrap">
      <a href="/">
        <img 
          src="../assets/images/icon/light-bulb.png" 
          alt="bright-lamp"
        >
        <div class="text-image">
          WarungIde.co
        </div>
      </a>
    </div>
    <div v-if="isInLanding" class="category-wrap">
      <router-link to="/home">Home</router-link>
      <router-link to="/discover">Discover</router-link>
      <router-link to="/aboutus">About Us</router-link>
    </div>
    <div v-else class="category-wrap">
      <router-link to="/category/arts">Arts</router-link>
      <router-link to="/category/technology">Technology</router-link>
      <router-link to="/category/games">Games</router-link>
      <router-link to="/category/books">Books</router-link>
      <router-link to="/category/movies">Movie</router-link>
    </div>
    <div class="button-wrap">
      <a class="button-register" href="#register">
        Register
      </a>
      <a class="button-login" href="#login">
        Login
      </a>
    </div>
  </div>
</template>

<script>
export default {  
  name: "HeaderTemplate",
  computed: {
    currentRouteName () {
      return this.$route.name
    },
    isInLanding () {
      return this.$route.name === 'LandingPage' || this.$route.name === 'AboutUsPage'
    }
  }
}
</script>

<style lang="less" scoped>
@import url('https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap');

.header-wrapper {
  border-bottom: 1px solid grey;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  height: 4rem;
  background-color: rgba(0,0,0,.05);


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
    a {
      text-decoration: none;
      color: black;
      &:hover {
        color: pink;
      }
    }
  }

  .button-wrap {
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 15%;
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
      width: 40%;
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
      width: 40%;
      height: 2rem;
      border-radius: 20px;
      &:hover {
        background-color: black;
        color: white;
      }
    }
  }

}
</style>