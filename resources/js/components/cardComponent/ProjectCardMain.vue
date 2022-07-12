<template>
  <div class="project-main-card">
    <div class="card-image">
      <img :src="imageUrl" alt="project-image">
    </div>
    <div class="card-content">
      <div class="card-title">
        {{ this.projectName }}
      </div>
      <div class="card-description">
        {{ this.projectDesc }}
      </div>
      <div class="card-additional">
        <div class="creator-info">
          <i>Created by <b>{{ creatorName }}</b></i>
        </div>
        <div class="icon-info">
          <div class="icon-love" @click.stop="clickLoveBtn">
            <a href="#loveIconClick">
              <i class="fa-regular fa-heart"></i>
            </a>
          </div>
          <div class="icon-bookmark" @click.stop="clickBookmarkBtn">
            <a href="#bookmarkIconClick">
              <i class="fa-regular fa-bookmark"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProjectMainCard',
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
    creatorName () {
      const name = this.projectData?.user?.name? this.projectData.user.name : 'Anonymous'
      return name
    },
    imageUrl () {
      return (this.projectData && this.projectData.image) ? this.projectData.image : this.dummyData.contentImageURL
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
        return contentDesc.slice(0,200) + '...'
      } else {
        return contentDesc
      }
    },
    projectPercentage () {
      return 90
    }
  },
  methods: {
    clickLoveBtn() {
      let toast = this.$toasted.success("Loved The Project ⭐")
      toast.goAway(2000)
    },
    clickBookmarkBtn() {
      let toast = this.$toasted.info('Bookmarked The Project 📑')
      toast.goAway(2000)
    }
  }
}
</script>

<style lang="less" scoped>
.project-main-card {
  height: 22rem;
  max-width: 40rem;
  display: flex;
  flex-direction: row;
  margin: 0 20px;
  border: 1px solid rgba(0,0,0,.5);
  border-radius: 20px;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  transition: 0.4s;

  &:hover{
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
  }

  .card-image {
    width: 40%;
    height: 100%;
    background-color: #7CD1B8;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;

  img {
      height: 100%;
      width: 100%;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
      object-fit: cover;
    }
  }

  .card-content {
    text-align: left;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    width: 55%;
    margin-left: 1rem;

    .card-title {
      margin-top: 1rem;
      font-size: 28px;
      font-weight: bold;
    }

    .card-description {
      max-width: 20rem;
    }

    .card-additional {
      height: 4rem;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;

      .creator-info {
        text-align: center;
      }

      .icon-info {
        display: flex;
        flex-direction: row;
        align-items: center;

        .icon-bookmark, .icon-love {
          margin: 0 6px;
          a {
            text-decoration: none;
            color: black;
            font-size: 20px;
          }
          a:hover {
            color: red;
          }
        }
      }
    }
  }


}
</style>
