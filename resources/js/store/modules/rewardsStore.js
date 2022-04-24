import Axios from "axios"
import { GET_REWARDS, CREATE_REWARDS } from "../mutation-types"

const state = {
  editRewardsData: '',
  getRewardsData: '',
}

const actions = {
  getRewardsByCampaignId({commit}, campaignId){
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + campaignId + '/rewards'
      Axios.get(apiUrl)
        .then(res => {
          commit(GET_REWARDS, res.data.data)
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  createRewards({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param.campaignId + '/rewards'
      Axios.post(apiUrl, param.data)
        .then(res => {
          commit(CREATE_REWARDS, res.data)
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  editRewards({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param.campaignId + '/rewards/reward/' + param.updatesId
      Axios.post(apiUrl, param.data)
        .then(res => {
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  deleteRewards({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/delete_reward/' + param
      Axios.delete(apiUrl, param)
        .then(res => {
          commit('')
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  }
}

const mutations = {
  [CREATE_REWARDS](state, data) {
    state.editRewardsData = data
  },
  [GET_REWARDS](state, data) {
    state.getRewardsData = data
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
