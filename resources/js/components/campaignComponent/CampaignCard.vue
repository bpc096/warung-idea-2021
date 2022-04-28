<template>
  <div class="campaign-card">
      <DeleteModal
        :showModal="showDeleteModal"
        @closeModal="closeDeleteModal"
      />
      <div class="campaign-image">
        <img :src="imageUrl" alt="campaign-image-project">
      </div>
      <div class="campaign-content">
        <div class="campaign-title">
          {{ projectTitle }}
        </div>
        <!-- <div class="campaign-desc">
          {{ projectDesc.slice(0,75) }} ...
        </div> -->
        <div v-if="!isInHistoryOwnedPage" class="campaign-donation-amount">
          Donation Amount
          <div class="donation-text">
            Rp {{ formatMoney(infoDonationAmount) }}
          </div>
        </div>
        <div v-if="!isInHistoryOwnedPage" class="campaign-payment-status">
          Payment status
          <div :class="['text-status', paymentStatus]">
            {{ paymentTextStatus }}
          </div>
          <button
            v-if="paymentStatus !== 'success-status'"
            class="btn-payment"
            @click="payment"
          >
           {{ payNowLabel }}
          </button>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryOwnedPage">
          <b>Campaign Config :</b>
          <a :href="`/projectdetail/${campaignId}`" class="btn-view-campaign mr">
            View Campaign
          </a>
          <a :href="`/campaign/edit/${campaignId}`" class="btn-edit-campaign">
            Edit Campaign
          </a>
          <button
            @click="openDeleteModal"
            class="btn-delete-campaign"
          >
            Delete Campaign
          </button>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryOwnedPage">
          <b>Updates Config :</b>
          <a :href="`/updates/create/${campaignId}`" class="btn-edit-campaign mr">
            Add New Updates
          </a>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryOwnedPage">
          <b>FAQ Config :</b>
          <a :href="`/faqs/create/${campaignId}`" class="btn-edit-campaign mr">
            Add New FAQ
          </a>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryOwnedPage">
          <b>Reward Config :</b>
          <a :href="`/rewards/create/${campaignId}`" class="btn-edit-campaign mr">
            Add New Reward
          </a>
        </div>
      </div>
    </div>
</template>

<script>
import DeleteModal from '../modalComponent/DeleteModal.vue'

export default {
  name: 'CampaignCard',
  components: {
    DeleteModal,
  },
  props: {
    isInHistoryOwnedPage: {
      type: Boolean,
      default: true,
    },
    donationInfo: {
      type: Object,
      default: () => {}
    },
    campaignInfo: {
      type: Object,
      default: () => {}
    }
},
  data: () => {
    return {
      showDeleteModal: false,
      continueDelete: false,
      progress: '59',
      paymentTextStatus: 'PENDING',
      paymentStat: 'pending',
      dummyImgUrl: 'https://images.unsplash.com/photo-1643223723262-7ce785730cf6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80',
    }
  },
  computed: {
    payNowLabel() {
      return '💸 Pay Now !'
    },
    projectDesc() {
      return this.campaignInfo?.description? this.campaignInfo.description : 'Lorem ipsum dolor sitamet consectetur adipisicing elit. Ratione, quaerat.'
    },
    campaignId (){
      return this.campaignInfo?.id? this.campaignInfo.id : '1'
    },
    imageUrl () {
      return (this.campaignInfo && this.campaignInfo.image) ? this.campaignInfo.image : this.dummyImgUrl
    },
    infoDonationAmount () {
      return this.donationInfo?.amount? this.donationInfo.amount : '10000'
    },
    projectTitle () {
      return this.campaignInfo?.title? this.campaignInfo.title : 'Title Campaign'
    },
    checkEligibleToEdit() {
      // TODO : Check Eligiblelity to edit campaign
      return true
    },
    paymentStatus () {
      let paymentStyle = ''
      if (this.donationInfo.status === 'pending') {
        this.paymentTextStatus = 'PENDING'
        paymentStyle = 'pending-status'
      } else if (this.donationInfo.status === 'success') {
        this.paymentTextStatus = 'SUCCESS'
        paymentStyle = 'success-status'
      } else {
        this.paymentTextStatus = 'FAILED'
        paymentStyle = 'failed-status'
      }
      return paymentStyle
    }
  },
  methods: {
    closeDeleteModal(isContinue) {
      this.showDeleteModal = false
      if(isContinue) {
        this.deleteCampaign()
      }
    },
    openDeleteModal(){
      this.showDeleteModal = true
    },
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
    deleteCampaign () {
      console.log('Request Delete Approval')
      // TODO : Uncomment Code
      /*
      this.$store.dispatch('deleteCampaign', this.campaignId)
        .then(res => {
          this.$router.go(0)
        })
        .catch(err => {
          console.error(err)
        })
      */
    },
    payment() {
      if(!this.donationInfo || !this.donationInfo.snap_token) return
      window.snap.pay(this.donationInfo.snap_token, {
        onSuccess: () => {
          this.paymentStat = 'success'
          let toast = this.$toasted.success('Payment Success ⌛ ✅')
          toast.goAway(1500)
        },
        onPending: () => {
          this.paymentStat = 'pending'
          let toast = this.$toasted.info('Payment Pending ⚠️')
          toast.goAway(1500)
        },
        onError: () => {
          this.paymentStat = 'failed'
          let toast = this.$toasted.error('Payment Failed ❌')
          toast.goAway(1500)
        }
      })
    }
  }
}
</script>

<style lang="less" scoped>
.campaign-card {
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 55rem;
    min-height: 10rem;
    margin: 2rem 0;

    .campaign-image {
      width: 30%;
      margin-right: 3px;
      img {
        width: 100%;
        height: 100%;
      }
    }

    .campaign-content {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      width: 100%;

      .campaign-title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
      }

      .campaign-desc {
        text-align: left;
        font-size: 15px;
        font-weight: lighter;
        margin: 10px 0;
      }

      .campaign-donation-status {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        align-items: center;

        .shell {
          width: 250px;
          border: 1px solid #aaa;
          border-radius: 13px;
          padding: 3px;
          margin-left: 20px;


          .bar-progress {
            background: linear-gradient(to right, #11998e, #38ef7d);
            height: 20px;
            width: 50%;
            border-radius: 9px;
            span {
              float: right;
              padding: 2px;
              color: black;
              font-size: 0.7em
            }
          }
        }
      }

      .campaign-donation-amount {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        align-items: center;

        .donation-text {
          font-weight: 500;
          color: black;
          padding: 2px;
          min-width: 10rem;
          border-radius: 10px;
          justify-self: center;
        }
      }

      .campaign-payment-status {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        align-items: center;
        margin-right: 1.5rem;

        .text-status {
          font-weight: 500;
          color: black;
          padding: 2px;
          min-width: 10rem;
          letter-spacing: 2px;
          border-radius: 10px;
          margin-left: 2rem;


          &.pending-status {
            background-color: yellow;
          }

          &.success-status {
            background-color: #38ef7d;
          }

          &.failed-status {
            background-color: red;
          }
        }

        .btn-payment {
          text-decoration: none;
          color: black;
          border: 1px solid pink;
          border-radius: 10px;
          padding: 5px;
          background-color: salmon;
          margin-left: 1rem;
        }
      }


      .campaign-wrap-button {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0 20px 25px;

        .btn-view-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid pink;
          border-radius: 10px;
          padding: 5px;
          background-color: pink;
          min-width: 150px;
          &.mr {
            margin-left: 1rem;
          }
        }

        .btn-edit-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid #4FBDBA;
          border-radius: 10px;
          padding: 5px;
          background-color: #4FBDBA;
          margin: 0 10px;
          min-width: 150px;
        }

        .btn-delete-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid #FF5959;
          border-radius: 10px;
          padding: 5px;
          background-color: #FF5959;
          margin-right: 10px;
          min-width: 150px;
        }
      }
    }
  }
</style>
