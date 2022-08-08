// resources/assets/js/components/ChatForm.vue

<template>
  <div class="input-group">
    <input
      id="btn-input"
      type="text"
      name="message"
      class="form-control input-sm"
      placeholder="Type your message here..."
      v-model="newMessage"
      @keyup.enter="sendMessage"
    />

    <span class="input-group-btn">
      <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
        Send
      </button>
    </span>
  </div>
</template>

<script>
export default {
  props: ["user"],

  data() {
    return {
      newMessage: "",
    };
  },

  methods: {
    sendMessage() {
      if(this.newMessage === '' || !this.newMessage) return

      this.$emit("sentmessage", {
        user_id: this.user.id,
        name: this.user.name,
        body: this.newMessage,
        created_at: new Date(),
      });

      this.newMessage = "";
    },
  },
};
</script>

<style lang="less" scoped>
.btn {
  margin-top: 4px;
  margin-left: 5px;
}
</style>
