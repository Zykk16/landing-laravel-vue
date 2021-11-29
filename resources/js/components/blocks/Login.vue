<template>
    <div>
        <Header/>
        <div class="login-container my blur">
            <form v-if="!remindPassword" action="javascript:void(0)" class="login-form" method="post">
                <h1>Авторизация</h1>
                <div class="form-group">
                    <input type="text" v-model="auth.email" class="form-control blur" placeholder="Логин"
                           :class="[errors.email ? 'error-field' : '']" @input="errors.email = ''"
                           @keypress="isLetter($event)">
                    <span v-if="errors.email" class="error">{{ errors.email }}</span>
                </div>
                <div class="form-group">
                    <input type="password" v-model="auth.password" class="form-control blur" placeholder="Пароль"
                           :class="[errors.password ? 'error-field' : '']" @input="errors.password = ''"
                           @keypress="isLetter($event)">
                    <span v-if="errors.password" class="error">{{ errors.password }}</span>
                </div>
                <Checkbox options="Запомнить меня"/>
                <div class="remind register" @click="$router.push('/registration')">Регистрация</div>
                <div class="remind" @click="remindPassword = !remindPassword">Напомнить пароль</div>
                <Button :text="loading ? 'Загрузка...' : 'Авторизоваться'" width="105px" @click.native="login"/>
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

        login() {
            this.errors = [];

            if (!this.auth.email) {
                this.errors.email = 'Данные введены некорректно'
            } else {
                this.errors = ''
            }

            if (!this.auth.password) {
                this.errors.password = 'Данные введены некорректно'
            }

            if (!this.errors.length) {
                return true;
            }
        },

        isLetter(e) {
            let char = String.fromCharCode(e.keyCode)

            if (!/а|б|в|г|д|е|ё|ж|з|и|ё|к|л|м|н|о|п|р|с|т|у|ф|х|ц|ч|ш|щ|ъ|ы|ь|э|ю|я/gi.test(char)) {
                return true
            } else {
                e.preventDefault()
            }
        },
    }
}
</script>

<style scoped>

</style>
