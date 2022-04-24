<template>
  <div class="wrap-update-tab">
    <div v-if="updateListData.length > 0">
      <div class="update-title">
        Project Update
      </div>
      <div class="update-card" v-for="(data,idx) in updateListData" :key="data.id">
        <div class="title-update">
          #{{idx+1}} {{ data.title }}
        </div>
        <div class="content-update">
          {{ data.description }}
        </div>
        <div
          v-if="checkUserOwner"
          class="button-wrap"
        >
          <a :href="`/updates/edit/${campaignId}/${data.id}`" class="btn btn-edit">
            Edit
          </a>
          <a @click="deleteUpdates(data.id)" class="btn btn-delete">
            Delete
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
    },
    userId: {
      type: Number,
    },
    ownerId: {
      type: Number,
    },
    updateListData: {
      type: Array,
      default: [],
    }
  },
  data: () => {
    return {
      mockUpdatesId: 1,
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
  computed: {
    checkUserOwner() {
      // return parseInt(this.ownerId) === userId
      return parseInt(this.ownerId) === this.userId
    }
  },
  methods: {
    deleteUpdates(updateId) {
      console.log(updateId)
      this.$store
        .dispatch('deleteUpdates', updateId)
        .then(res => {
          this.$router.go(0)
        })
        .catch(err => {
          console.error(err)
        })
    }
  }
}
</script>

<style lang="less" scoped>
.wrap-update-tab{
  min-height: 90vh;
  margin-bottom: 10rem;
  display: flex;
  flex-direction: column;
  align-items: center;

  h2 {
    margin-top: 5rem;
  }

  .update-title {
    margin: 5rem 0 0 0;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }

  .update-card {
    border-radius: 5px;
    width: 60rem;
    min-height: 10rem;
    margin: 4rem 0;
    text-align: left;
    padding: 10px;
    display: flex;
    flex-direction: column;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;




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
        &-delete:hover {
          background-color: red;
          color: white
        }
        &-edit:hover {
          background-color: green;
          color: white;
        }
      }
    }
  }

}
</style>
