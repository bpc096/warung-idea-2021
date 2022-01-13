import Vue from 'vue'
import Vuex from 'vuex'
import {
  ADDING_NUMBER,
  SUBTRACT_NUMBER,
} from './mutation-types'

// Module Store
import authStore from './modules/authStore'
import profileStore from './modules/profileStore'

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
    ...profileStore.state
  },
  actions: {
    ...actions__,
    ...authStore.actions,
    ...profileStore.actions,
  },
  mutations: {
    ...mutations__,
    ...authStore.mutations,
    ...profileStore.mutations,
  },
  getters: {
    ...getters__,
    ...authStore.getters,
    ...profileStore.getters,
  },
})

export default store
