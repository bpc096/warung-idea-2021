// resources/assets/js/components/ChatMessages.vue

<template>
  <ul class="chat-messages-wrap">
    <li class="left clearfix" v-for="message in messages" :key="message.id">
      <div class="clearfix">
        <div class="header">
          <strong>
            {{ message.user.name }}
          </strong>
        </div>
        <p>
          {{ message.message }}
        </p>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["messages"],
  watch: {
    messages: async () => {
      console.log('scroll chat')
      var $chat = $(".chat-messages-wrap");
      $chat.scrollTop($chat.height());
      console.log($chat.height())
    }
  },
  methods: {
    scrollTopChat() {
      console.log('scroll chat')
      var $chat = $(".card-body");
      $chat.scrollTop($chat.height());
      console.log($chat.height())
    },
  }
};
</script>

<style lang="less" scoped>
.chat-messages-wrap {
  height: 70vh;
  overflow-y: scroll;

  .left {
    text-align: left;
  }
}
</style>
