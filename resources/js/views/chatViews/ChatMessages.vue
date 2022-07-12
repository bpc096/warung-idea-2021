<template>
  <div id="chatlogs" class="chat-messages-wrap">
    <div v-for="message in messages" :key="message.id">
      <div v-if="message.user_id !== user.id" class="left clearfix icon">
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
}
</style>
