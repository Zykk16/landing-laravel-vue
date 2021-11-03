require('./bootstrap')

import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router'
import store from './store'
import App from './App.vue'
import VueScrollTo from 'vue-scrollto'
import vuetify from "./utils/vuetify";

Vue.use(VueScrollTo)
Vue.use(VueRouter)

new Vue({
    components: {App},
    router,
    store,
    vuetify,
    el: '#app',
    render: h => h('App'),
})
