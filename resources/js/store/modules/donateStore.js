import Axios from 'axios'
import { SET_DONATION  } from '../mutation-types'

const state = {
  donation: {
    amount: 0,
    message: '',
    campaignSlug: ''
  }
}

const actions = {
  getDonation({commit}) {
    return new Promise((resolve, reject) => {
      Axios.get('/payment')
        .then(res => {
          commit(SET_DONATION, res.data.data.data)
          resolve(res)
        })
        .catch(err => {
          reject(err.response.data)
        })
    })
  },
  storeDonation({commit}, data) {
    return new Promise((resolve, reject) => {
      Axios.post('/payment', data)
        .then(res => {
          commit('')
          resolve(res)
        })
        .catch(err => {
          reject(err.response.data)
        })
    })
  }
}

const mutations = {
 [SET_DONATIONS]() {

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
