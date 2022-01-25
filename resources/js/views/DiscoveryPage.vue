<template>
  <div class="discover-wrapper">
    <div v-for="(category, index) in categoryList" class="category-area" :key="index">
      <router-link 
        :to="`/category/` + category.categoryId" 
        :style="{backgroundImage: `url(${category.url})`}"
        class="category-button" 
      >
        {{ category.title }}
      </router-link>  
    </div>
  </div> 
</template>

<script>
export default {
  name: 'Discoverypage',
  data: () => {
    return {
      // REFACTOR WITH TITLE & URL
      categoryList: [
        {
          categoryId: 'CAT01',
          title: 'Art & Creativity',
          url: 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80',
        },
        {
          categoryId: 'CAT02',
          title: 'Technology',
          url: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80'
        },
        {
          categoryId: 'CAT03',
          title: 'Games',
          url: 'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80'
        },
        {
          categoryId: 'CAT04',
          title: 'Books',
          url: 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80'
        },
        {
          categoryId: 'CAT05',
          title: 'Music',
          url: 'https://images.unsplash.com/photo-1468164016595-6108e4c60c8b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80'
        },
        {
          categoryId: 'CAT06',
          title: 'Health & Fitness',
          url: 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80'
        }
      ],
    }
  },
  computed: {
    composeURL (id) {
      return '/category/' + id
    }
  }
}
</script>

<style lang="less" scoped>
.discover-wrapper {
  display: grid;
  grid-template-columns: 50% 50%;
  // grid-template-rows: 20% 20%;
  // align-content: space-around;

  .category-area {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;

    a {
      text-decoration: none;
      color: white;
    }

    .category-button {
      background-color: black;
      border-radius: 20px;
      height: 30%;
      width: 80%;

      display: flex;
      justify-content: center;
      align-items: center;

      font-size: 30px;
      font-weight: bold;
      letter-spacing: 10px;

      background-repeat: no-repeat;
      background-size: 100%;
      background-position: center;

      box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
      transition: 0.5s;

      &:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
      }
    }
  }
}
</style>