<template>
  <div class="project-list-wrapper">
    <div class="card-list">
      <div class="list-image">
        <img :src="imageUrl" alt="image-project-campaign">
      </div>
      <div class="list-content">
        <div class="content-title">
          {{ this.projectName }}
        </div>
        <div class="content-description">
          {{ this.projectDesc }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProjectListFeature',
   props: {
    projectData: {
      type: Object,
      default: {}
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
        contentImageURL: '/testing',
        contentTitle: 'Project Title Here',
        contentDescription: 'Lorem ipsum dua tiga tutup botol',
        contentFundedPercentage: 90,
      }
    }
  },
  computed: {
    imageUrl () {
      return this.projectData?.image? this.projectData.image : this.dummyData.contentImageURL
    },
    projectName () {
      const projectTitle = this.projectData?.title? this.projectData.title : this.dummyData.contentTitle
      if(this.isInHomePage) {
        return projectTitle.slice(0,20)
      } else {
        return projectTitle
      }
    },
    projectDesc () {
      const contentDesc = this.projectData?.description? this.projectData.description : this.dummyData.contentDescription
      if(this.isInHomePage) {
        return contentDesc.slice(0,100) + '...'
      } else {
        return contentDesc
      }
    },
    projectPercentage () {
      return 90
    }
  }
}
</script>

<style lang="less" scoped>
.project-list-wrapper {
  padding: .9rem;
  margin: 20px 0;

  .card-list {
    border-radius: 30px;
    width: 100%;
    height: 6rem;
    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    border: 1px solid black;
    display: flex;
    flex-direction: row;

    .list-image {
      border-top-left-radius: 30px;
      border-bottom-left-radius: 30px;
      background-color: salmon;
      max-width: 40%;

      img {
        max-width: 100%;
        height: 100%;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
      }
    }

    .list-content {
      text-align: left;
      padding: .5rem;

      .content-title {
        font-weight: bold;
      }

      .content-description {
        font-weight: lighter;
        margin-top: .2rem;
      }
    }
  }
}
</style>
