<template>
  <div class="container-vue">
    <HeaderTemplate
      v-if="!isInAdminPage"
    />
    <router-view></router-view>
    <FooterTemplate
      v-if="!isInAdminPage"
    />
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
  },
  computed: {
    isInAdminPage() {
      const found = this.$route.fullPath.indexOf('admin')
      return found > 0
    }
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
  background-color: #F6F6F6;
}
</style>
