// Vendor plugins.
Vue.use(require('vue-highlightjs'))
Vue.use(require('portal-vue').default)

// Local plugins.
Vue.use(require('@trax/plugins/Auth').default)              // $auth
Vue.use(require('./components/TopbarPlugin').default);      // $topbar
Vue.use(require('./components/SidebarPlugin').default);     // $sidebar
Vue.use(require('@trax/plugins/XapiClient').default);       // $xapi

// Global vars.
Vue.prototype.$baseURL = window.baseURL
Vue.prototype.$appEnv = window.appEnv
Vue.prototype.$appVersion = window.appVersion

// Vue instance.
import routing from './routing'
import i18n from './i18n'
import App from './App.vue'

new Vue({
    router: routing.router(),
    i18n,
    render: h => h(App)
}).$mount("#app")
