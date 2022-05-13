<template>
  <div class="campaign-collaboration-wrap">
    <div class="title-page">
      List Of Collaboration Campaign
    </div>
    <div v-if="listCollaboration.length > 0">
      <CampaignCard
        v-for="(collab, idx) in listCollaboration"
        :campaignInfo="collab"
        :isInHistoryOwnedPage="false"
        :donationInfo="collab.donation"
        :key="idx"
      />
    </div>
    <div v-else class="empty-state">
      You dont have any collaboration list!
    </div>
  </div>
</template>

<script>
import CampaignCard from '../../components/campaignComponent/CampaignCard'
import axios from "axios"
import { mapGetters } from 'vuex'

export default {
  name: 'HistoryDonationCampaign',
  components: {
    CampaignCard,
  },
  data: () => {
    return {
      progress: '59',
      listCollaboration: [],
    }
  },
  created() {
    this.getCollaborations()
  },
  computed: {
    ...mapGetters({
      user: 'user',
    }),
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
  methods: {
    async getCollaborations() {
      try {
        const req = await axios.get(`campaign/collaboration/${this.user.id}`)
        const res = req.data
        this.listCollaboration = res.collaborations
        console.log("WW", res)
      } catch(e) {
        console.error(e)
      }
    }
  }
}
</script>

<style lang="less" scoped>
.campaign-collaboration-wrap {
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
    border-radius: 10px;

    .campaign-image {
      width: 30%;
      img {
        object-fit: cover;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
      }
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
