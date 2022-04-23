<template>
  <div class="invitation-wrap-page">
    <div class="title-page">
      User Invitation Page
    </div>
    <div class="invitation-content">
      <div class="invitation-card">
        <table>
          <tr>
            <th>Group ID</th>
            <th>Invitatiion Owner</th>
            <th>Campaign name</th>
            <th>Status</th>
            <th>Button</th>
          </tr>
          <tr>
            <td>Group ID 1</td>
            <td>Maria Anders</td>
            <td>Gaming NFT in digital era</td>
            <td>Pending</td>
            <td>
              <button>Accept</button>
              <button>Reject</button>
            </td>
          </tr>
          <tr>
            <td>Group ID 2</td>
            <td>Francisco Chang</td>
            <td>Creating NFT with homeTools and integrating market</td>
            <td>Pending</td>
            <td>
              <button>Accept</button>
              <button>Reject</button>
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
  name: 'InvitationPage',
  components: {},
  data: () => {
    return {
      progress: '59',
      listCreatedCampaign: [],
    }
  },
  computed: {
    ...mapGetters({
      user: 'user',
    })
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
    width: 50rem;
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
