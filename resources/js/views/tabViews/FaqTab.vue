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
            "id": 1,
            "users_id": 1,
            "campaign_id": 2,
            "title": "FAQ #1 ?",
            "description": "kami telah mengembangkan game ini di versi yang lebih baik, silahkan menunggu untuk update berikutnya",
            "created_at": "2022-01-05T09:47:17.000000Z",
            "updated_at": "2022-01-05T09:47:17.000000Z"
        },
        {
            "id": 2,
            "users_id": 1,
            "campaign_id": 2,
            "title": "FAQ #2 ?",
            "description": "kami telah mengembangkan game ini di versi yang lebih baik, silahkan menunggu untuk update berikutnya",
            "created_at": "2022-01-05T09:47:17.000000Z",
            "updated_at": "2022-01-05T09:47:17.000000Z"
        }
      ]
    }
  },
  async created() {
    //TODO fetch FAQ by Campaign ID
  },
  computed: {
   checkUserOwner() {
      // return parseInt(this.ownerId) === userId
      return parseInt(this.ownerId) === this.userId
    }
  },
  methods: {
    deleteFaqs() {
      console.log('delete faqs')
    }
  }
}
</script>

.<style lang="less" scoped>
.wrap-faq-tab {
  min-height: 70vh;
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
