<template>
  <div class="history-campaign-wrap">
    <div class="title-page">
      History Donation List
    </div>
    <CampaignCard
      :isInHistoryCampaignPage="false"
    />
    <CampaignCard
      :isInHistoryCampaignPage="false"
    />
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
    }
  },
  computed: {
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
  }
}
</script>

<style lang="less" scoped>
.history-campaign-wrap {
  min-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;

   .title-page {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 2rem;
  }

  .campaign-card {
    border: 1px solid black;
    display: flex;
    flex-direction: row;
    width: 50rem;
    min-height: 10rem;
    margin: 2rem 0;

    .campaign-image {
      width: 30%;
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
