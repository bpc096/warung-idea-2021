/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue'
import Axios from 'axios'
import Vue from 'vue'
import router from './router'
import store from './store'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import { setHeaderToken } from './utils/auth'

const devApp = true //TODO : change this before deploy
const isDeployHeroku = false // TODO : change this to false when deploy cpanel

let setBaseUrl = ''
if(devApp) {
  if(isDeployHeroku) {
    setBaseUrl = 'https://warungidea.herokuapp.com/api/'
  }else {
    setBaseUrl = 'http://localhost:8000/api/'
  }
} else {
  setBaseUrl = 'https://www.warungidea.com/api/'
}

Axios.defaults.baseURL = setBaseUrl


Vue.config.productionTip = false
Vue.use(Axios)

const token = localStorage.getItem('token')
if(token) {
  setHeaderToken(token)
}

store.dispatch('get_user', token)
.then( () => {
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
})
.catch(err => {
  console.error(err)
})



