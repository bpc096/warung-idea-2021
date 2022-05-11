<template>
  <div class="request-list-page">
    <div class="title-tab">
      Request List Page - {{ getRequestName }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'RequestListPage',
  computed: {
    getRequestName() {
      return this.$route.params.requestname || 'Default Request Name'
    }
  }
}
</script>

<style lang="less" scoped>
.request-list-page {
  width: 100%;
  .title-tab {
    margin: 5rem 0;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }
}
</style>
