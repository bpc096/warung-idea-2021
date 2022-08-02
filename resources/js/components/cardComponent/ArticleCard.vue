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
        Total Donation {{ paymentPercentage }}%
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
    projectTargetDonation() {
      if(!this.projectData || !this.projectData.target_donation) return '0'
      else return this.projectData.target_donation
    },
    totalPayment() {
      if(!this.projectData || !this.projectData.sum_payment || this.projectData.sum_payment.length <=0 || !this.projectData.sum_payment[0].total) return '0'
      else return this.projectData.sum_payment[0].total
    },
    paymentPercentage() {
      if(!this.isCampaign || this.totalpayment === '0' || this.projectTargetDonation === '0') return '0'
      const mathPercentage = Math.floor((parseInt(this.totalPayment)/parseInt(this.projectTargetDonation)) * 100)
      return mathPercentage
    },
  }
}
</script>

<style lang="less" scoped>
.article-card-wrapper {
  min-height: 20rem;
  margin: 0 2rem;
  border: 1px solid rgb(32, 31, 31);
  border-radius: 30px;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  transition: 0.5s;

  &:hover {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
  }


  .article-image {
    background-color: pink;
    height: 10rem;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;

    img {
      height: 100%;
      width: 100%;
      border-top-left-radius: 30px;
      border-top-right-radius: 30px;
      object-fit: cover;
    }
  }

  .article-info {
    height: 15rem;
    text-align: left;
    margin: 10px 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;


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
