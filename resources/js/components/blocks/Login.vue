<template>
    <div>
        <Header/>
        <div class="login-container my blur">
            <form v-if="!remindPassword" action="javascript:void(0)" class="login-form" method="post">
                <h1>Авторизация</h1>
                <div class="form-group">
                    <input type="text" v-model="auth.email" class="form-control blur" placeholder="Логин"
                           :class="[errors.email ? 'error-field' : '']" @input="errors.email = ''">
                    <span v-if="errors.email" class="error">{{ errors.email }}</span>
                </div>
                <div class="form-group">
                    <input type="password" v-model="auth.password" class="form-control blur" placeholder="Пароль"
                           :class="[errors.password ? 'error-field' : '']" @input="errors.password = ''">
                    <span v-if="errors.password" class="error">{{ errors.password }}</span>
                </div>
                <Checkbox options="Запомнить меня"/>
                <div class="remind" @click="remindPassword = !remindPassword">Напомнить пароль</div>
                <Button :text="loading ? 'Загрузка...' : 'Авторизоваться'" width="100px" @click.native="login"/>
            </form>
            <RemindPassword v-else @sendRemind="remindPassword = false"/>
        </div>
        <BallsAuth :balls="balls"/>
        <Footer/>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
import Checkbox from "../helpers/Checkbox";
import RemindPassword from "./RemindPassword";
import Button from "../helpers/Button";
import Header from "../Header";
import Footer from "../Footer";
import BallsAuth from "../modules/BallsAuth";

export default {
    name: "Login",
    components: {BallsAuth, Footer, Header, Button, RemindPassword, Checkbox},
    data() {
        return {
            auth: {
                email: '',
                password: ''
            },
            loading: false,
            remindPassword: false,
            errors: {
                email: '',
                password: '',
            },
            balls: [
                {className: 'ballOne', img: 'ball-2'},
                {className: 'ballTwo', img: 'ball-2'},
                {className: 'ballThree', img: 'ball-2'},
                {className: 'ballFour', img: 'ball-1'},
                {className: 'ballFifth', img: 'ball-2'},
                {className: 'ballSixth', img: 'ball-2'},
                {className: 'ballSeventh', img: 'ball-2'},
            ]
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async login() {
            await this.signIn(this.auth).then(() => {
                this.$router.replace({name: 'admin'})
                setTimeout(() => {
                    location.reload()
                }, 500)
            }).catch(({response: {data}}) => {
                this.errors.email = data.errors.email ? data.errors.email[0] : ''
                this.errors.password = data.errors.password ? data.errors.password[0] : ''
            })

        }
    }
}
</script>

<style scoped>

</style>
