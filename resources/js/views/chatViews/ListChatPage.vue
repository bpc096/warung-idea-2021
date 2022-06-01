<template>
  <div class="list-chat-page">
    <div v-if="userList.length > 0" class="user-wrap">
      <a
        v-for="(u,idx) in userList"
        :key="idx"
        class="user-card"
        @click="changeChatContainer(u.id, u.userId)"
      >
        <div class="user-image">
          <img :src="u.sourceImg" alt="user-image-profile">
        </div>
        <div class="user-name">
          <b>{{u.name}}</b>
        </div>
      </a>
    </div>
    <div v-else class="user-empty-wrap">
      <h3>Empty List</h3>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from "axios"

export default {
  name: 'ListChatPage',
  data: () => {
    return {
      userList: [
        {
          id: 1,
          userId: 1,
          sourceImg: 'https://us.123rf.com/450wm/apoev/apoev1902/apoev190200141/125038134-person-gray-photo-placeholder-man-in-a-costume-on-gray-background.jpg?ver=6',
          name: 'M Faisal Ghozi',
        },
        {
          id: 2,
          userId: 2,
          sourceImg: 'https://us.123rf.com/450wm/apoev/apoev1902/apoev190200141/125038134-person-gray-photo-placeholder-man-in-a-costume-on-gray-background.jpg?ver=6',
          name: 'Bill Petrus'
        }
      ],
      mockUserList: [],
    }
  },
  created() {
    this.fetchChatList()
  },
  computed: {
    ...mapGetters({
      user: 'user'
    }),
    getCurrentPath () {
      return this.$route.path
    }
  },
  methods: {
    changeChatContainer (conversationId = 0,targetId = 1) {
      const getCurrentTargetId = this.getCurrentPath.split('/').filter(x => Number.isInteger(parseInt(x)))
      if(parseInt(getCurrentTargetId[0]) === targetId || getCurrentTargetId.length <= 0) return
      this.$router.replace({
        path: '/chat/'+ conversationId +'/user/' + targetId
      })
    },
    fetchChatList() {
      const apiUrl = 'chats/' + this.user.id
      axios.get(apiUrl)
        .then((res) => {
          this.mockUserList = res.conversation_list
        })
        .catch((err) => {
          console.error(err)
        })
    }
  }
}
</script>

<style lang="less" scoped>
.list-chat-page {
  min-height: 90vh;
  width: 100%;

  .user-empty-wrap {
    border-top: 1px solid black;
    display: flex;
    min-height: 90vh;
    flex-direction: row;
    justify-content: center;
    align-items: center;
  }

  .user-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;

    a {
      text-decoration: none;
      color: black;
    }

    a:hover {
      background-color: #B8F1B0;
    }

    .user-card {
      display: flex;
      flex-direction: row;
      height: 5rem;
      width: 100%;
      border: 1px solid grey;
      align-items: center;
      margin: 10px 0;

      &:first-child {
        margin-top: 0;
      }

      .user-image {
        width: 30%;
        background-color: grey;
        height: 100%;

        img {
          width: 5rem;
          height: 4.5rem;
          border-radius: 50%;
        }
      }
      .user-name {
        width: 70%;
      }
    }
  }

}
</style>
