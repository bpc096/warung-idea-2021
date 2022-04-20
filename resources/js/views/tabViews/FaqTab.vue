<template>
  <div class="wrap-faq-tab">
    <div v-if="listData.length > 0">
      <div class="faq-title">
        Frequently Asked Question
      </div>
      <div class="faq-content"  v-for="data in listData" :key="data.id">
        <div class="question-content">
          {{ data.title }}
        </div>
        <div class="answer-content">
          {{ data.description }}
        </div>
        <div
          v-if="checkUserOwner"
          class="btn-content">
          <a :href="`/faqs/edit/${campaignId}/${data.id}`" class="btn btn-edit">
            Edit
          </a>
          <a @click="deleteFaqs" class="btn btn-delete">
            Delete
          </a>
        </div>
      </div>
    </div>
    <div v-else>
      <h2>Ups... There's no FAQ for this project right now!</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FaqTab',
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
      type: Number,
      default: 0
    }
  },
  data: () => {
    return {
      mockUpdatesId: 1,
      // TODO : Change realListData with listData, and listData with mock
      realListData: [],
      listData: [],
    }
  },
  mounted() {
    this.fetchingFaqListData()
    // this.generateMockData()
  },
  computed: {
    checkUserOwner() {
      // return parseInt(this.ownerId) === userId
      return parseInt(this.ownerId) === this.userId
    }
  },
  methods: {
    fetchingFaqListData () {
      const campaignId = this.campaignId
      this.$store
        .dispatch('getFaqByCampaignId', campaignId)
        .then(res => {
          if(res.success && res.data && res.data.length > 0) {
            this.listData = res.data
          }
        })
        .catch(err => {
          console.error(err)
        })
    },
    generateMockData () {
      let mockData = []
      for(let x=1;x<=5;x++){
        let tempObj = {
          id: x,
          users_id: 1,
          campaign_id: 1,
          title: '#FAQ 2 ?',
          description: 'Kami telah mengembangkan game ini di versi yang lebih baik, silahkan menunggu untuk update berikutnya.',
          "created_at": "2022-01-05T09:47:17.000000Z",
          "updated_at": "2022-01-05T09:47:17.000000Z"
        }
        mockData.push(tempObj)
      }
      this.listData = mockData
    },
    deleteFaqs() {
      console.log('delete faqs')
    }
  }
}
</script>

.<style lang="less" scoped>
.wrap-faq-tab {
  min-height: 90vh;
  text-align: left;
  padding: 0 20rem;
  display: flex;
  flex-direction: column;
  align-items: center;

  h2 {
    margin-top: 5rem;
  }

  .faq-title {
    margin: 5rem 0 2rem 0;
    font-size: 30px;
    font-weight: bold;
    text-align: center;
  }
  .faq-content {
    margin: 2rem 0;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;

    .question-content {
      font-size: 20px;
      font-weight: bold;
    }
    .answer-content {
      font-size: 20px;
    }

    .btn-content {
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
