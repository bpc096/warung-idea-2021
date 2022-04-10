<template>
  <section class='forum-tab-wrap' aria-labelledby="comment">
    <h2 id="comment">Forum</h2>
    <Disqus
      shortname="warungidea"
      :pageConfig="pageConfig"
      :lang="lang"
      @new-comment="newComment"
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
  data: () => {
    return {
      lang: 'en',
      pageConfig: {
        url: location.href,
        identifier: location.pathname
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
    },
    newComment(e){
      console.log(e)
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
