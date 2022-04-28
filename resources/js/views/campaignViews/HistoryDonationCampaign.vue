<template>
  <div class="history-campaign-wrap">
    <div class="title-page">
      History Donation List
    </div>
    <div class="button-upper-campaign">
      <router-link to="/campaign/history" class="button-create">
        {{ backBtnLabel }}
      </router-link>
      <router-link to="/home" class="button-history-donation">
        {{ backBtnHomeLabel }}
      </router-link>
    </div>
    <div v-if="listDonation.length > 0">
      <CampaignCard
        v-for="(donation, idx) in listDonation"
        :isInHistoryOwnedPage="false"
        :donationInfo="donation"
        :campaignInfo="donation.campaign"
        :key="idx"
      />
    </div>
    <div v-else class="empty-state">
      You dont have any donation list !
    </div>
  </div>
</template>

<script>
import CampaignCard from '../../components/campaignComponent/CampaignCard'

export default {
  name: 'HistoryDonationCampaign',
  components: {
    CampaignCard,
  },
  data: () => {
    return {
      progress: '59',
      listDonation: [],
    }
  },
  async created() {
    await this.$store
      .dispatch('getDonation')
      .then(res => {
        this.listDonation = res
      })
      .catch(err => {
        console.log(err)
      })
  },
  computed: {
    backBtnLabel() {
      return '⬅️ Back To History Page'
    },
    backBtnHomeLabel() {
      return '🏠 Back To Home Page'
    },
    progressPercentage() {
      if(parseInt(this.progress) <= 0) {
        return '1'
      }
      else if (parseInt(this.progress) >= 100) {
        return '100'
      }
      else {
        return this.progress
      }
    },
    checkEligibleToEdit() {
      // TODO : Check Eligiblelity to edit campaign
      return true
    }
  },
}
</script>

<style lang="less" scoped>
.history-campaign-wrap {
  min-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 10rem;

  .empty-state {
    margin-top: 10rem;
    font-size: 25px;
  }

  .title-page {
    font-size: 30px;
    font-weight: bold;
    margin: 2rem 0;
  }

  .button-upper-campaign {
    width: 50rem;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin: 10px 0;

    .button-create {
      text-decoration: none;
      color: black;
      border: 1px solid green;
      border-radius: 20px;
      padding: 10px;

      &:hover {
        background-color: black;
        color: white;
      }
    }

    .button-history-donation {
      text-decoration: none;
      color: black;
      border: 1px solid green;
      border-radius: 20px;
      padding: 10px;
      margin-left: 10px;

      &:hover {
        background-color: black;
        color: white;
      }
    }
  }

  .campaign-card {
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 45rem;
    min-height: 10rem;
    margin: 2rem 0;

    .campaign-image {
      width: 30%;
    }

    .campaign-content {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 0 3rem;

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
              color: #fff;
              font-size: 0.7em
            }
          }
        }
      }

      .campaign-wrap-button {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        margin: 10px 0;

        .btn-view-campaign {
          text-decoration: none;
          color: black;
          border: 1px solid pink;
          border-radius: 10px;
          padding: 5px;
          background-color: pink;
        }
      }
    }
  }
}
</style>
