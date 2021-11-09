import Vue from 'vue'
import Vuex from 'vuex'
import {
  ADDING_NUMBER,
  SUBTRACT_NUMBER,
} from './mutation-types'

const state = {
  number: 1,
}

const actions = {
  addingNumber ({commit, state}) {
    commit(ADDING_NUMBER, 1)
  },
  subtractNumber({commit, state}) {
    commit(SUBTRACT_NUMBER, 1)
  }
}

const mutations = {
  [ADDING_NUMBER] (state, data) {
    state.number = state.number + data
  },
  [SUBTRACT_NUMBER] (state, data) {
    state.number = state.number - data
  }
}

const getters = {}

Vue.use(Vuex)
const store = new Vuex.Store({
  state,
  actions,
  mutations,
  getters,
})

export default store