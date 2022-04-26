<template>
  <div class="checkout-page-wrap">
    <div class="content-right">
      <div class="checkout-title">
        YOU'RE CONTRIBUTING TO
        <div class="project-title">
          {{ projectTitle }}
        </div>
      </div>
      <div class="checkout-perks">
        Review Your Package Rewards Information
        <div class="perks-title">
          {{ projectRewardName }}
        </div>
      </div>
      <div class="checkout-info">
        <div class="checkout-image">
          <img
            :src="projectImage"
            class="image-coffee-dummy"
            alt="image-coffee-dummy"
          >
        </div>
        <div class="checkout-reward">
          <div class="reward-title">
            Donasi Sukarela
          </div>
          <div class="reward-price">
            Rp {{ formatMoney(donationAmount) }}
          </div>
        </div>
      </div>
    </div>
    <div class="content-left">
      <div class="content-contribution">
        <div class="title-summary">Contribution Summary</div>
        <div class="subtotal-text">
          <div class="subtotal-title">
            Subtotal
          </div>
          <div class="subtotal-price">
            Rp {{ formatMoney(donationAmount) }}
          </div>
        </div>
        <div class="service-fee-text">
          <div class="service-fee-title">
            Service Fee
          </div>
          <div class="service-fee-price">
            Rp {{ formatMoney(serviceFeeAmount) }}
        </div>
        <div class="shipping-text">
          <div class="shipping-title">
            Shipping
          </div>
          <div class="shipping-price">
            Rp0
          </div>
        </div>
        </div>
        <div class="total-text">
          <div class="total-title">
            TOTAL
          </div>
          <div class="total-price">
            Rp {{ formatMoney(totalPriceAmount) }}
          </div>
        </div>
      </div>
      <div class="btn-checkout">
        <button
          @click="checkout"
        >
          PROCEED TO CHECKOUT
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CheckoutPage',
  data: () => {
    return {
      projectData: {},
      serviceFeeAmount: 1000,
    }
  },
  created() {
    const data = this.$route.params.campaignId || this.$route.query.campaignId
    this.$store
      .dispatch('getCampaignById', data)
      .then(res => {
        this.projectData = res.data
      })
      .catch(err => {
        console.log(err)
      })
  },
  computed: {
    projectRewardName () {
      return this.$route.query.rewardName || 'Default Reward Name'
    },
    dummyImage() {
      return 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'
    },
    projectTitle () {
      return this.projectData.title || 'Project Title'
    },
    projectImage () {
      return this.projectData?.image? this.projectData.image : this.dummyImage
    },
    donationAmount () {
      return this.$route.params.totalAmount || this.$route.query.totalAmount
    },
    infoCampaignId () {
      return this.$route.params.campaignId || this.$route.query.campaignId
    },
    totalPriceAmount () {
      const totalPrice = parseInt(this.donationAmount) + parseInt(this.serviceFeeAmount)
      return totalPrice
    },
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
      .replace(/,/g, '.')
      .trimLeft()
      return formatter
    },
    async checkout() {
      const donation = {
        amount: this.donationAmount,
        campaignId: this.infoCampaignId,
      }

      await this.$store
        .dispatch('storeDonation', donation)
        .then((res) => {
          console.log(res)

          this.$router.push({
            name: 'HistoryDonationCampaign'
          })
        })
        .catch((err) => {
          console.log(err)
        })
    }
  }
}
</script>

<style lang="less" scoped>
.checkout-page-wrap {
  height: 90vh;
  display: flex;
  flex-direction: row;

  .content-right {
    border-right: 1px solid black;
    width: 50%;
    padding: 5rem;

    .checkout-title {
      text-align: left;
      margin: 7rem 0 2rem 0;
      .project-title {
        font-size: 25px;
        font-weight: bold;
      }
    }

    .checkout-perks {
      text-align: left;
      margin: 2rem 0;
      .perks-title {
        font-size: 25px;
        font-weight: bold;
      }
    }

    .checkout-info {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      .checkout-image {
        width: 50%;
        img {
          width: 50%;
        }
      }
      .checkout-reward {
        display: flex;
        .reward-title {
          margin: 0 20px;
        }
      }
    }
  }

  .content-left {
    border-left: 1px solid black;
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .content-contribution {
      width: 50%;
      .subtotal-text,
      .service-fee-text {
        display: flex;
        justify-content: space-between;
      }
      .shipping-text,
      .service-fee-text {
        display: flex;
        justify-content: space-between;
      }
      .total-text{
        display: flex;
        justify-content: space-between;
        margin-top: 5rem;
        margin-bottom: 1rem;
      }
    }

    .btn-checkout {
      border-top: 1px solid black;
      width: 50%;
      margin: 1rem 0;

      button {
        margin: 1rem 0;
      }
    }
  }
}
</style>
