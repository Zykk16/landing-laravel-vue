import axios from "axios";
axios.defaults.withCredentials = true;

import Vue from "vue"
import VueRouter from 'vue-router'
import router from './router'
import store from './store'
import App from './App.vue'
import VueScrollTo from 'vue-scrollto'

Vue.use(VueScrollTo)
Vue.use(VueRouter)

new Vue({
    components: {App},
    router,
    store,
    el: '#app',
    render: h => h('App'),
})
