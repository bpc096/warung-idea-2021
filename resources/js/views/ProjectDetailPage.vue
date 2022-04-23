<template>
  <div class="project-detail-page">
    <RewardModal
      v-if="showRewardModal"
      :userId="user.id"
      :ownerId="projectDetail.users_id"
      :campaignId="projectDetail.id"
      @close="closeModal"
    />
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
          Rp {{ formatMoney(totalPayment) }} dari Rp {{ formatMoney(projectTargetDonation) }}
        </div>
        <div class="supporter-info">
          {{ totalBacker }} Penyumbang
        </div>
        <div class="day-left-info">
          {{ daysBetween }}
        </div>
        <div class="day-left-info">
          Created by <b>{{ displayCreatorName }}</b>
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
          <updateTab
            :userId="user.id"
            :ownerId="projectDetail.users_id"
            :campaignId="projectDetail.id"
          />
        </tab>
        <tab name="FAQ">
          <faqTab
            :userId="user.id"
            :ownerId="projectDetail.users_id"
            :campaignId="projectDetail.id"
          />
        </tab>
        <tab name="Collaborator">
          <creatorTab />
        </tab>
        <tab name="Payment">
          <paymentTab />
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
    paymentTab
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
    }
  },
  async created () {
    await this.$store
      .dispatch('getCampaignById', this.$route.params.projectId)
      .then((res) => {
        this.payment = res.payments || []
        this.projectDetail = res.data
        this.sumPayment = res.data.sum_payment
      })
      .catch(err => {
        console.log(err)
      })
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
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
      return this.projectDetail?.image? this.projectDetail.image : this.projectDetail.dummyUrlImage
    },
    daysBetween () {
      const maxDate = this.projectDetail?.max_date? this.checkMaxDate(this.projectDetail.max_date) : '2045-06-30'
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
      return this.projectDetail?.description? this.projectDetail.description.slice(0,100) : 'Project Description'
    },
    projectFullDesc () {
      return this.projectDetail?.description? this.projectDetail.description : 'Project Description'
    }
  },
  methods: {
    formatMoney(money) {
      const moneyTemp = money ? parseInt(money) : 10000
      const formatter = new Intl.NumberFormat('en-ID', {
        style: 'currency',
        currency: 'IDR'
      }).format(moneyTemp)
      .replace(/[IDR]/gi, '')
      .replace(/(\.+\d{2})/, '')
      .trimLeft()
      return formatter
    },
    checkMaxDate(date){
      // let tempDate = '2055-05-05'
      let checkMaxDate = ''
      let datePassed = false
      if(new Date(date).getTime() > new Date().getTime()) {
        checkMaxDate = date
      } else {
        checkMaxDate = date
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
    border-top: 1px solid black;
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
            background-color: green;
            color: white;
          }
        }

        .btn-remind{
          margin: 0 .5rem;
          border: 1px solid black;
          border-radius: 25px;
          padding: 10px;

          &:hover{
            background-color: blueviolet;
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

        img {
          width: 100%;
          height: 100%;
        }
      }
    }
  }
}
</style>
