<template>
  <div class="category-wrapper">
    category {{ checkQueryCategoryId }}
  </div>
</template>

<script>
export default {
  name: 'CategoryPage',
  data : () => {
    return {
      isExist: true,
    }
  },
  computed: {
    checkQueryCategoryId () {
      return this.$route.params.categoryId
    }
  }
}
</script>

<style lang="less" scoped>
.category-wrapper { 
  height: 90vh;
}
</style>