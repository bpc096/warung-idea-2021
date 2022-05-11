<template>
  <div class="wrap-dashboard-page">
    <div class="side-bar-menu">
      Admin Menu
    </div>
    <div class="board-main-menu">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DashboardPage'
}
</script>

<style lang="less" scoped>
.wrap-dashboard-page{
  min-height: 90vh;
}
</style>
