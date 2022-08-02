<template>
  <div class="project-detail-page">
    <loading
        :active="isLoading"
        :can-cancel="false"
        :is-full-page="true"
        :height="125"
        :width="125"
      />
    <transition name="fade" appear>
      <div class="modal-overlay"
        v-if="showRewardModal"
        @click="showRewardModal = false"></div>
    </transition>
    <transition name="pop" appear>
      <RewardModal
        v-if="showRewardModal"
        :userId="user.id"
        :isUserCollaborator="checkCollaboratorId"
        :ownerId="projectDetail.users_id"
        :campaignId="projectDetail.id"
        @close="closeModal"
      />
    </transition>
    <div class="wrap-title">
      <div class="main-title">{{ projectTitle }}</div>
      <div class="main-desc">{{ projectQuickDesc }}</div>
    </div>
    <div class="wrap-main-section">
      <div class="project-detail-section">
        <div class="progress-bar-custom">
          <div
            class="progress-color-custom"
            :style="{width: progressPercentage + '%'}"
          ></div>
        </div>
        <div class="total-donate-info">
          <img src="\images\icon\money-bag.svg" alt="icon-backers">
          Rp {{ formatMoney(totalPayment) }} dari Rp {{ formatMoney(projectTargetDonation) }}
        </div>
        <div class="supporter-info">
          <img src="\images\icon\solidarity.svg" alt="icon-backers">
          {{ totalBacker }} Penyumbang
        </div>
        <div class="day-left-info">
          <img src="\images\icon\hourglass.svg" alt="icon-backers">
          {{ daysBetween }}
        </div>
        <div class="day-left-info">
          Dibuat oleh <b>{{ displayCreatorName }}</b>
        </div>
        <div class="button-wrapper">
          <button
            class="btn-support"
            @click="btnSupportHandle"
            :disabled="isProjectAvailable"
          >
            🚀 Support Now
          </button>
          <button
            class="btn-remind"
            @click="btnRemindMeHandle"
            :disabled="isProjectAvailable"
          >
            ⭐ Remind Me Later
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
            :projectPlan="projectPlanDesc"
          />
        </tab>
        <tab name="Updates">
          <updateTab
            :userId="user.id"
            :isUserCollaborator="checkCollaboratorId"
            :ownerId="parseInt(projectDetail.users_id)"
            :campaignId="projectDetail.id"
            :updateListData="updateTabData"
          />
        </tab>
        <tab name="FAQ">
          <faqTab
            :userId="user.id"
            :isUserCollaborator="checkCollaboratorId"
            :ownerId="parseInt(projectDetail.users_id)"
            :campaignId="projectDetail.id"
            :faqListData="faqTabData"
          />
        </tab>
        <tab name="Collaborator">
          <creatorTab
            :creatorListData="creatorTabData"
          />
        </tab>
        <tab name="Payment">
          <paymentTab/>
        </tab>
        <tab name="Forum">
          <forumTab
            :projectData="projectDetail"
          />
        </tab>
      </tabs>
    </div>
  </div>
</template>

<script>
// Loading Component
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

// Tab Component
import tab from  '../components/tabComponent/tabComponent.vue'
import tabs from '../components/tabComponent/tabsComponent.vue'

// Content Tab Component
import campaignTab from '../views/tabViews/CampaignTab.vue'
import updateTab from '../views/tabViews/UpdateTab.vue'
import faqTab from '../views/tabViews/FaqTab.vue'
import creatorTab from '../views/tabViews/CreatorTab.vue'
import forumTab from '../views/tabViews/forumTab.vue'
import paymentTab from '../views/tabViews/paymentTab.vue'

// Modal
import RewardModal from '../components/modalComponent/RewardModal.vue'

import { mapGetters } from 'vuex'

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
    forumTab,
    paymentTab,
    Loading
  },
  data: () => {
    return {
      showRewardModal: false,
      projectDetail: {
        dummyUrlImage: 'https://images.unsplash.com/photo-1643226224903-e1f7cbb9fa10?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80'
      },
      sumPayment: [],
      progress: '80',
      payment: [],
      updateTabData: [],
      faqTabData: [],
      creatorTabData: [],
      campaignID: '',
      isLoading: true,
    }
  },
  async created () {
    await this.fetchingCampaignInfo()
    await this.fetchingUpdateTabData()
    await this.fetchingFaqTabData()
    this.isLoading = false
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    checkCollaboratorId() {
      if(!this.projectDetail || !this.projectDetail.collaborators || this.projectDetail.collaborators.length === 0) return false

      const isUserCollaborator = this.projectDetail.collaborators.findIndex(x => parseInt(x) === this.user.id)
      return isUserCollaborator >= 0
    },
    isProjectAvailable() {
      const maxDate = this.checkMaxDate()
      return maxDate.datePass
    },
    displayCreatorName () {
      const name = this.projectDetail?.user?.name? this.projectDetail.user.name : 'Anonymous'
      return name
    },
    totalBacker() {
      return this.payment.length
    },
    totalPayment() {
      return this.sumPayment[0]?.total? this.sumPayment[0].total : '0'
    },
    progressPercentage() {
      let progressBar = '1'
      if(this.sumPayment.length > 0) {
        progressBar = this.sumPayment[0]?.total? this.paymentPercentage : '1'
      }
      if(parseInt(progressBar) <= 0) {
        progressBar = '1'
      }
      else if (parseInt(progressBar) >= 100) {
        progressBar = '100'
      }
      return progressBar
    },
    paymentPercentage() {
      const mathPercentage = Math.floor((parseInt(this.totalPayment)/parseInt(this.projectTargetDonation)) * 100)
      return mathPercentage
    },
    projectId () {
      return this.$route.params.projectId
    },
    imageUrl () {
      return (this.projectDetail && this.projectDetail.image) ?  this.projectDetail.image : this.projectDetail.dummyUrlImage
    },
    daysBetween () {
      const maxDate = this.checkMaxDate()
      let dayBetween = ''

      if(maxDate.datePass) {
        dayBetween = 'Proyek telah selesai!'
      } else {
        const oneDay = 24 * 60 * 60 * 1000
        const firstDate = new Date()
        const secondDate = new Date(maxDate.tempDate)
        const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay))
        dayBetween = diffDays.toString() + ' Hari Lagi'
      }
      return dayBetween
    },
    projectTitle () {
      return this.projectDetail?.title? this.projectDetail.title : 'Project Title'
    },
    projectTargetDonation () {
      return this.projectDetail?.target_donation? this.projectDetail.target_donation.toString() : '10.000.000'
    },
    projectQuickDesc () {
      return this.projectDetail?.short_description ? this.projectDetail.short_description.slice(0,100) : 'Project Short Desc'
    },
    projectFullDesc () {
      return this.projectDetail?.description? this.projectDetail.description : 'Project Description'
    },
    projectPlanDesc() {
      return this.projectDetail?.project_plan ? this.projectDetail.project_plan : 'Project Plan'
    }
  },
  methods: {
    async fetchingFaqTabData () {
      const campaignId = this.$route.params.projectId
      await this.$store
        .dispatch('getFaqByCampaignId', campaignId)
        .then(res => {
          if(res.success && res.data && res.data.length > 0) {
            this.faqTabData = res.data
          }
        })
        .catch(err => {
          console.error(err)
        })
    },
    async fetchingUpdateTabData () {
      const campaignId = this.$route.params.projectId
      await this.$store
        .dispatch('getUpdatesByCampaignId', campaignId)
        .then(res => {
          if(res.success && res.data && res.data.length > 0) {
            this.updateTabData = res.data
          }
        })
        .catch(err => {
          console.error(err)
        })
    },
    async fetchingCampaignInfo () {
      await this.$store
        .dispatch('getCampaignById', this.$route.params.projectId)
        .then((res) => {
          this.payment = res.payments || []
          this.projectDetail = res.data
          this.sumPayment = res.data.sum_payment

          if(res.collaborators && res.collaborators.length > 0) {
            this.creatorTabData = this.filterCollaboratorData(res.collaborators)
          }
        })
        .catch(err => {
          console.log(err)
        })
    },
    filterCollaboratorData (listData) {
      const filteredData = listData.filter(x => x.status === 'accept')
      return filteredData
    },
    formatMoney(money) {
      const moneyTemp = money ? parseInt(money) : 10000
      const formatter = new Intl.NumberFormat('en-ID', {
        style: 'currency',
        currency: 'IDR'
      }).format(moneyTemp)
      .replace(/[IDR]/gi, '')
      .replace(/(\.+\d{2})/, '')
      .replace(/,/g, '.')
      .trimLeft()
      return formatter
    },
    checkMaxDate(){
      const projectDate = this.projectDetail && this.projectDetail.max_date ? this.projectDetail.max_date : "2018-05-30"
      let checkMaxDate = ''
      let datePassed = false

      if(new Date(projectDate).getTime() > new Date().getTime()) {
        checkMaxDate = projectDate
      } else {
        checkMaxDate = projectDate
        datePassed = true
      }
      return {tempDate: checkMaxDate, datePass: datePassed}
    },
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
      let toast = this.$toasted.success("We Will Remind You Later ❤️")
      toast.goAway(1500);
    }
  }
}
</script>

<style lang="less" scoped>
.project-detail-page {
  .modal-overlay {
    content: '';
    position: absolute;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 998;
    background: black;
    opacity: 0.6;
    cursor: pointer;
  }

  .fade-enter-active,
  .fade-leave-active {
    transition: opacity .4s linear;
  }

  .fade-enter,
  .fade-leave-to {
    opacity: 0;
  }

  .pop-enter-active,
  .pop-leave-active {
    transition: transform 0.4s cubic-bezier(0.5, 0, 0.5, 1), opacity 0.4s linear;
  }

  .pop-enter,
  .pop-leave-to {
    opacity: 0;
    transform: scale(0.3) translateY(-50%);
  }



  .wrap-title {
    margin: 4rem 0;
    .main-title {
      font-size: 4rem;
    }
  }

  .wrap-main-section{
    border-top: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 100%;

    .project-detail-section{
      width: 100%;
      height: 50vh;
      text-align: left;
      margin: 3rem 0 3rem 7rem;
      font-size: 1.5rem;

      .progress-bar-custom{
        width: 25rem;
        height: 2rem;
        border: 2px solid black;
        border-radius: 10px;
        margin-bottom: 30px;

        .progress-color-custom{
          height: 100%;
          background-color: #1FAB89;
          border-radius: 10px;
        }
      }

      .total-donate-info{
        margin-bottom: 30px;
        img {
          margin-right: 1rem;
        }
      }

      .supporter-info{
        display: flex;
        flex-direction: row;
        margin-bottom: 30px;
        align-items: center;
        img {
          margin-right: 1.7rem;
        }
        i {
          margin-right: 1.7rem;
        }
      }

      .day-left-info{
        margin-bottom: 30px;
        img {
          margin-right: 1rem;
        }
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
            background-color: #B4E197;
            border: 1px solid white;
            color: white;
          }
        }

        .btn-remind{
          margin: 0 .5rem;
          border: 1px solid black;
          border-radius: 25px;
          padding: 10px;

          &:hover{
            background-color: #A85CF9;
            border: 1px solid white;
            color: white;
          }
        }
      }
    }
    .project-image-section{
      width: 100%;
      height: 55vh;
      display: flex;
      justify-content: center;
      align-items: center;
      .image {
        width: 80%;
        height: 80%;
        max-width: 48rem;

        img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }
    }
  }
}
</style>
