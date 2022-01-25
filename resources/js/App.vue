<template>
  <div class="container-vue">
    <HeaderTemplate />
    <router-view></router-view>
    <FooterTemplate />
  </div>
</template>

<script>
import HeaderTemplate from './components/HeaderTemplate.vue'
import FooterTemplate from './components/FooterTemplate.vue'

export default {
  name: 'App',
  components: {
    HeaderTemplate,
    FooterTemplate
  }
}
</script>

<style>
.container-vue {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  margin: 0;
  padding: 0;
  width: 100%;
  max-width: 100%;
}
</style>
