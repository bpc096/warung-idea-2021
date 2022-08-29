<template>
  <div class="search-campaign-wrap">
    <div class="row d-flex justify-content-center my-5">
      <div class="input-group">
        <input
          v-model="searchInput"
          type="text"
          class="form-control mr-2 text-center border border-dark"
          placeholder="Search Campaign Here..."
          style="border-radius: 19px;"
        >
      </div>
    </div>
    <div v-if="listResultData.length > 0" class="content-wrap">
      <div v-for="(project, idx) in listResultData" class="project-card-wrap" :key="idx">
        <router-link :to="'/projectdetail/'+ project.id">
          <ProjectCard
            :projectData="project"
            :isCampaign="true"
          />
        </router-link>
      </div>
    </div>
    <div v-if="checkEmptySearchInput && listResultData.length<=0" class="default-state">
      <div class="image-wrapper">
        <img src="\images\searching_illustration.svg" alt="searching-illustration">
      </div>
    </div>
    <div v-if="isNotFound" class="empty-state">
      <i class="fa-solid fa-circle-exclamation fa-10x"></i>
      <h2>Ups... Campaign Not Found!</h2>
    </div>
  </div>
</template>

<script>
import Axios from 'axios'
import ProjectCard from '../../components/cardComponent/ArticleCard.vue'

export default {
  name: 'SearchCampaignPage',
  components: {
    ProjectCard,
  },
  data: () => {
    return {
      searchInput: '',
      listResultData: [],
      isNotFound: false,
      debounce: null
    }
  },
  watch: {
    searchInput(newWord, oldWord) {
      clearTimeout(this.debounce)
      this.debounce = setTimeout(() => {
        this.listResultData = []
        this.isNotFound = false
        this.searchCampaign(newWord)
      }, 600)
    }
  },
  computed: {
    checkEmptySearchInput() {
      if(this.searchInput === "") {
        this.listResultData = []
        this.isNotFound = false
      }

      return this.searchInput === ""
    }
  },
  methods: {
    searchCampaign(param) {
      let apiUrl = `campaign/search/${param}`
      Axios.get(apiUrl)
        .then(res => {
          if(res.data  && res.data.data && res.data.data.length > 0) {
            this.listResultData = res.data.data
          } else {
            this.listResultData = []
            if(this.searchInput === "") {
              this.isNotFound = false
            } else {
              this.isNotFound = true
            }
          }
        })
        .catch(err => {
          this.listResultData = []
          this.isNotFound = false
          console.error(err)
        })
    }
  }
}
</script>

<style lang="less">
.search-campaign-wrap {
  height: 100%;
  min-height: 100vh;
  margin: 0 5rem 10rem 5rem;

  .row {
    .input-group {
      width: 60%;
    }
  }

  .image-wrapper {
    img {
      border-radius: 10px;
      width: 35rem;
      height: 35rem;
    }
    margin-top: 2rem;
    margin-bottom: 2rem;
  }

  .default-state {
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 60vh;

    h2 {
      margin-top: 5rem;
    }
  }

  .content-wrap {
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    height: 100%;
    width: 100%;
  }

  @media (max-width: 1431px) {
    .content-wrap {
      display: grid;
      grid-template-columns: auto auto auto auto;
      height: 100%;
      width: 100%;
    }
  }

  @media (max-width: 1190px) {
    .content-wrap {
      display: grid;
      grid-template-columns: auto auto auto;
      height: 100%;
      width: 100%;
    }
  }

  @media (max-width: 931px) {
    .content-wrap {
      display: grid;
      grid-template-columns: auto auto;
      height: 100%;
      width: 100%;
    }
  }

  @media (max-width: 669px) {
    .content-wrap {
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
