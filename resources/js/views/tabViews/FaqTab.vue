<template>
  <div class="wrap-faq-tab">
    <div class="faq-title">
      Frequently Asked Question
    </div>
    <div class="faq-content">
      <div class="question-content">
        Lorem ipsum dolor sit amet ?
      </div>
      <div class="answer-content">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis, vel.
      </div>
    </div>
    <div class="faq-content">
      <div class="question-content">
        Lorem ipsum dolor sit amet ?
      </div>
      <div class="answer-content">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates molestiae atque optio consequuntur, cumque magnam quis accusantium recusandae ut cupiditate!
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FaqTab'
}
</script>

.<style lang="less" scoped>
.wrap-faq-tab {
  min-height: 70vh;
  text-align: left;
  padding: 3rem;
  .faq-title {
    margin-bottom: 2rem;
    font-size: 30px;
    font-weight: bold;
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
