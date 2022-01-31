<template>
  <div class="project-detail-page">
    <RewardModal
      v-if="showRewardModal"
      :campaignId="projectId"
      @close="closeModal"
    />
    <div class="wrap-title">
      <div class="main-title">{{ projectTitle }}</div>
      <div class="main-desc">{{ projectQuickDesc }}</div>
    </div>
    <div class="wrap-main-section">
      <div class="project-detail-section">
        <div class="progress-bar-custom">
          <div class="progress-color-custom"></div>
        </div>
        <div class="total-donate-info">
          Rp 1.000.000 dari Rp {{ projectTargetDonation }}
        </div>
        <div class="supporter-info">
          270 Penyumbang
        </div>
        <div class="day-left-info">
          {{ daysBetween }} Hari lagi
        </div>
        <div class="button-wrapper">
          <button
            class="btn-support"
            @click="btnSupportHandle"
          >
            Support Now
          </button>
          <button
            class="btn-remind"
            @click="btnRemindMeHandle"
          >
            Remind Me Later
          </button>
        </div>
      </div>
      <div class="project-image-section">
        <div class="image">
          <img :src="imageUrl" alt="project-detail-image">
        </div>
      </div>
    </div>
    <div class="wrap-tab-section">
      <tabs>
        <tab name="Campaign" :selected="true">
          <campaignTab
            :projectDesc="projectFullDesc"
          />
        </tab>
        <tab name="Updates">
          <updateTab />
        </tab>
        <tab name="FAQ">
          <faqTab />
        </tab>
        <tab name="Collaborator">
          <creatorTab />
        </tab>
      </tabs>
    </div>
  </div>
</template>

<script>
// Tab Component
import tab from  '../components/tabComponent/tabComponent.vue'
import tabs from '../components/tabComponent/tabsComponent.vue'

// Content Tab Component
import campaignTab from '../views/tabViews/CampaignTab.vue'
import updateTab from '../views/tabViews/UpdateTab.vue'
import faqTab from '../views/tabViews/FaqTab.vue'
import creatorTab from '../views/tabViews/CreatorTab.vue'

// Modal
import RewardModal from '../components/RewardModal.vue'

export default {
  name: 'ProjectDetail',
  components: {
    tab,
    tabs,
    campaignTab,
    updateTab,
    faqTab,
    RewardModal,
    creatorTab,
  },
  data: () => {
    return {
      showRewardModal: false,
      projectDetail: {
        dummyUrlImage: 'https://images.unsplash.com/photo-1643226224903-e1f7cbb9fa10?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80'
      }
    }
  },
  async created () {
    await this.$store
      .dispatch('getCampaignById', this.$route.params.projectId)
      .then((res) => {
        this.projectDetail = res.data
      })
      .catch(err => {
        console.log(err)
      })
  },
  computed: {
    projectId () {
      return this.$route.params.projectId
    },
    imageUrl () {
      return this.projectDetail?.image? this.projectDetail.image : this.projectDetail.dummyUrlImage
    },
    daysBetween () {
      const maxDate = this.projectDetail?.max_date? this.projectDetail.max_date : '2045-06-30'

      const oneDay = 24 * 60 * 60 * 1000
      const firstDate = new Date()
      const secondDate = new Date(maxDate)
      const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay))
      return diffDays.toString()
    },
    projectTitle () {
      return this.projectDetail?.title? this.projectDetail.title : 'Project Title'
    },
    projectTargetDonation () {
      return this.projectDetail?.target_donation? this.projectDetail.target_donation.toString() : '10.000.000'
    },
    projectQuickDesc () {
      return this.projectDetail?.description? this.projectDetail.description.slice(0,100) : 'Project Description'
    },
    projectFullDesc () {
      return this.projectDetail?.description? this.projectDetail.description : 'Project Description'
    }
  },
  methods: {
    btnSupportHandle () {
      console.log('CLICK SUPPORT')
      this.showRewardModal = true
      // CHECK USER AUTH BEFORE SHOW MODAL
      // IF USER NOT LOGGED IN REDIRECT TO LOGIN OR REGISTER PAGE
    },
    closeModal () {
      this.showRewardModal = false
    },
    btnRemindMeHandle () {
      console.log('CLICK REMIND ME')
    }
  }
}
</script>

<style lang="less" scoped>
.project-detail-page {
  .wrap-title {
    margin-bottom: 2rem;
    .main-title {
      font-size: 4rem;
    }
  }

  .wrap-main-section{
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 100%;
    .project-detail-section{
      width: 100%;
      height: 40vh;
      text-align: left;
      margin: 3rem 0 3rem 3rem;
      font-size: 1.5rem;

      .progress-bar-custom{
        width: 20rem;
        height: 1.5rem;
        border: 2px solid black;
        margin-bottom: 30px;

        .progress-color-custom{
          width: 50%;
          height: 100%;
          background-color: green;
        }
      }

      .total-donate-info{
        margin-bottom: 30px;
      }

      .supporter-info{
        display: flex;
        flex-direction: row;
        margin-bottom: 30px;
      }

      .day-left-info{
        margin-bottom: 30px;
      }

      .button-wrapper {
        display: flex;
        flex-direction: row;

        .btn-support{
          border: 1px solid black;
          border-radius: 25px;
          padding: 10px;
          margin-right: 1rem;
          &:hover{
            background-color: black;
            color: white;
          }
        }

        .btn-remind{
          margin: 0 .5rem;
          border: 1px solid black;
          border-radius: 25px;
          padding: 10px;

          &:hover{
            background-color: black;
            color: white;
          }
        }
      }
    }
    .project-image-section{
      width: 100%;
      height: 50vh;
      display: flex;
      justify-content: center;
      align-items: center;
      .image {
        width: 80%;
        height: 80%;
        background-color: blue;

        img {
          width: 100%;
          height: 100%;
        }
      }
    }
  }
}
</style>
