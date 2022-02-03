<template>
  <div class="article-card-wrapper">
    <div class="article-image">
      <img :src="urlImage" alt="image-dummy-article">
    </div>
    <div class="article-info">
      <div class="article-title">
       {{ titleText.slice(0,30) }} ...
      </div>
      <div class="article-desc">
        {{ descText.slice(0,120) }} ...
      </div>
      <div v-if="isCampaign" class="donation-info">
        Total Donation {{ randomNumber }}%
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ArticleCardWrapper',
  props: {
    isCampaign: {
      type: Boolean,
      default: false
    },
    projectData: {
      type: Object,
      default: () => {},
    },
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
      return this.articleData?.image? this.articleData.image : this.projectData.image
    },
    titleText () {
      return this.isCampaign ? this.projectData.title : this.articleData.title
    },
    descText () {
      return this.isCampaign ? this.projectData.description : this.articleData.description
    },
    randomNumber() {
      const randomNumb = Math.floor((Math.random() * 100) + 1)
      return randomNumb
    }
  }
}
</script>

<style lang="less" scoped>
.article-card-wrapper {
  min-height: 24rem;
  margin: 0 2rem;
  border: 1px solid rgb(32, 31, 31);
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;


  .article-image {
    background-color: pink;
    height: 10rem;

    img {
      height: 100%;
      width: 100%;
    }
  }

  .article-info {
    height: 50%;
    text-align: left;
    margin: 10px 0;

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

    .donation-info {
      padding: 5px 10px;
      color: green;
      font-weight: bold;
    }
  }
}
</style>
