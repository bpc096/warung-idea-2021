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
      // Saving Previus User Data Messages
      this.saveChatUser(this.userId, this.messages)
      console.log('Chat Changing Old User is ' + from.params.userId)
      console.log('Chat Changing New User is ' + to.params.userId)


      //Fetching New User Data Messages
        //Check chatMsgData if exist then fetch
        this.messages = []
        // if not exist make it empty
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
