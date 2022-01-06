import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import {
  ADDING_NUMBER,
  SUBTRACT_NUMBER,
  SET_USER,
  RESET_USER,
} from './mutation-types'

const state = {
  number: 1,
  user: null,
  isLoggedIn: false,
}

const actions = {
  addingNumber ({commit, state}) {
    commit(ADDING_NUMBER, 1)
  },
  subtractNumber({commit, state}) {
    commit(SUBTRACT_NUMBER, 1)
  },
  login({ dispatch, commit }, data) {
    return new Promise((resolve, reject) => {
      axios.post('login-api', data)
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
  async get_user({commit}){
    if(!localStorage.getItem('token')){
      return
    }
    try{
      let response = await axios.get('user-api')
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
  [ADDING_NUMBER] (state, data) {
    state.number = state.number + data
  },
  [SUBTRACT_NUMBER] (state, data) {
    state.number = state.number - data
  },
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

Vue.use(Vuex)
const store = new Vuex.Store({
  state,
  actions,
  mutations,
  getters,
})

export default store
