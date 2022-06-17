<template>
  <div class="chat-page-wrap">
    <div class="title">
      <h1>Chat Message</h1>
    </div>
    <div class="d-flex justify-content-end mr-lg-5 mb-lg-2">
      <button type="button" class="btn btn-success" @click="reloadChat">Reload Chat</button>
    </div>
    <div class="content-page">
      <div class="side-list-user">
        <ListChatPage />
      </div>
      <div class="main-chat">
        <div class="container">
          <router-view></router-view>
        </div>
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
  },
  methods: {
    reloadChat () {
      this.$router.go()
    }
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
      width: 20%;
      height: 90vh;
    }
    .main-chat {
      width: 80%;
      height: 90vh;

      .container {
        padding: 0;
        margin: 0;
        max-width: 100%;
        height: 100%;
      }
    }
  }
}
</style>
