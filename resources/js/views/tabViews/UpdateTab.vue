<template>
  <div class="wrap-update-tab">
    <div v-if="listData.length > 0">
      <div class="update-card" v-for="data in listData" :key="data.id">
        <div class="title-update">
          {{ data.title }}
        </div>
        <div class="content-update">
          {{ data.description }}
        </div>
        <div
          v-if="checkUserOwner"
          class="button-wrap"
        >
          <a :href="`/updates/edit/${campaignId}/${mockUpdatesId}`" class="btn">
            Edit Updates
          </a>
          <a @click="deleteUpdates" class="btn">
            Delete Updates
          </a>
        </div>
      </div>
    </div>
    <div class="empty-update" v-else>
      <h2>Upss ... There's no updates for this project!</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UpdateTab',
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
      mockUpdatesId: 1,
      // TODO : Change realListData with listData, and listData with mock
      realListData: [],
      listData: [
        {
          id: 1,
          users_id: 1,
          campaign_id: 2,
          title: "Updates #1",
          description: "kami telah mengembangkan game ini di versi yang lebih baik, silahkan menunggu untuk update berikutnya",
          created_at: "2022-01-05T09:47:17.000000Z",
          updated_at: "2022-01-05T09:47:17.000000Z"
        },
        {
          id: 2,
          users_id: 1,
          campaign_id: 2,
          title: "Updates #2",
          description: "kami telah mengembangkan game ini di versi yang lebih baik, silahkan menunggu untuk update berikutnya",
          created_at: "2022-01-05T09:47:17.000000Z",
          updated_at: "2022-01-05T09:47:17.000000Z"
        },
      ],
    }
  },
  async created() {
    const campaignId = this.campaignId
    await this.$store
      .dispatch('getUpdatesByCampaignId', campaignId)
      .then(res => {
        console.log(res)
        if(res.success && res.data && res.data.length > 0) {
          this.listData = res.data
        }
      })
      .catch(err => {
        console.error(err)
      })
  },
  computed: {
    checkUserOwner() {
      // return parseInt(this.ownerId) === userId
      return parseInt(this.ownerId) === this.userId
    }
  },
  methods: {
    deleteUpdates() {
      console.log('delete updates');
    }
  }
}
</script>

<style lang="less" scoped>
.wrap-update-tab{
  min-height: 70vh;
  display: flex;
  flex-direction: column;
  align-items: center;

  .empty-update {
    margin-top: 5rem;
  }

  .update-card {
    border: 1px solid black;
    border-radius: 5px;
    width: 60rem;
    min-height: 20rem;
    margin: 5rem 0;
    text-align: left;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    .title-update {
      margin: 1rem 0;
      font-size: 30px;
      font-weight: bold;
    }

    .button-wrap {
      margin: 1rem 0;
      text-align: end;

      .btn {
        border: 1px solid black;
        border-radius: 10px;
        margin-left: .5rem;
      }
    }
  }

}
</style>
