import { removeHeaderToken, setHeaderToken } from '../../utils/auth'
import { reject } from 'lodash'
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
