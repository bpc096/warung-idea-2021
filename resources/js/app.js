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

Vue .use(Axios)

new Vue(Vue.util.extend({ router, store }, App)).$mount("#app");
