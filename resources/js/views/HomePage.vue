<template>
  <div class="home-wrapper">
    <div class="section">
      <div class="feature-section">
        <div class="project-feature-list">
          <router-link to="/projectDetail">
            <ProjectListFeature />
          </router-link>
          <router-link to="/projectDetail">
            <ProjectListFeature />
          </router-link>
          <router-link to="/projectDetail">
            <ProjectListFeature />
          </router-link>
        </div>
        <div class="project-feature-card">
          <router-link to="/projectDetail">
            <ProjectCardFeature 
              :projectData="projectFeatureSingle"
            />
          </router-link>
        </div>
      </div>
      <div class="popular-section">
        <div class="section-title">
          Popular Project
        </div>
        <div v-if="isPopularContentMore" class="section-content-more">
          <carousel 
            :scrollPerPage="false"
            :navigationEnabled="false"
          >
            <slide>
              <span class="label">
                <ProjectMainCard />
              </span>
            </slide>
            <slide>
              <span class="label">
                <ProjectMainCard />
              </span>
            </slide>
            <slide>
              <span class="label">
                <ProjectMainCard />
              </span>
            </slide>
            <slide>
              <span class="label">
                <ProjectMainCard />
              </span>
            </slide>
          </carousel>
        </div>
        <div v-else class="section-content">
          <div v-for="(project, index) in projectPopular" :key="index + project.contentId">
            <router-link to="/projectDetail">
              <ProjectMainCard 
                :projectData="project"
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
          <div v-for="(project, index) in projectMostFunding" :key="index + project.contentId">
            <router-link :to="{ path: '/projectDetail', query: { projectId: project.contentId }}">
              <ProjectMainCard 
                :projectData="project"
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
            v-for="(article, index) in articleAndNews"
            :key="index + article.contentId"
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
      isPopularContentMore: false,
      isFundingContentMore: false,
      projectFeatureSingle: {},
      projectFeatureList: [],      
      projectPopular: [],
      projectMostFunding: [],
      articleAndNews: [],
    }
  },
  created () {
    this.checkAvailableContent()
  },
  methods: {
    checkAvailableContent () {
      this.checkAvailableProjectFeatureSingle()
      this.checkAvailableProjectFeatureList()
      this.checkAvailableProjectPopular()
      this.checkAvailableProjectMostFunding()
      this.checkAvailableArticleAndNews()
    },
    checkAvailableProjectFeatureList () {
      const tempContentFeatureList = [{
        contentId: 5,
        contentImageURL: '/testing',
        contentTitle: 'Project Title Here',
        contentDescription: 'orem ipsum dolor sit amet consectetur adipisicing elit. Eaque id est fuga ducimus nesciunt, ratione aperiam commodi rem architecto nihil?',
      }]
      this.projectFeatureList = tempContentFeatureList
    },
    checkAvailableProjectFeatureSingle () {
      // CHECKING API FOR AVAILABLE PROJECT FEATURE
      const tempContentFeature = {
        contentId: 1,
        contentImageURL: '/testing',
        contentTitle: 'Project Title Here',
        contentDescription: 'orem ipsum dolor sit amet consectetur adipisicing elit. Eaque id est fuga ducimus nesciunt, ratione aperiam commodi rem architecto nihil?',
        contentFundedPercentage: 90,
      }
      this.projectFeatureSingle = tempContentFeature
    },
    checkAvailableProjectPopular () {
      // CHECKING API FOR AVAILABLE PROJECT POPULAR
      const tempContentPopular = [
        {
          contentId: 2,
          contentImageURL: '/testing',
          contentTitle: 'Project name here',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit facilis consequuntur, laborum et unde quod corporis culpa illum pariatur eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, nam!',
          contentCreator: 'Mister Ex',
        },
        {
          contentId: 6,
          contentImageURL: '/testing-six',
          contentTitle: 'Project name six',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit facilis consequuntur, laborum et unde quod corporis culpa illum pariatur eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, nam!',
          contentCreator: 'Mister Ah',
        },
      ]
      this.projectPopular = tempContentPopular
    },
    checkAvailableProjectMostFunding () {
      // CHECKING API FOR AVAILABLE PROJECT MOST FUNDING
      const tempContentMostFunding = [
        {
          contentId: 3,
          contentImageURL: '/testing-zerothree',
          contentTitle: 'Project name here',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit facilis consequuntur, laborum et unde quod corporis culpa illum pariatur eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, nam!',
          contentCreator: 'Mister Be',
        },
        {
          contentId: 8,
          contentImageURL: '/testing-eight',
          contentTitle: 'Project name eight',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit facilis consequuntur, laborum et unde quod corporis culpa illum pariatur eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, nam!',
          contentCreator: 'Mister Eight',
        },
      ]
      this.projectMostFunding = tempContentMostFunding
    },
    checkAvailableArticleAndNews () {
      // CHECKING API FOR AVAILABLE ARTICLE AND NEWS
      const tempContentArticle = [
        {
          contentId: 4,
          contentImageURL: '/article-foure',
          contentTitle: 'News Four',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean orci e diam sapien, finibus eu metus ac, porttitor feugiat elit. Vestibulum varius ultricies ante, in convallis justo varius a.',
          contentCreator: 'Mister Four',
        },
        {
          contentId: 9,
          contentImageURL: '/article-nine',
          contentTitle: 'News Nine',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean orci e diam sapien, finibus eu metus ac, porttitor feugiat elit. Vestibulum varius ultricies ante, in convallis justo varius a.',
          contentCreator: 'Mister Nine',
        },
        {
          contentId: 10,
          contentImageURL: '/article-ten',
          contentTitle: 'News Ten',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean orci e diam sapien, finibus eu metus ac, porttitor feugiat elit. Vestibulum varius ultricies ante, in convallis justo varius a.',
          contentCreator: 'Mister Ten',
        },
        {
          contentId: 11,
          contentImageURL: '/article-eleven',
          contentTitle: 'News Eleven',
          contentDescription: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean orci e diam sapien, finibus eu metus ac, porttitor feugiat elit. Vestibulum varius ultricies ante, in convallis justo varius a.',
          contentCreator: 'Mister Eleven',
        },
      ]
      this.articleAndNews = tempContentArticle
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
        a {
          text-decoration: none;
          color: black;
        }
      }
    }

    .article-section {
      height: 70vh;
      width: 100%;
      margin-top: 4rem;

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