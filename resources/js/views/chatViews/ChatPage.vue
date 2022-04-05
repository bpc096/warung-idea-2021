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
        <div class="container">
          <div class="card">
            <div class="card-header">Chats</div>
            <div id="top-scroll-chat" class="card-body">
              <ChatMessages
                :messages="messages"
              >
              </ChatMessages>
            </div>
            <div class="card-footer">
              <ChatForm
                @sentmessage="addMessage"
                :user="user"
              >
              </ChatForm>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ListChatPage from './ListChatPage.vue'
import ChatForm from './ChatForm.vue'
import ChatMessages from './ChatMessages.vue'

import { mapGetters } from 'vuex'
import axios from 'axios'


export default {
  name: 'ChatPage',
  components: {
    ListChatPage,
    ChatMessages,
    ChatForm,
  },
  data: () => {
    return {
      messages: [],
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
  },
  created () {
    this.fetchMessages();

    // window.Echo.private('chat')
    // .listen('MessageSent', (e) => {
    //   this.messages.push({
    //     message: e.message.message,
    //     user: e.user
    //   });
    // });
  },
  methods: {
    fetchMessages() {
      // axios.get('/messages').then(response => {
      //   this.messages = response.data;
      // });
    },
    async addMessage(message) {
      // await this.scrollTopChat()

      console.log(message)
      const msg = {
        message: message.message,
        user: message.user
      }

      this.messages.push(msg)

      // axios.post('/messages', message).then(response => {
      //   console.log(response.data);
      // });
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
