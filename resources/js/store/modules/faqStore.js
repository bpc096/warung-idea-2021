import Axios from "axios"
import { GET_FAQ, CREATE_FAQ } from "../mutation-types"

const state = {
  editFaqData: '',
  getFaqData: '',
}

const actions = {
  getFaqByCampaignId({commit}, campaignId){
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + campaignId + '/faqs'
      Axios.get(apiUrl)
        .then(res => {
          commit(GET_FAQ, res.data.data)
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  createFaq({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param.campaignId + '/faqs'
      Axios.post(apiUrl, param.data)
        .then(res => {
          commit(CREATE_FAQ, res.data)
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  editFaq({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param.campaignId + '/faqs/faq/' + param.updatesId
      Axios.post(apiUrl, param.data)
        .then(res => {
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  }
}

const mutations = {
  [CREATE_FAQ](state, data) {
    state.editFaqData = data
  },
  [GET_FAQ](state, data) {
    state.getFaqData = data
  }
}

const getters = {

}

export default {
  state,
  actions,
  mutations,
  getters,
}
