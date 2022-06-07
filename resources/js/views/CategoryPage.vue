<template>
  <div class="category-wrapper">
    <div class="title-category">
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
import ProjectCard from '../components/cardComponent/ArticleCard.vue'

import { mapGetters } from 'vuex'

export default {
  name: 'CategoryPage',
  components: {
    ProjectCard,
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
    }
  },
  methods: {
    async fetchAllProjectList () {
      await this.$store
        .dispatch('getAllCampaign')
        .then(res => {
          this.allProjectList = res.data.data.data
        })
        .catch(err => {
          console.error(err)
        })
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
    h1 {
      font-size: 48px;
      font-weight: 700;
      letter-spacing: 2px;

    }
    p {
      font-size: 18px;
      font-weight: 500;
      width: 70%;
      letter-spacing: 1px;
    }
  }

  .content-category {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    height: 100%;
    width: 100%;
  }

  .project-card-wrap {
    width: 20%;
    position: static;
    margin: 5rem 0;
    a {
      text-decoration: none;
      color: black;
    }
  }
}
</style>
