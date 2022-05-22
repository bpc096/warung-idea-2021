<template>
  <div class="container-chat">
    <div class="card">
      testing - {{ userId }}
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
</template>

<script>
import ChatForm from './ChatForm.vue'
import ChatMessages from './ChatMessages.vue'

import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  name: 'ChatContainer',
  components: {
    ChatMessages,
    ChatForm,
  },
  data: () => {
    return {
      messages: [],
      chatMsgData: [],
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    userId() {
      return this.$route.params.userId
    }
  },
  watch: {
    '$route' (to, from) {
      this.saveChatUser(this.userId, this.messages)
      console.log('NEW CREATED ' + this.userId)
      this.messages = []
    }
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
    saveChatUser(userId, chat) {
      if(chat.length <= 0) return

      const chatData = {
        userId: userId,
        messages: chat
      }

      const indexChat = this.chatMsgData.findIndex(x => x.userId === chatData.userId)
      if(indexChat >= 0) {
        chat.forEach((x) => {
          this.chatMsgData[indexChat].messages.push(x)
        })
      } else if (indexChat === -1) {
        this.chatMsgData.push(chatData)
      }
    },
    fetchMessages() {
      // axios.get('/messages').then(response => {
      //   this.messages = response.data;
      // });
    },
    async addMessage(message) {
      this.messages.push(message)

      // axios.post('/messages', message).then(response => {
      //   console.log(response.data);
      // });
    }
  }
}
</script>

<style>
.container-chat {
  padding: 0;
  margin: 0;
  max-width: 100%;
}
</style>
