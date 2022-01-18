import Vue from 'vue'
import Vuex from 'vuex'
import {
  ADDING_NUMBER,
  SUBTRACT_NUMBER,
} from './mutation-types'

// Module Store
import authStore from './modules/authStore'
import profileStore from './modules/profileStore'
import articleStore from './modules/articleStore'

const state__ = {
  number: 1,
}

const actions__ = {
  addingNumber ({commit, state}) {
    commit(ADDING_NUMBER, 1)
  },
  subtractNumber({commit, state}) {
    commit(SUBTRACT_NUMBER, 1)
  },
}

const mutations__ = {
  [ADDING_NUMBER] (state, data) {
    state.number = state.number + data
  },
  [SUBTRACT_NUMBER] (state, data) {
    state.number = state.number - data
  },
}

const getters__ = {

}

Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
    ...state__,
    ...authStore.state,
    ...profileStore.state,
    ...articleStore.state
  },
  actions: {
    ...actions__,
    ...authStore.actions,
    ...profileStore.actions,
    ...articleStore.actions,
  },
  mutations: {
    ...mutations__,
    ...authStore.mutations,
    ...profileStore.mutations,
    ...articleStore.mutations,
  },
  getters: {
    ...getters__,
    ...authStore.getters,
    ...profileStore.getters,
    ...articleStore.getters,
  },
})

export default store
