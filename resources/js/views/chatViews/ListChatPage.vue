<template>
  <div class="list-chat-page">
    <loading
      :active="isLoading"
      :can-cancel="false"
      :lock-scroll="true"
      :is-full-page="true"
      :height="125"
      :width="125"
    />
    <div v-if="userList.length > 0" class="user-wrap">
      <a
        v-for="(u,idx) in userList"
        :key="idx"
        class="user-card"
        :class="{'card-active': u.isActive}"
        @click="changeChatContainer(u.id, u.receiver, u.code)"
      >
        <div class="user-image">
          <img :src="sourceImg" alt="user-image-profile">
        </div>
        <div class="user-name">
          <b>{{u.sender}}</b>
        </div>
      </a>
    </div>
    <div v-else class="user-empty-wrap">
      <h3>Empty List</h3>
    </div>
  </div>
</template>


<script>
// Loading Component
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

import { mapGetters } from 'vuex'
import axios from "axios"

export default {
  name: 'ListChatPage',
  components: {
    Loading,
  },
  data: () => {
    return {
      isLoading: true,
      sourceImg: 'https://us.123rf.com/450wm/apoev/apoev1902/apoev190200141/125038134-person-gray-photo-placeholder-man-in-a-costume-on-gray-background.jpg?ver=6',
      userList: [],
      mockUserList: [
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
    }
  },
  mounted() {
    this.fetchChatList()
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
    },
    userId() {
      const userId = parseInt(this.$route.params.userId || '0')
      return userId
    },
    chatId () {
      const chatId = parseInt(this.$route.params.chatId || '0')
      return chatId
    },
    chatCode () {
      const chatCode = this.$route.params && this.$route.params.chatCode ? this.$route.params.chatCode : 0
      return chatCode
    }
  },
  methods: {
    changeChatContainer (conversationId = 0,targetId = 1, targetChatCode = 0) {
      const splitCurrentPath  = this.getCurrentPath.split('/')
      const getParamChatCode = targetChatCode

      const getCurrentTargetId = splitCurrentPath.filter(x => Number.isInteger(parseInt(x)))
      const isCurrentChatCodeSame = splitCurrentPath.findIndex(x => x === getParamChatCode)

      if( parseInt(getCurrentTargetId[0]) === targetId ||
          getCurrentTargetId.length <= 0 ||
          isCurrentChatCodeSame !== -1 ) return

      this.mappingChooseActiveUser(conversationId)
      this.$router.replace({
        path: '/chat/'+ conversationId +'/user/' + targetId + '/code/' + getParamChatCode
      })
    },
    mappingChooseActiveUser (convoId = 0) {
      const isUserActive = this.userList.map( user => {
        const newUser = {
          ...user,
          isActive: user.id === convoId
        }
        return newUser
      })

      this.userList = isUserActive
    },
    async fetchChatList() {
      const apiUrl = 'chats/' + this.user.id
      await axios.get(apiUrl)
        .then((res) => {
          const response = res.data
          if(response.success) {
            const tempConvoList = response.conversation_list
            this.userList = tempConvoList.map( (user,idx) => ({...user, isActive: false}))

            if(this.chatCode !== 0) {
              this.mappingChooseActiveUser(this.chatId)
            }
          }
        })
        .catch((err) => {
          this.isLoading = false
          console.error(err)
        })
      this.isLoading = false
    }
  }
}
</script>

<style lang="less" scoped>
.list-chat-page {
  min-height: 90vh;
  width: 100%;

  .user-empty-wrap {
    border-top: .5px solid black;
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
    height: 90vh;
    overflow-y: scroll;
    direction: rtl;

    a {
      text-decoration: none;
      color: black;
      direction: ltr;
    }

    a:hover {
      background-color: #B8F1B0;
    }

    .card-active {
      background-color: #25c5df;
    }

    .user-card {
      display: flex;
      flex-direction: row;
      height: 5rem;
      width: 100%;
      border: 1px solid grey;
      align-items: center;
      margin: 10px 0;
      direction: ltr;


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
