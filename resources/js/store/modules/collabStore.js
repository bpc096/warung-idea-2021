import Axios from "axios"
import { GET_COLLABORATOR, SET_COLLABORATOR } from "../mutation-types"

const state = {
  getCollaboratorData: '',
  availableCollaboratorData: '',
}

const actions = {
  getCollaboratorAvailableList({commit}){
    return new Promise((resolve, reject) => {
      const apiUrl = 'user'
      Axios.get(apiUrl)
        .then(res => {
          commit(SET_COLLABORATOR, res.data.data)
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  acceptInvitation({commit}, param){
    return new Promise((resolve, reject) => {
      const apiUrl = 'profile/invitation/accept'
      Axios.post(apiUrl, param)
        .then(res => {
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  rejectInvitation({commit}, param){
    return new Promise((resolve, reject) => {
      const apiUrl = 'profile/invitation/reject'
      Axios.post(apiUrl, param)
        .then(res => {
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  getInvitationListByUserId({commit}, userId){
    return new Promise((resolve, reject) => {
      const apiUrl = 'profile/invitation/' + userId
      Axios.get(apiUrl)
        .then(res => {
          resolve(res.data)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
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
  },
  [SET_COLLABORATOR](state, data){
    state.availableCollaboratorData = data
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
