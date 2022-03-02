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
  data: () => {
    return {
      listData: [],
      mockListData: [
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
  computed() {

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
    .question-content {
      font-size: 20px;
      font-weight: bold;
    }
    .answer-content {
      font-size: 20px;
    }
  }
}
</style>
