<template>
  <div class="category-wrapper">
    <div class="title-category">
      <h1>{{ checkQueryCategoryId }}</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id labore ullam nobis neque ipsa nesciunt ea et dolor fuga adipisci?</p>
    </div>
    <div class="content-category">
      <div v-for="(project, idx) in projectList" class="project-card-wrap" :key="idx">
        <a :href="'/projectdetail/'+ projectId">
          <ProjectCard
          :articleData="testDataProject"
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
      isExist: true,
      projectList: 7,
      projectId: 'id-sekian',
      testDataProject: {
        image: '/project-img-url',
        title: 'Project Title',
        description: `Project ipsum dolor sit amet, consectetur adipiscing elit.
          Aenean orci e diam sapien, finibus eu metus ac,
          porttitor feugiat elit. Vestibulum varius ultricies ante,
          in convallis justo varius a.`
      }
    }
  },
  computed: {
    checkQueryCategoryId () {
      return this.$route.params.categoryId.toUpperCase()
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
