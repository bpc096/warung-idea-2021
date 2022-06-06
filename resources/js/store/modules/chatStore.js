import Axios from "axios"

const state = {
  chatinbox: [],
  chatMessage: [],
}

const actions = {
  initChatInbox({commit}, data) {
    return new Promise((resolve, reject) => {
      const apiUrl = ''
    })
  },
  fetchingChatInbox() {
    return new Promise((resolve, reject) => {

    })
  },
  fetchingChatMessage() {
    return new Promise((resolve, reject) => {

    })
  },
  sendMessage() {

  }
}

const mutations = {

}

const getters = {

}

export default {
  state,
  actions,
  mutations,
  getters,
}
