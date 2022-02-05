<template>
  <div class="campaign-card">
      <div class="campaign-image">
        <img :src="imageUrl" alt="campaign-image-project">
      </div>
      <div class="campaign-content">
        <div class="campaign-title">
          {{ projectTitle }}
        </div>
        <div class="campaign-desc">
          Lorem ipsum dolor sit
          amet consectetur adipisicing elit. Ratione, quaerat.
        </div>
        <div class="campaign-donation-status">
          Donation Target
          <div class="shell">
            <div
              class="bar-progress"
              :style="{width: progressPercentage + '%'}"
            >
              <span>{{ progressPercentage }}%</span>
            </div>
          </div>
          <div class="campaign-wrap-button" v-if="!isInHistoryCampaignPage">
            <a
              :href="`/projectdetail/${campaignId}`"
              class="btn-view-campaign mr"
            >
             View Campaign
            </a>
          </div>
        </div>
        <div v-if="!isInHistoryCampaignPage" class="campaign-donation-amount">
          Donation Amount
          <div class="donation-text">
            Rp {{ infoDonationAmount }}
          </div>
        </div>
        <div v-if="!isInHistoryCampaignPage" class="campaign-payment-status">
          Payment status
          <div :class="['text-status', paymentStatus]">
            {{ paymentTextStatus }}
          </div>
          <button
            class="btn-payment"
            @click="payment"
          >
            Pay Now !
          </button>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryCampaignPage">
          <a :href="`/projectdetail/${campaignId}`" class="btn-view-campaign">
            View Campaign
          </a>
          <a :href="`/campaign/edit/${campaignId}`" class="btn-edit-campaign">
            Edit Campaign
          </a>
          <button
            @click="deleteCampaign"
            class="btn-delete-campaign"
          >
            Delete Campaign
          </button>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'CampaignCard',
  props: {
    isInHistoryCampaignPage: {
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
      progress: '59',
      paymentTextStatus: 'PENDING',
      paymentStat: 'pending',
      dummyImgUrl: 'https://images.unsplash.com/photo-1643223723262-7ce785730cf6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80',
    }
  },
  computed: {
    campaignId (){
      return this.campaignInfo?.id? this.campaignInfo.id : '1'
    },
    imageUrl () {
      return this.campaignInfo?.image? this.campaignInfo.image : this.dummyImgUrl
    },
    infoDonationAmount () {
      return this.donationInfo?.amount? this.donationInfo.amount : '10000'
    },
    projectTitle () {
      return this.campaignInfo?.title? this.campaignInfo.title : 'Title Campaign'
    },
    progressPercentage() {
      const randomNumb = Math.floor((Math.random() * 100) + 1)
      let progressBar = randomNumb.toString()
      if(this.sumPayment && this.sumPayment.length > 0) {
        progressBar = this.sumPayment[0]?.total? this.paymentPercentage : randomNumb.toString()
      }
      if(parseInt(progressBar) <= 0) {
        progressBar = '1'
      }
      else if (parseInt(progressBar) >= 100) {
        progressBar = '100'
      }
      return progressBar
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
    deleteCampaign(){
      this.$store.dispatch('deleteCampaign', this.campaignId)
        .then(res => {
          this.$router.go(0)
        })
        .catch(err => {
          console.error(err)
        })
    },
    payment() {
      if(!this.donationInfo || !this.donationInfo.snap_token) return

      window.snap.pay(this.donationInfo.snap_token, {
        onSuccess: () => {
          this.paymentStat = 'success'
          console.log('SUCCESS')
        },
        onPending: () => {
          this.paymentStat = 'pending'
          console.log('PENDING')
        },
        onError: () => {
          this.paymentStat = 'failed'
          console.log('ERROR')
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
    width: 50rem;
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

      .campaign-title {
        text-align: left;
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
          align-self: center;
        }
      }

      .campaign-payment-status {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        align-items: center;
        justify-content: space-between;

        .text-status {
          font-weight: 500;
          color: black;
          padding: 2px;
          min-width: 10rem;
          letter-spacing: 2px;
          border-radius: 10px;

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
        justify-content: space-around;
        margin: 10px 0;

        .btn-view-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid pink;
          border-radius: 10px;
          padding: 5px;
          background-color: pink;
          &.mr {
            margin-left: 1rem;
          }
        }

        .btn-edit-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid blueviolet;
          border-radius: 10px;
          padding: 5px;
          background-color: blueviolet;
          margin: 0 10px;
        }

        .btn-delete-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid #FF1700;
          border-radius: 10px;
          padding: 5px;
          background-color: #FF1700;
        }
      }
    }
  }
</style>
