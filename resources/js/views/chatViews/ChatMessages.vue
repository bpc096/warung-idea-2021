<template>
  <div id="chatlogs" class="chat-messages-wrap">
    <div class="left clearfix icon" v-for="message in messages" :key="message.id">
      ●
      <div class="clearfix wrap-head">
        <div class="header">
          <strong>
            {{ message.user.name }}
          </strong>
        </div>
        <p>
          {{ message.message }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["messages"],
  updated () {
    let element = document.getElementById('chatlogs');
    element.scrollTop = element.scrollHeight;
  },
  mounted() {
    console.log('Chat Message Mounted')
  }
};
</script>

<style lang="less" scoped>
.chat-messages-wrap {
  height: 70vh;
  overflow-y: scroll;

  .icon {
    display: flex;
    flex-direction: row;
  }

  .wrap-head {
    margin-left: 1rem;
    width: 65%;
  }

  .left {
    text-align: left;
  }

  p {
    width: 90%;
  }
}
</style>
