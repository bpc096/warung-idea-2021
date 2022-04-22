<template>
  <section class='forum-tab-wrap' aria-labelledby="comment">
    <div class="title-tab">
      Forum Discussion
    </div>
    <div class="disqus-wrap">
      <div class="disqus-center">
        <Disqus
          shortname="warungidea"
          :pageConfig="pageConfig"
          :lang="lang"
          @new-comment="newComment"
        />
      </div>
    </div>
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
  min-height: 100vh;
  margin-top: 5rem 0 10rem 0;

  .title-tab {
    margin: 5rem 0;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .disqus-wrap {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;

    .disqus-center {
      width: 70%;
    }
  }
}
</style>
