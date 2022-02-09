<template>
  <div class="category-wrapper">
    <div class="title-category">
      <h1>{{ queryCategoryId }}</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id labore ullam nobis neque ipsa nesciunt ea et dolor fuga adipisci?</p>
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
      return this.$route.params.categoryId.toUpperCase()
    },
    getCategoryId () {
      const checkExistId = this.categoryList.indexOf(this.$route.params.categoryId.toLowerCase())
      if(checkExistId >= 0) {
        return checkExistId + 1
      } else {
        return 0
      }
    },
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
  margin: 0 2rem;

  .title-category {
    margin: 5rem 0;
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
