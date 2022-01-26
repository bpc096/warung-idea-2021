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

export default {
  name: 'CategoryPage',
  components: {
    ProjectCard,
  },
  data : () => {
    return {
      categoryId: 0,
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
  mounted () {
    this.fetchAllProjectList()
    this.fetchProjectBasedOnCategory()
  },
  updated () {
    this.fetchProjectBasedOnCategory()
  },
  computed: {
    queryCategoryId () {
      return this.$route.params.categoryId.toUpperCase()
    },
    getCategoryId () {
      const categoryList = ['arts', 'technology', 'games', 'books', 'movies', 'health-and-fitness']
      const checkExistId = categoryList.indexOf(this.$route.params.categoryId.toLowerCase())
      if(checkExistId >= 0) {
        this.categoryId = checkExistId + 1
      } else {
        this.categoryId = 0
      }
      return this.categoryId
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
    fetchProjectBasedOnCategory () {
      this.categoryProjectList = this.allProjectList.filter(project => project.category_id === this.getCategoryId)
    }
  }
}
</script>

<style lang="less" scoped>
.category-wrapper {
  height: 100%;
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
