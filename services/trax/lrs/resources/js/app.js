
// Bootstrap.
require('@/bootstrap');

// Vue.
import Vue from 'vue/dist/vue.esm.js';
window.Vue = Vue;

// Lib.
Vue.use(require('./lib').default);

// App.
require('./app/main');
