<template>
  <div class="wrap-faq-tab">
    <div v-if="faqListData.length > 0">
      <div class="faq-title">
        Frequently Asked Question
      </div>
      <div class="faq-content"  v-for="(data,idx) in faqListData" :key="data.id">
        <div class="question-content">
          #{{idx+1}} {{ data.title }}
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
    },
    faqListData: {
      type: Array,
      default: [],
    }
  },
  data: () => {
    return {
      mockUpdatesId: 1,
      realListData: [],
      listData: [],
    }
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
    margin: 4rem 0;
    border-radius: 10px;
    padding: 1rem;
    width: 60rem;
    min-height: 10rem;
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
