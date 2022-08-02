<template>
  <div class="history-campaign-wrap">
    <loading
      :active="isLoading"
      :can-cancel="false"
      :lock-scroll="true"
      :is-full-page="true"
      :height="125"
      :width="125"
    />
    <div class="title-page">
      Owned Campaign List
    </div>
    <div v-if="listCreatedCampaign.length > 0">
      <CampaignCard
        v-for="(campaign, idx) in listCreatedCampaign"
        :key="idx"
        :campaignInfo="campaign"
      />
    </div>
    <div v-else-if="isListEmpty" class="empty-state">
      <div class="image-info">
        <img src="\images\empty_icon.svg " alt="image-empty-icon">
      </div>
      <h2>
        You dont have created campaign !
      </h2>
    </div>
  </div>
</template>

<script>
// Loading Component
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

import CampaignCard from '../../components/campaignComponent/CampaignCard'
import { mapGetters } from 'vuex'

export default {
  name: 'HistoryCampaign',
  components: {
    CampaignCard,
    Loading,
  },
  data: () => {
    return {
      progress: '59',
      listCreatedCampaign: [],
      isLoading: true,
      isListEmpty: false,
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
        this.isListEmpty = true
      })

    this.isListEmpty = this.listCreatedCampaign.length <= 0
    this.isLoading = false
  },
  computed: {
    ...mapGetters({
      user: 'user',
    }),
    addNewCampaignLabel() {
      return '➕ Create New Campaign'
    },
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
    margin-top: 5rem;
    font-size: 25px;
    .image-info {
      img {
        border-radius: 20px;
        width: 25rem;
        height: 25rem;
      }
    }
    h2 {
      margin-top: 5rem;
    }
  }

  .title-page {
    font-size: 30px;
    font-weight: bold;
    margin: 5rem 0 2rem 0;
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
