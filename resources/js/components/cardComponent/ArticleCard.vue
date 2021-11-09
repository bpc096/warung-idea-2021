<template>
  <div class="article-card-wrapper">
    <div class="article-image">
      image
    </div>
    <div class="article-info">
      <div class="article-title">
        News Title
      </div>
      <div class="article-desc">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Aenean orci e diam sapien, finibus eu metus ac, 
        porttitor feugiat elit. Vestibulum varius ultricies ante, 
        in convallis justo varius a.
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
      default: {},
    }
  }
}
</script>

<style lang="less" scoped>
.article-card-wrapper {
  height: 70%;
  width: 20%;
  margin: 0 2rem;
  border: 1px solid black;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;


  .article-image {
    background-color: pink;
    height: 50%;
  }

  .article-info {
    height: 50%;
    text-align: left;
    
    .article-title {
      padding: 10px 10px;
      color: black;
      font-size: 24px;
      font-weight: 600;
    }

    .article-desc {
      padding: 10px 10px;
      color: black;
    }
  }
}
</style>