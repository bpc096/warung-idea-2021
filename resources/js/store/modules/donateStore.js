import Axios from 'axios'
import { SET_DONATION  } from '../mutation-types'

const state = {
  donation: {
    amount: 0,
    message: '',
    campaignSlug: '',
  },
  donations: [],
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

          console.log(res)

          commit('')
          resolve(res)
        })
        .catch(err => {

          console.log(err)

          reject(err.response.data)
        })
    })
  }
}

const mutations = {
 [SET_DONATION] (state, donation) {
  state.donations = donation
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
