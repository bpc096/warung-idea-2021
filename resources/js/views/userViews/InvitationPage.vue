<template>
  <div class="invitation-wrap-page">
    <div class="title-page">
      User Invitation Page
    </div>
    <div class="invitation-content">
      <div class="invitation-card">
        <table>
          <tr>
            <th>Campaign ID</th>
            <th>Invitation Owner</th>
            <th>Campaign name</th>
            <th>Status</th>
            <th>Button</th>
          </tr>
          <tr v-for="(data,idx) in invitationList" :key="idx">
            <td>Campaign ID {{data.campaign_id || 'Default Id'}}</td>
            <td>{{ data.creator || 'Default name' }}</td>
            <td>{{  textTitleCampaign(data) }}</td>
            <td>{{ data.status || 'Default Status' }}</td>
            <td>
              <button @click="viewCampaign(data.campaign_id)">View Campaign</button>
              <button @click="btnAccept(user.id, data.campaign_id)" :disabled="isBtnDisabled(data.status)">Accept</button>
              <button @click="btnReject(user.id, data.campaign_id)" :disabled="isBtnDisabled(data.status)">Reject</button>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => {
    return {
      progress: '59',
      listCreatedCampaign: [],
      invitationList: [],
    }
  },
  async created () {
    await this.$store
      .dispatch('getInvitationListByUserId', this.user.id)
      .then(res => {
        if(res.data.length > 0) {
          this.invitationList = res.data
        }
      })
      .catch(err => {
        console.error(err)
      })
  },
  computed: {
    ...mapGetters({
      user: 'user',
    }),
  },
  methods: {
    textTitleCampaign(data) {
      const title = data.campaigns && data.campaigns.length > 0 ? data.campaigns[0].title : 'Default Title'
      return title
    },
    checkCampaignExist(campaign) {
      return campaign && campaign.length > 0
    },
    isBtnDisabled(status) {
      return status !== 'pending'
    },
    viewCampaign(campaignId) {
      this.$router.push('/projectdetail/'+campaignId)
    },
    async btnAccept(userId, campaignId) {
      let data = new FormData()
      data.append('users_id', userId)
      data.append('campaign_id', campaignId)

      await this.$store
        .dispatch('acceptInvitation', data)
        .then(res => {
          this.$swal({
            title: res.message,
            text: 'You accepted the request',
            icon: 'success',
            timer: 3000,
            timerProgressBar: true
          }).then(res => {
              if (res.dismiss === this.$swal.DismissReason.timer || res.isConfirmed) {
                this.$router.go()
              }
          })
        })
        .catch(err => {
          console.error(err)
          this.$swal({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          })
        })
    },
    btnReject(userId, campaignId) {
      let data = new FormData()
      data.append('users_id', userId)
      data.append('campaign_id', campaignId)

      this.$swal({
        title: 'Are you sure want to reject ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, I am sure!',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then(async (res) => {
        if(res.isConfirmed) {
          await this.$store
            .dispatch('rejectInvitation', data)
            .then(res => {
              this.$swal({
                title: res.message,
                text: 'You rejected the request',
                icon: 'info',
                timer: 3000,
                timerProgressBar: true
              }).then(res => {
                  if (res.dismiss === this.$swal.DismissReason.timer || res.isConfirmed) {
                    this.$router.go()
                  }
              })
            })
            .catch(err => {
              console.error(err)
              this.$swal({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
              })
            })
        }
      })
    }
  }
}
</script>

<style lang="less" scoped>
.invitation-wrap-page {
  min-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;

  .title-page {
    font-size: 30px;
    font-weight: bold;
    margin: 2rem 0;
  }

  .invitation-content {
    width: 67rem;
    display: flex;
    flex-direction: column;
    margin: 10px 0;

    .invitation-card {
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
