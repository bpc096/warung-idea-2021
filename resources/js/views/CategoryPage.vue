<template>
  <div class="category-wrapper">
    <loading
      :active="isLoading"
      :can-cancel="false"
      :is-full-page="true"
      :height="125"
      :width="125"
    />
    <div class="title-category">
      <div class="darker">
        <img
          :src="getCategoryBanner"
          alt="title-banner"
        >
      </div>
      <h1>{{ queryCategoryId }}</h1>
      <p>{{ getCategoryDescription }}</p>
    </div>
    <div class="content-category">
      <div v-for="(project, idx) in categoryProjectList" class="project-card-wrap" :key="idx">
        <a :href="'/projectdetail/'+ project.id">
          <ProjectCard
          :projectData="project"
          :isCampaign="true"
          />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
// Loading Component
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

// Component
import ProjectCard from '../components/cardComponent/ArticleCard.vue'

// Modules
import { mapGetters } from 'vuex'

export default {
  name: 'CategoryPage',
  components: {
    ProjectCard,
    Loading,
  },
  data : () => {
    return {
      categoryList: ['arts', 'technology', 'games', 'books', 'movies', 'health-and-fitness'],
      categoryDesc: [
        'Art is a diverse range of human activity, and resulting product, that involves creative or imaginative talent expressive of technical proficiency, beauty, emotional power, or conceptual ideas',
        'Technology is the result of accumulated knowledge and application of skills, methods, and processes used in industrial production and scientific research. Technology is embedded in the operation of all machines, with or without detailed knowledge of their function, for the intended purpose of an organization.',
        'A game is a structured form of play, usually undertaken for entertainment or fun, and sometimes used as an educational tool. Games are different from work, which is usually carried out for remuneration, and from art, which is more often an expression of aesthetic or ideological elements.',
        'A book is a medium for recording information in the form of writing or images, typically composed of many pages bound together and protected by a cover. The technical term for this physical arrangement is codex.',
        'A film – also called a movie, motion picture, moving picture, or photoplay – is a work of visual art that simulates experiences and otherwise communicates ideas, stories, perceptions, feelings, beauty, or atmosphere through the use of moving images.',
        'Regular exercise improves health and fitness. Health is defined as a state of complete mental, physical and social well-being; not merely the absence of illness or infirmity. Fitness is the ability to meet the demands of the environment.',
      ],
      categoryBanner: [
        'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80',
        'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80',
        'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80',
        'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80',
        'https://images.unsplash.com/photo-1615986201152-7686a4867f30?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1925&q=80',
        'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80',
      ],
      isExist: true,
      projectList: 7,
      projectId: 0,
      testDataProject: {
        image: '/project-img-url',
        title: 'Project Title',
        description: `Project ipsum dolor sit amet, consectetur adipiscing elit.
          Aenean orci e diam sapien, finibus eu metus ac,
          porttitor feugiat elit. Vestibulum varius ultricies ante,
          in convallis justo varius a.`
      },
      categoryProjectList: [],
      allProjectList: [],
      isLoading: true,
    }
  },
  created () {
    this.fetchAllProjectList()
  },
  computed: {
    ...mapGetters({
      allProjects: 'getAllCampaign',
    })
  },
  computed: {
    queryCategoryId () {
      this.updateProjectBasedOnCategory()
      const title = this.$route.params.categoryId.toUpperCase() || 'DEFAULT CATEGORY TITLE'
      return title.replaceAll('-',' ')
    },
    getCategoryId () {
      const checkExistId = this.categoryList.indexOf(this.$route.params.categoryId.toLowerCase())
      if(checkExistId >= 0) {
        return checkExistId + 1
      } else {
        return 0
      }
    },
    getCategoryDescription() {
      const categoryIndex = this.getCategoryId - 1
      return this.categoryDesc[categoryIndex]
    },
    getCategoryBanner() {
      const categoryIndex = this.getCategoryId - 1
      return this.categoryBanner[categoryIndex]
    }
  },
  methods: {
    async fetchAllProjectList () {
      this.isLoading = true
      await this.$store
        .dispatch('getAllCampaign')
        .then(res => {
          this.allProjectList = res.data.data.data
        })
        .catch(err => {
          console.error(err)
        })
      this.isLoading = false
    },
    updateProjectBasedOnCategory() {
      if (!this.allProjectList) return
      this.categoryProjectList = this.allProjectList.filter(project => parseInt(project.category_id) === this.getCategoryId)
    }
  }
}
</script>

<style lang="less" scoped>
.category-wrapper {
  height: 100%;
  min-height: 100vh;
  margin: 0 5rem 10rem 5rem;

  .title-category {
    text-align: left;
    margin: 5rem 2rem;
    min-height: 10rem;

    .darker {
      background-color: black;
      height: 20rem;
      width: 100%;
      position: absolute;
      left: 0;
      top: 4rem;
    }
    img {
      height: 20rem;
      width: 100%;
      background-size: auto;
      background-repeat: no-repeat;
      object-fit: cover;
      position: absolute;
      left: 0;
      opacity: 0.5;
    }
    h1 {
      font-size: 48px;
      font-weight: 700;
      letter-spacing: 2px;
      position: relative;
      z-index: 2;
      color: #fff;
    }
    p {
      font-size: 18px;
      font-weight: 500;
      width: 70%;
      letter-spacing: 1px;
      position: relative;
      z-index: 2;
      color: #fff;
    }
  }

  .content-category {
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    height: 100%;
    width: 100%;
  }

  @media (max-width: 1431px) {
    .content-category {
      display: grid;
      grid-template-columns: auto auto auto auto;
      height: 100%;
      width: 100%;
    }
  }

  @media (max-width: 1190px) {
    .content-category {
      display: grid;
      grid-template-columns: auto auto auto;
      height: 100%;
      width: 100%;
    }
  }

  @media (max-width: 931px) {
    .content-category {
      display: grid;
      grid-template-columns: auto auto;
      height: 100%;
      width: 100%;
    }
  }

  @media (max-width: 669px) {
    .content-category {
      display: grid;
      grid-template-columns: auto;
      height: 100%;
      width: 100%;
    }
  }

  .project-card-wrap {
    width: 100%;
    position: static;
    margin: 5rem 0;
    a {
      text-decoration: none;
      color: black;
    }
  }
}
</style>
