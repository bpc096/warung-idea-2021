import Axios from "axios"
import { GET_CAMPAIGN, UPLOAD_CAMPAIGN } from "../mutation-types"

const CREATE_UPDATES = 'createUpdates'
const GET_UPDATES = 'getUpdates'

const state = {
  editUpdateData: '',
  getUpdateData: '',
}

const actions = {
  getUpdatesByCampaignId({commit}, campaignId){
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + campaignId + '/updates'
      Axios.get(apiUrl)
        .then(res => {
          commit(GET_UPDATES, res.data.data)
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  createUpdates({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param.campaignId + '/updates'
      Axios.post(apiUrl, param.data)
        .then(res => {
          commit(CREATE_UPDATES, res.data)
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  }
}

const mutations = {
  [CREATE_UPDATES](state, data) {
    state.editUpdateData = data
  },
  [GET_UPDATES](state, data) {
    state.getupdateData = data
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
