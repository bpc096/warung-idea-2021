import { removeHeaderToken, setHeaderToken } from '../../utils/auth'
import { SET_USER, RESET_USER } from '../mutation-types'
import axios from 'axios'

const state = {
  user: null,
  isLoggedIn: false,
}

const actions = {
  login({ dispatch, commit }, data) {
    return new Promise((resolve, reject) => {
      axios.post('login', data)
        .then(response => {
          const token = response.data.token
          localStorage.setItem('token', token)
          setHeaderToken(token)
          dispatch('get_user')
          resolve(response)
        })
        .catch(err => {
          commit(RESET_USER)
          localStorage.removeItem('token')
          reject(err)
        })
    })
  },
  logout({commit}) {
    return new Promise(resolve => {
      commit(RESET_USER)
      localStorage.removeItem('token')
      removeHeaderToken()
      resolve()
    })
  },
  register({commit}, data) {
    return new Promise((resolve, reject) => {
      axios.post('register', data)
      .then(res => {
        resolve(res)
      })
      .catch(err => {
        commit(RESET_USER)
        reject(err)
      })
    })
  },
  updateProfile({commit}, data) {
    return new Promise((resolve, reject) => {
      axios.post('profile', data)
        .then(res => {
          commit(SET_USER, res.data.data)
          resolve(res)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  updatePassword({commit}, data) {
    return new Promise((resolve, reject) => {
      axios.post('profile/password', data)
        .then(res => {
          resolve(res)
        })
        .catch(err => {
          reject(err)
          console.log('err', err)
        })
    })
  },
  requestResetPassword ({commit}, data) {
    return new Promise((resolve, reject) => {
      axios.post('/forgot', data)
      .then(res => {
        resolve(res)
        console.log(res)
      })
      .catch(err => {
        reject(err.response.data)
        console.log(err.response)
      })
    })
  },
  submitPassForgot({commit}, data) {
    return new Promise((resolve, reject) => {
      axios.post('/reset', data)
      .then(res => {
        resolve(res)
        console.log(res)
      })
      .catch(err => {
        reject(err.response.data)
        console.log(err.response)
      })
    })
  },
  async get_user({commit}){
    if(!localStorage.getItem('token')) {
      return
    }
    try{
      let response = await axios.get('profile')
        commit(SET_USER, response.data.data)
    } catch (error){
        commit(RESET_USER)
        removeHeaderToken()
        localStorage.removeItem('token')
        return error
    }
  }
}

const mutations = {
  [SET_USER] (state, data) {
    state.user = data
    state.isLoggedIn = true
  },
  [RESET_USER] (state) {
    state.user = null
    state.isLoggedIn = false
  }
}

const getters = {
  isLoggedIn (state) {
    return state.isLoggedIn
  },
  user (state) {
    return state.user
  }
}

export default {
  state,
  actions,
  mutations,
  getters,
}
