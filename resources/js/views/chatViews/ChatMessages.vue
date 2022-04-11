// resources/assets/js/components/ChatMessages.vue

<template>
  <ul id="chatlogs" class="chat-messages-wrap">
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
  updated () {
    var element = document.getElementById('chatlogs');
    element.scrollTop = element.scrollHeight;
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

  p {
    width: 90%;
  }
}
</style>
