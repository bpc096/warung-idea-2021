import Axios from "axios"
import { GET_CAMPAIGN, UPLOAD_CAMPAIGN } from "../mutation-types"

const state = {
  articleList: [],
  campaignUpload: {},
  // campaignList: [],
}

const actions = {
  getAllCampaign({commit}) {
    return new Promise((resolve, reject) => {
      Axios.get('campaign')
        .then(res => {
          // commit(GET_CAMPAIGN, res.data.data)
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
          reject(err)
        })
    })
  },
}

const mutations = {
  [GET_CAMPAIGN] (state, data) {
    state.campaignList = data
  },
  [UPLOAD_CAMPAIGN] (state, data) {
    state.campaignDetail = data
  }
}

const getters = {
  getAllCampaign (state) {
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
