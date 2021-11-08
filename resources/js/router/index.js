import Vue from "vue"
import VueRouter from 'vue-router'

import Main from "../components/Main"
// import Admin from "./views/admin/Admin"
import Login from "./views/admin/Login";
import Register from "./views/admin/Register";
import Brands from "./views/admin/page/Brands";
import store from '../store'
import Applications from "./views/admin/page/Applications";
import PrivacyPolicy from "./views/PrivacyPolicy";
import CasesAdmin from "./views/admin/page/CasesAdmin";

const Admin = () => import(/* webpackChunkName: "admin" */ './views/admin/Admin')

Vue.use(VueRouter)

const routes = [
    {path: '/', component: Main, name: 'Main', meta: {title: 'Главная', middleware: 'guest'}},
    {
        path: '/admin', component: Admin, name: 'admin', meta: {title: 'Админ', middleware: 'auth'}, children: [
            {path: 'brands', component: Brands, name: 'admin.brands', meta: {title: 'Клиенты', middleware: 'auth'}},
            {
                path: 'applications',
                component: Applications,
                name: 'admin.applications',
                meta: {title: 'Заявки', middleware: 'auth'}
            },
            {
                path: 'cases',
                component: CasesAdmin,
                name: 'admin.cases',
                meta: {title: 'Кейсы', middleware: 'auth'}
            },
        ],
        beforeEnter: (to, from, next) => {
            if (store.state.auth.authenticated) {
                next()
            } else {
                next({name: "login"})
            }
        }
    },
    {path: '/login', component: Login, name: 'login', meta: {title: 'Авторизация', middleware: 'guest'}},
    {path: '/register', component: Register, name: 'register', meta: {title: 'Регистрация', middleware: 'guest'}},
    {
        path: '/privacy-policy',
        component: PrivacyPolicy,
        name: 'privacy-policy',
        meta: {title: 'Политика конфиденциальности', middleware: 'guest'}
    }
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router
