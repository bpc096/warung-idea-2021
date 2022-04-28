<template>
  <div class="history-campaign-wrap">
    <div class="title-page">
      Owned Campaign List
    </div>
    <div class="button-upper-campaign">
      <router-link to="/campaign/create" class="button-create">
        {{ addNewCampaignLabel }}
      </router-link>
      <router-link to="/campaign/history/donation" class="button-history-donation">
        History Donation Page
      </router-link>
      <router-link to="/campaign/history/donation" class="button-history-donation">
        Campaign Collaboration
      </router-link>
    </div>
    <div v-if="listCreatedCampaign.length > 0">
      <CampaignCard
        v-for="(campaign, idx) in listCreatedCampaign"
        :key="idx"
        :campaignInfo="campaign"
      />
    </div>
    <div v-else class="empty-state">
      You dont have created campaign !
    </div>
  </div>
</template>

<script>
import CampaignCard from '../../components/campaignComponent/CampaignCard'
import { mapGetters } from 'vuex'

export default {
  name: 'HistoryCampaign',
  components: {
    CampaignCard,
  },
  data: () => {
    return {
      progress: '59',
      listCreatedCampaign: [],
    }
  },
  async created () {
    // FETCH PROJECT CREATED BY USER HISTORY BY USER_ID
    await this.$store
      .dispatch('getCampaignByUserId', this.user.id)
      .then(res => {
        this.listCreatedCampaign = res.data
      })
      .catch(err => {
        console.log(err)
      })
  },
  computed: {
    ...mapGetters({
      user: 'user',
    }),
    addNewCampaignLabel() {
      return '➕ Add New Campaign'
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
  }
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
        background-color: #A1E3D8;
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
        background-color: #A1E3D8;
        color: white;
      }
    }
  }
}
</style>
