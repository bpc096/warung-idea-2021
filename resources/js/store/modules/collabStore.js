import Axios from "axios"
import { GET_COLLABORATOR } from "../mutation-types"

const state = {
  getCollaboratorData: ''
}

const actions = {
  getCollaboratorByCampaignId({commit}, campaignId){
    return new Promise((resolve, reject) => {
      const apiUrl = 'campaign/' + campaignId + '/faqs'
      Axios.get(apiUrl)
        .then(res => {
          commit(GET_COLLABORATOR, res.data.data)
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
}

const mutations = {
  [GET_COLLABORATOR](state, data) {
    state.getCollaboratorData = data
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
