<template>
  <div class="wrap-payment-tab">
    <div v-if="listData.length > 0">
      <div class="title-tab">
        Donation Payment List
      </div>
      <div class="payment-card">
        <div class="content-contributor">
          <table>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Amount</th>
            </tr>
            <tr v-for="(data, idx) in listData" :key="idx">
              <td>{{ idx }}</td>
              <td>{{ data.username }}</td>
              <td>{{ data.amount }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div v-else>
      <h2>Ups... There's no payment list for this project right now!</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaymentTab',
  props: {
    campaignId: {
      type: Number,
      default: 1,
    },
    userId: {
      type: Number,
      default: 1
    },
    ownerId: {
      type: String,
      default: "0"
    }
  },
  data: () => {
    return {
      listData: [],
    }
  },
  mounted() {
    // this.generateMockData()
    this.fetchingPaymentListData()
  },
  methods: {
    generateMockData() {
      let mockData = []
      for(let x=1;x<=10;x++){
        let tempObj = {}
        tempObj.userId = 'userId'+ x
        tempObj.username = 'Username' + x
        tempObj.amount = 'Rp ' + x + '00.000'
        mockData.push(tempObj)
      }
      this.listData = mockData
    },
    fetchingPaymentListData() {
      const campaignId = this.campaignId
      this.$store
        .dispatch('getPaymentByCampaignId', campaignId)
        .then(res => {
          if(res.success && res.data && res.data.length > 0) {
            this.listData = res.data
          }
        })
        .catch(err => {
          console.error(err)
        })
    }
  }
}
</script>

<style lang="less" scoped>
.wrap-payment-tab{
  min-height: 70vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 5rem;

  h2 {
    margin-top: 5rem;
  }

  .title-tab {
    margin-top: 5rem;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .payment-card {
    border: 1px solid black;
    width: 50rem;
    min-height: 20rem;
    margin: 5rem 0;
    text-align: left;
    padding: 10px;

    .content-contributor {
      font-size: 20px;
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

}
</style>
