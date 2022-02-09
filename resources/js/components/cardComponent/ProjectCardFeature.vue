<template>
  <div class="feature-card-wrapper">
    <div class="content-image">
      <img :src="imageUrl" alt="image-project-feature">
    </div>
    <div class="content-info">
      <div class="content-title">
        {{ this.projectName }}
      </div>
      <div class="content-description">
        {{ this.projectDesc }}
      </div>
      <div class="content-addition">
        <div class="total-funded-label">
          Total Funded {{ this.paymentPercentage }}%
        </div>
        <div class="icon-label">
          <div class="icon-love">
            <a href="#addToLove">
              <img src="../../assets/images/icon/love.png" alt="love-icon">
            </a>
          </div>
          <div class="icon-bookmark">
            <a href="#addToBookmark">
              <img src="../../assets/images/icon/bookmark.svg" alt="bookmark-icon">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProjectCardFeature',
  props: {
    projectData: {
      type: Object,
      default: {},
    },
    isInHomePage: {
      type: Boolean,
      default: false,
    }
  },
  data: () => {
    return {
      dummyData: {
        contentId: 1,
        contentImageURL: 'https://images.unsplash.com/photo-1643133277733-68f9bf8ddee2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
        contentTitle: 'Project Title Here',
        contentDescription: 'Lorem ipsum dua tiga tutup botol',
        contentFundedPercentage: 90,
      }
    }
  },
  computed: {
    imageUrl() {
      return this.projectData?.image? this.projectData.image : this.dummyData.contentImageURL
    },
    projectName () {
      const projectTitle = this.projectData?.title? this.projectData.title : this.dummyData.contentTitle
      if(this.isInHomePage) {
        return projectTitle.slice(0,30)
      } else {
        return projectTitle
      }
    },
    projectDesc () {
      const contentDesc = this.projectData?.description? this.projectData.description : this.dummyData.contentDescription
      if(this.isInHomePage) {
        return contentDesc.slice(0,180) + '...'
      } else {
        return contentDesc
      }
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
      if(this.totalpayment === '0' || this.projectTargetDonation === '0') return '0'
      const mathPercentage = Math.floor((parseInt(this.totalPayment)/parseInt(this.projectTargetDonation)) * 100)
      return mathPercentage
    },
  }
}
</script>

<style lang="less" scoped>
.feature-card-wrapper {
  background-color: white;
  height: 100%;
  width: 100%;
  border: 1px solid black;
  border-radius: 30px;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;


  .content-image {
    border-top-left-radius: 29px;
    border-top-right-radius: 29px;
    height: 50%;
    background-color: #7CD1B8;
    img {
      width: 100%;
      height: 100%;
      border-top-left-radius: 29px;
      border-top-right-radius: 29px;
    }
  }

  .content-info {
    padding: .5rem;
    height: 47%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    .content-title {
      font-size: 30px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      color: black;
      text-align: left;
    }

    .content-description {
      font-size: 16px;
      text-align: left;
      color: rgba(0,0,0,0.8);
    }

    .content-addition {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      .total-funded-label {
        color: green;
        font-weight: bold;
      }
      .icon-label {
        display: flex;

        .icon-bookmark, .icon-love {
          margin: 0 10px;
          a {
            text-decoration: none;
          }

          img {
            height: 24px;
            width: 24px;
          }
        }
      }
    }
  }
}
</style>
