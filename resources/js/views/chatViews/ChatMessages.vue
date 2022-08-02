<template>
  <div id="chatlogs" class="chat-messages-wrap">
    <div v-for="message in messages" :key="message.id" class="container-msg" :class="isMessageFromSender(message.user_id) ? 'darker' : ''">
      <div
        v-if="isMessageFromSender(message.user_id)"
        class="left clearfix icon"
      >
        ●
        <div class="clearfix wrap-head">
          <div class="header">
            <strong>
              {{ message.name}}
            </strong>
          </div>
          <p>
            {{ message.body }}
          </p>
          <span class="time-right">{{ dateMessageSent(message.created_at) }}</span>
        </div>
      </div>
      <div v-else class="right clearfix icon">
        <div class="clearfix wrap-head">
          <div class="header">
            <strong>
              {{ message.name}}
            </strong>
          </div>
          <p>
            {{ message.body }}
          </p>
          <span class="time-left">{{ dateMessageSent(message.created_at) }}</span>
        </div>
        ●
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  props: ["messages"],
  updated () {
    let element = document.getElementById('chatlogs');
    element.scrollTop = element.scrollHeight;
  },
  mounted() {
    console.log('Chat Message Mounted')
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
  },
  methods: {
    isMessageFromSender(senderId) {
      return parseInt(senderId) !== this.user.id
    },
    dateMessageSent(date) {
      if (!date) return

      const d = new Date(date)
      return d.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit' })
    }
  }
};
</script>

<style lang="less" scoped>
.chat-messages-wrap {
  height: 78vh;
  overflow-y: scroll;

  .icon {
    display: flex;
    flex-direction: row;
  }

  .wrap-head {
    margin: 0 1rem;
    width: 95%;
  }

  .left {
    text-align: left;
  }

  .right {
    text-align: right;
  }

  p {
    // width: 90%;
  }

  .container-msg {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 10px 0 10px;

    &::after {
      content: "";
      clear: both;
      display: table;
    }
  }

  .darker {
    border-color: #ccc;
    background-color: #ddd;
  }

  .time-right {
    float: right;
    color: #aaa;
  }

  .time-left {
    float: left;
    color: #999;
  }
}
</style>
