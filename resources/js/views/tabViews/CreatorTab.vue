<template>
  <div class="wrap-creator-tab">
    <div v-if="creatorListData.length > 0">
      <div class="title-creator">
        Collaborator List
      </div>
      <div class="creator-card">
        <div class="content-creator">
          <table>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Email</th>
              <th>User ID</th>
            </tr>
            <tr v-for="(data, idx) in creatorListData" :key="idx">
              <td>{{ idx+1 }}</td>
              <td>{{ getUserName(data) }}</td>
              <td>{{ getUserEmail(data) }}</td>
              <td>{{ data.users_id }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="empty-state" v-else>
      <i class="fa-solid fa-circle-exclamation fa-10x"></i>
      <h2>Upss ... There's no collaborator for this project!</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CreatorTab',
  props: {
    creatorListData: {
      type: Array,
      default: [],
    }
  },
  data: () => {
    return {
      listData: []
    }
  },
  mounted() {
    // this.generateMockData()
    this.fetchingCollaboratorListData()
  },
  methods: {
    getUserName(data) {
      let username = 'Default Username'
      if(data && data.users && data.users.length > 0) {
        username = data.users[0].name
      }
      return username
    },
    getUserEmail(data) {
      let email = 'Default Email'
      if(data && data.users && data.users.length > 0) {
        email = data.users[0].email
      }
      return email
    },
    generateMockData () {
      let tempData = []
      for(let x=1;x<=10;x++){
        let tempObj = []
        tempObj.userId = 'userId' + x
        tempObj.username = 'userName' + x
        tempObj.country = 'Indonesia'
        tempData.push(tempObj)
      }
      this.listData = tempData
    },
    fetchingCollaboratorListData () {
      const campaignId = this.campaignId
      this.$store
        .dispatch('getCollaboratorByCampaignId', campaignId)
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
.wrap-creator-tab{
  min-height: 70vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 5rem;

  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 90vh;
  }

  h2 {
    margin-top: 5rem;
  }

  .title-creator {
    margin-top: 5rem;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .creator-card {
    border: 1px solid black;
    width: 50rem;
    min-height: 20rem;
    margin: 5rem 0;
    text-align: left;
    padding: 10px;

    .content-creator {
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
