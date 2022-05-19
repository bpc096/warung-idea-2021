<template>
  <div class="campaign-card">
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
        <div v-if="!isInHistoryOwnedPage && !isInCollaborationListPage" class="campaign-donation-amount">
          <b>Donation amount : </b>
          <div class="donation-text">
            Rp {{ formatMoney(infoDonationAmount) }}
          </div>
        </div>
        <div v-if="!isInHistoryOwnedPage && !isInCollaborationListPage" class="campaign-payment-status">
          <b>Payment status :</b>

          <div :class="['text-status', paymentStatus]">
            {{ paymentTextStatus }}
          </div>
        </div>
        <div
          v-if="!isInHistoryOwnedPage && !isInCollaborationListPage"
          class="campaign-payment-button"
        >
          <button
            v-if="paymentStatus !== 'success-status'"
            class="btn-payment"
            @click="payment"
          >
            {{ payNowLabel }}
          </button>
        </div>
        <!-- <div v-if="!isInHistoryOwnedPage" class="campaign-payment-status">
          Action
          <button
            v-if="paymentStatus !== 'success-status'"
            class="btn-payment"
            @click="payment"
          >
            {{ payNowLabel }}
          </button>
        </div> -->
        <div class="campaign-wrap-button" v-if="isInHistoryOwnedPage">
          <b>Campaign Config :</b>
          <a :href="`/projectdetail/${campaignId}`" class="btn-view-campaign mr">
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
        <div
          v-if="campaignInfo.is_approved == '1' && (isInHistoryOwnedPage || isInCollaborationListPage)"
          class="campaign-wrap-button"
        >
          <b>Tab Config :</b>
          <a :href="`/updates/create/${campaignId}`" class="btn-view-campaign mr">
            Add New Updates
          </a>
          <a :href="`/faqs/create/${campaignId}`" class="btn-edit-campaign">
            Add New FAQ
          </a>
          <a :href="`/rewards/create/${campaignId}`" class="btn-delete-campaign">
            Add New Reward
          </a>
        </div>
        <div class="campaign-wrap-button" v-if="isInHistoryOwnedPage">
          <b>Finishing Config :</b>
          <button
            @click="finishedCampaign"
            class="btn-delete-campaign"
          >
            Finish Campaign
          </button>
        </div>
        <div
          v-if="isInHistoryOwnedPage || isInCollaborationListPage"
          class="campaign-wrap-button"
        >
          <b>Create-Approval Status :</b>
          <div :class="createApprovalClassName(campaignInfo.is_approved)">
            {{ createApprovalStatus(campaignInfo.is_approved) }}
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'CampaignCard',
  props: {
    isInCollaborationListPage: {
      type: Boolean,
      default: false,
    },
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
      continueDelete: false,
      progress: '59',
      paymentTextStatus: 'PENDING',
      paymentStat: 'pending',
      dummyImgUrl: 'https://images.unsplash.com/photo-1643223723262-7ce785730cf6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80',
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
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
    createApprovalClassName(isApproved) {
      let txtClass = ''
      switch(isApproved) {
        case '0' :
          txtClass = 'badge-status-custom status-warning'
          break;
        case '1' :
          txtClass = 'badge-status-custom status-success'
          break;
        case '2' :
          txtClass = 'badge-status-custom status-danger'
          break;
      }
      return txtClass
    },
    createApprovalStatus(isApproved) {
      let txtStatus = ''
      switch(isApproved) {
        case '0' :
          txtStatus = 'Pending'
          break;
        case '1' :
          txtStatus = 'Approved'
          break;
        case '2' :
          txtStatus = 'Rejected'
          break;
      }
      return txtStatus
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
    finishedCampaign () {
      let timerInterval;
      this.$swal({
          title: 'Request Finished Campaign ?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, request for finish!'
        }).then((result) => {
          if (result.isConfirmed) {
            this.$store
              .dispatch('deleteCampaign', this.campaignId)
              .then(() => {
                this.$swal({
                  title: 'Your delete request has been sent to admin !',
                  icon: 'success',
                  html: 'Please wait for admin confirmation,<br>Page will refresh in <b></b> second.',
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: () => {
                    this.$swal.showLoading()
                    timerInterval = setInterval(() => {
                      this.$swal
                        .getHtmlContainer()
                        .querySelector('b')
                        .textContent = (this.$swal.getTimerLeft()/1000).toFixed(0)
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  if(result.dismiss === this.$swal.DismissReason.timer) {
                    this.$router.go()
                  }
                })
              })
              .catch((err) => {
                console.error(err)
                this.$swal({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                })
              })
          }
        })
    },
    deleteCampaign () {
      let timerInterval;
      this.$swal({
          title: 'Request Delete Campaign ?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, request for delete!'
        }).then((result) => {
          if (result.isConfirmed) {
            this.$store
              .dispatch('deleteCampaign', this.campaignId)
              .then(() => {
                this.$swal({
                  title: 'Your delete request has been sent to admin !',
                  icon: 'success',
                  html: 'Please wait for admin confirmation,<br>Page will refresh in <b></b> second.',
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: () => {
                    this.$swal.showLoading()
                    timerInterval = setInterval(() => {
                      this.$swal
                        .getHtmlContainer()
                        .querySelector('b')
                        .textContent = (this.$swal.getTimerLeft()/1000).toFixed(0)
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  if(result.dismiss === this.$swal.DismissReason.timer) {
                    this.$router.go()
                  }
                })
              })
              .catch((err) => {
                console.error(err)
                this.$swal({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                })
              })
          }
        })
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
    border-radius: 10px;

    .campaign-image {
      width: 30%;
      margin-right: 3px;
      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
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
        margin: 10px 0 20px 25px;
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

      .campaign-payment-button {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
        margin: 10px 0 20px 25px;

        .btn-payment {
          text-decoration: none;
          color: black;
          border: 1px solid pink;
          border-radius: 10px;
          padding: 5px;
          background-color: salmon;
          margin: 0 2rem;
          min-width: 10rem;
        }
      }

      .campaign-payment-status {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 10px 0 20px 25px;

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
      }


      .campaign-wrap-button {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0 20px 25px;

        b {
          width: 30%;
          text-align: left;
        }

        .badge-status-custom {
          text-decoration: none;
          color: black;
          border: 1px solid black;
          border-radius: 10px;
          padding: 5px;
          min-width: 150px;
          margin-right: 10px;
          font-weight: bold;

          &.status-warning {
            background-color: yellow;
          }

          &.status-success {
            background-color: lime;
          }

          &.status-danger {
            background-color: red;
          }
        }

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
