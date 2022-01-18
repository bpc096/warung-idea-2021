import Axios from "axios"
import { SET_ARTICLE } from "../mutation-types"

const state = {
  articleList: []
}

const actions = {
  initArticle({commit}) {
    return new Promise(resolve => {
      Axios.get('articles')
        .then(res => {
          commit(SET_ARTICLE,res.data)
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  }
}

const mutations = {
  [SET_ARTICLE] (state, data) {
    state.articleList = data
  }
}

const getters = {
  articles (state) {
    return state.articleList
  }
}

export default {
  state,
  actions,
  mutations,
  getters,
}
