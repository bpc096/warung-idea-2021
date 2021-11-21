<template>
  <div class="article-card-wrapper">
    <div class="article-image">
      {{ urlImage }}
    </div>
    <div class="article-info">
      <div class="article-title">
       {{ titleText }}
      </div>
      <div class="article-desc">
        {{ descText }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ArticleCardWrapper',
  props: {
    articleData: {
      type: Object,
      default: () => {
        return {
          imageUrl: '/test-article-image',
          titleText: 'News Title',
          descText: `Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Aenean orci e diam sapien, finibus eu metus ac,
          porttitor feugiat elit. Vestibulum varius ultricies ante,
          in convallis justo varius a.`,
        }
      },
    }
  },
  computed: {
    urlImage () {
      return this.articleData.imageUrl
    },
    titleText () {
      return this.articleData.titleText
    },
    descText () {
      return this.articleData.descText
    }
  }
}
</script>

<style lang="less" scoped>
.article-card-wrapper {
  height: 25rem;
  margin: 0 2rem;
  border: 1px solid rgb(32, 31, 31);
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;


  .article-image {
    background-color: pink;
    height: 50%;
  }

  .article-info {
    height: 50%;
    text-align: left;

    .article-title {
      padding: 5px 10px;
      color: black;
      font-size: 24px;
      font-weight: 600;
    }

    .article-desc {
      padding: 5px 10px;
      color: black;
    }
  }
}
</style>
