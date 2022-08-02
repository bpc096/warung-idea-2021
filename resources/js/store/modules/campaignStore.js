import Axios from "axios"
import { GET_CAMPAIGN, UPLOAD_CAMPAIGN } from "../mutation-types"

const state = {
  articleList: [],
  campaignUpload: {},
  campaignList: [],
}

const actions = {
  getCampaignByUserId({commit}, data) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/users/' + data
      Axios.get(apiUrl)
        .then(res => {
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  getCampaignById({commit}, data) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/get_campaign/' + data
      Axios.get(apiUrl)
        .then(res => {
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  getAllCampaign({commit}) {
    return new Promise((resolve, reject) => {
      Axios.get('campaign')
        .then(res => {
          commit(GET_CAMPAIGN, res.data.data)
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  uploadCampaign({commit}, data) {
    return new Promise((resolve, reject) => {
      Axios.post('campaign', data)
        .then(res => {
          commit(UPLOAD_CAMPAIGN, res.data)
          resolve(res)
        })
        .catch(err => {
          reject(err.response)
        })
    })
  },
  updateCampaign({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param.campaignId
      Axios.post(apiUrl, param.data)
        .then(res => {
          resolve(res)
        })
        .catch(err => {
          reject(err.response)
        })
    })
  },
  deleteCampaign({commit}, param) {
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + param
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
  [GET_CAMPAIGN] (state, data) {
    state.campaignList = data.data
  },
  [UPLOAD_CAMPAIGN] (state, data) {
    state.campaignDetail = data
  }
}

const getters = {
  listCampaigns (state) {
    return state.campaignList
  },
  getUploadedCampaign (state) {
    return state.campaignDetail
  },
}

export default {
  state,
  actions,
  mutations,
  getters,
}
