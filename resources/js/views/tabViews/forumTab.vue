<template>
  <section class='forum-tab-wrap' aria-labelledby="comment">
    <h2 id="comment">Forum</h2>
    <Disqus
      shortname='warungidea'
      :pageConfig="getPageConfig"
    />
  </section>
</template>

<script>
import { Disqus } from 'vue-disqus'

export default {
  name: 'ForumTab',
  props: {
    projectData: {
      type: Object,
      default: {
        category_id: 1
      }
    }
  },
  components: {
    Disqus
  },
  computed: {
    getCategoryId() {
      return this.projectData.category_id
    },
    getTitle() {
      return window.title
    },
    getFullPathURL() {
      return window.location.href
    },
    getShortPath() {
      return window.location.pathname
    }
  },
  methdos: {
    getPageConfig() {
      return {
        url: this.getFullPathURL,
        identifier: this.getShortPath,
        title: this.getTitle,
        category_id: this.getCategoryId
      }
    }
  }
}
</script>

<style lang="less" scoped>
.forum-tab-wrap {
  height: 90vh;
  margin-top: 3rem;
}
</style>
