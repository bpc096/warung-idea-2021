<template>
  <div class="chat-page-wrap">
    <div class="title">
      <h1>Chat Message</h1>
    </div>
    <div class="content-page">
      <div class="side-list-user">
      <ListChatPage />
      </div>
      <div class="main-chat">
        This is main chat
      </div>
    </div>
  </div>
</template>

<script>
import ListChatPage from './ListChatPage.vue'
export default {
  name: 'ChatPage',
  components: {
    ListChatPage,
  }
}
</script>

<style lang="less" scoped>
.chat-page-wrap {
  min-height: 90vh;
  .title {
    margin: 1rem 0;
  }
  .content-page {
    display: flex;
    flex-direction: row;
    .side-list-user {
      width: 25%;
      height: 90vh;
      border: 1px solid red;
    }
    .main-chat {
      width: 75%;
      height: 90vh;
     border: 1px solid blue;
    }
  }
}
</style>
