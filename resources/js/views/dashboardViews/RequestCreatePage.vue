<template>
  <div class="campaign-list-page">
    <div class="title-tab">
      Request Approval - Create Campaign
    </div>
    <div class="payment-card">
      <div class="content-contributor">
        <table>
          <tr>
            <th>Project ID</th>
            <th>Project Title</th>
            <th>Project Owner</th>
            <th>Target Donation</th>
            <th>Finished Date</th>
            <th>Approval Status</th>
            <th>Action Create Approval</th>
          </tr>
          <tr v-for="(data, idx) in listData" :key="idx">
            <td>{{ data.id }}</td>
            <td>{{ data.title }}</td>
            <td>{{ data.created_by }}</td>
            <td>Rp {{ formatMoney(data.target_donation) }}</td>
            <td>{{ data.max_date }}</td>
            <td>{{ checkStatusCampaign(data.is_approved) }}</td>
            <td>
              <button @click="clickCampaign('view', data.id)" >
                View Campaign
              </button>
              <button
                @click="clickCampaign('accept', data.id)"
                :disabled="isBtnDisabled(data.is_approved)"
              >
                Accept Campaign
              </button>
              <button
                @click="clickCampaign('reject', data.id)"
                :disabled="isBtnDisabled(data.is_approved)"
              >
                Reject Campaign
              </button>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="button-pagination">
      <div class="btn-prev">
        <button @click="fetchPrevCampaignList">Previous</button>
      </div>
      <div class="btn-next">
        <button @click="fetchNextCampaignList" >Next</button>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from 'axios'

export default {
  name: 'RequestCreatePage',
  data: () => {
    return {
      listData: [],
      allCampaignInfo : {}
    }
  },
  mounted() {
    this.fetchAllCampaignList()
  },
  methods: {
    async fetchAllCampaignList(nextPageUrl) {
      try {
        let apiUrl = ''
        if (!nextPageUrl) apiUrl = 'campaign/get_all_campaigns?page=1'
        else apiUrl = nextPageUrl

        const req = await Axios.get(apiUrl)
        const res = req.data.all_campaigns
        this.allCampaignInfo = res
        this.listData = res.data
      } catch (e) {
        console.error('Failed to get all campaign list', e)
      }
    },
    fetchNextCampaignList() {
      if(!this.allCampaignInfo || !this.allCampaignInfo.next_page_url) return
      this.fetchAllCampaignList(this.allCampaignInfo.next_page_url)
    },
    fetchPrevCampaignList() {
      if(!this.allCampaignInfo || !this.allCampaignInfo.prev_page_url) return
      this.fetchAllCampaignList(this.allCampaignInfo.prev_page_url)
    },
    checkStatusCampaign(status) {
      let txt=''
      if(!status || status == null) txt = 'Initial'
      const isApproved = parseInt(status)

      if(isApproved === 0) txt = 'Pending'
      else if(isApproved === 1) txt = 'Approved'
      else if(isApproved === 2) txt = 'Rejected'
      return txt
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
    isBtnDisabled(status) {
      let stat=false
      if(!status || status == null) stat = true
      const isApproved = parseInt(status)
      if(isApproved === 1 || isApproved === 2) stat = true
      return stat
    },
    clickCampaign(type, campaignId) {
      if(type === 'view') {
        this.$router.push('/projectdetail/'+campaignId)
      } else if (type === 'accept') {
        // TODO: hit approve_campaign/{id}
      } else if (type === 'reject') {
        // TODO hit reject_campaign/{id}
      }
    }
  }
}
</script>

<style lang="less" scoped>
.campaign-list-page {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 5rem;

  .title-tab {
    margin: 5rem 0;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .payment-card {
    border: 1px solid black;
    width: 90%rem;
    min-height: 20rem;
    text-align: left;
    padding: 10px;
    margin-bottom: 5rem;

    .content-contributor {
      font-size: 16px;
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }
    }
  }

  .button-pagination{
    display: flex;
    flex-direction: row;

    .btn-next,
    .btn-prev {
      margin: 0 1rem;
    }
  }
}
</style>
