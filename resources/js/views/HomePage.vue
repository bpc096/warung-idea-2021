<template>
  <div class="home-wrapper">
    <div class="section">
      <div class="feature-section">
        <div class="project-feature-list">
          <div v-for="project in projectFeatureList" :key="project.id">
            <router-link :to="`/projectdetail/${project.id}`">
              <ProjectListFeature
                :projectData="project"
                :isInHomePage="true"
              />
            </router-link>
          </div>
        </div>
        <div class="project-feature-card">
          <router-link :to="`/projectdetail/${projectFeatureSingle.id}`">
            <ProjectCardFeature
              :projectData="projectFeatureSingle"
              :isInHomePage="true"
            />
          </router-link>
        </div>
      </div>
      <div class="popular-section">
        <div class="section-title">
          Popular Project
        </div>
        <div class="section-content">
          <div v-for="(project, index) in projectPopular" :key="index + project.Id">
            <router-link :to="`/projectdetail/${project.id}`">
              <ProjectMainCard
                :projectData="project"
                :isInHomePage="true"
              />
            </router-link>
          </div>
        </div>
      </div>
      <div class="most-funding-section">
        <div class="section-title">
          Most Funding Project
        </div>
        <div class="section-content">
          <div v-for="(project, index) in projectMostFunding" :key="index + project.id">
            <router-link :to="`/projectdetail/${project.id}`">
              <ProjectMainCard
                :projectData="project"
                :isInHomePage="true"
              />
            </router-link>
          </div>
        </div>
      </div>
      <div class="article-section">
        <div class="section-title">
          Article and News
        </div>
        <div class="section-content">
          <ArticleCard
            v-for="(article, index) in articleAndNews.data"
            :key="index + article.id"
            :articleData="article"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Component
import ProjectCardFeature from '../components/cardComponent/ProjectCardFeature.vue'
import ProjectListFeature from '../components/cardComponent/ProjectListFeature.vue'
import ProjectMainCard from '../components/cardComponent/ProjectCardMain.vue'
import ArticleCard from '../components/cardComponent/ArticleCard.vue'

// Utils
import { Carousel, Slide } from 'vue-carousel'
import { mapGetters } from 'vuex'


export default {
  name: "HomePage",
  components: {
    ProjectCardFeature,
    ProjectListFeature,
    ProjectMainCard,
    ArticleCard,
    Carousel,
    Slide,
  },
  data: () => {
    return {
      dummyTest: 3,
      projectId: 3,
      projectFeatureSingle: {},
      projectFeatureList: [],
      projectPopular: [],
      projectMostFunding: [],
      articleAndNews: [],
      allProjectList: [],
    }
  },
  created () {
    this.checkAvailableContent()
  },
  computed: {
    ...mapGetters({
      articles: 'articles'
    }),
    totalCampaignProject () {
      return this.allProjectList.length
    }
  },
  methods: {
    async checkAvailableContent () {
      await this.getAllProjectList()


      this.checkAvailableProjectFeatureSingle()
      this.checkAvailableProjectFeatureList()
      this.checkAvailableProjectPopular()
      this.checkAvailableProjectMostFunding()
      this.checkAvailableArticleAndNews()
    },
    async getAllProjectList() {
      await this.$store
        .dispatch('getAllCampaign')
        .then(res => {
          this.allProjectList = res.data.data.data
        })
        .catch(err => {
          console.error(err)
        })
    },
    checkAvailableProjectFeatureList () {
      // GET 3 Random Project from project list
      this.projectFeatureList = this.allProjectList.filter((project, idx) => {
        if(idx <= 2) return project
      })
    },
    checkAvailableProjectFeatureSingle () {
      // CHECKING API FOR AVAILABLE PROJECT FEATURE
      const resFeatureSingle = this.allProjectList.filter((project, idx) => {
        if(idx <= 0) return project
      })
      this.projectFeatureSingle = resFeatureSingle[0]
    },
    checkAvailableProjectPopular () {
      // CHECKING API FOR AVAILABLE PROJECT POPULAR
      this.projectPopular = this.allProjectList.filter((project, idx) => {
        if(idx <= 1) return project
      })
    },
    checkAvailableProjectMostFunding () {
      // CHECKING API FOR AVAILABLE PROJECT MOST FUNDING
      this.projectMostFunding = this.allProjectList.filter((project, idx) => {
        if(idx <= 1) return project
      })
    },
    checkAvailableArticleAndNews () {
      // CHECKING API FOR AVAILABLE ARTICLE AND NEWS
      this.$store.dispatch('initArticle')
        .then(res => {
          this.articleAndNews = this.articles
        })
        .catch(err => {
          console.error(err)
        })
      // this.articleAndNews = tempContentArticle
    },
  }
}
</script>

<style lang="less" scoped>
.home-wrapper {
  margin-bottom: 5rem;
  display: flex;
  justify-content: center;

  .section {
    padding: 0 4rem;
    width: 80%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;


    .feature-section {
      width: 100%;
      height: 50vh;
      display: flex;
      flex-direction: row;
      margin-top: 2rem;
      .project-feature-card {
        width: 100%;
        padding: 2rem;
        a {
          text-decoration: none;
        }
      }
      .project-feature-list {
        width: 100%;

        a {
          text-decoration: none;
          color: black;
        }
      }
    }

    .popular-section {
      margin: 20px 0 0 0;
      height: 70vh;
    }

    .most-funding-section {
      height: 70vh;
    }

    .popular-section, .most-funding-section {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;

      .section-title {
        height: 10%;
        text-align: left;
        font-size: 48px;
        font-weight: 500;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        margin-left: 1.2rem;
      }

      .section-content {
        display: flex;
        flex-direction: row;
        height: 70%;
        width: 100%;
        align-items: center;
        justify-content: space-around;
        a {
          text-decoration: none;
          color: black;
        }
      }
    }

    .article-section {
      height: 30vh;
      width: 100%;
      margin-bottom: 20rem;

      .section-title {
        height: 10%;
        text-align: left;
        font-size: 48px;
        font-weight: 500;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        margin-left: 1.2rem;
      }

      .section-content {
        height: 100%;
        display: flex;
        flex-direction: row;
        margin-top: 4rem;
      }
    }
  }
}
</style>>
