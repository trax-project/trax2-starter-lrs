import Lodash from 'lodash'
window._ = Lodash

import Popper from 'popper.js'
window.Popper = Popper

import JQuery from 'jquery'
window.$ = window.jQuery = JQuery

import Axios from 'axios'
window.axios = Axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.baseURL = document.head.querySelector('meta[name="base-url"]').content
window.axios.defaults.baseURL = window.baseURL

import Vue from 'vue/dist/vue.esm.js'
window.Vue = Vue

import Lib from './lib'
Vue.use(Lib)

require('./app/main');
