import Vue from "vue"
import VueRouter from 'vue-router'

import Admin from "./views/admin/Admin"
import Login from "./views/admin/Login";
import Register from "./views/admin/Register";
import Main from "../components/Main"
import store from '../store'

Vue.use(VueRouter)

const routes = [
    {path: '/', component: Main, name: 'Main', meta: {title: 'Главная', meta: {middleware: 'guest'}}},
    {path: '/admin', component: Admin, name: 'admin', meta: {title: 'Админ', middleware: 'auth'}},
    {path: '/login', component: Login, name: 'login', meta: {title: 'Авторизация', middleware: 'guest'}},
    {path: '/register', component: Register, name: 'register', meta: {title: 'Регистрация', middleware: 'guest'}},
]

const router = new VueRouter({
    mode: "history",
    routes
})

// router.beforeEach((to, from, next) => {
//     if (to.meta.middleware === "guest") {
//         if (store.state.auth.authenticated) {
//             console.log(store.state.auth.authenticated)
//             next({name: "admin"})
//         }
//         next()
//     } else {
//         if (store.state.auth.authenticated) {
//             next()
//         } else {
//             next({name: "login"})
//         }
//     }
// })

export default router
