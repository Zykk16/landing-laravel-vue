<template>
    <div>
        <Header/>
        <div class="register-container registr my blur">
            <form ref="register" v-if="!successRegister" action="javascript:void(0)" class="login-form" method="post">
                <h1>Регистрация</h1>
                <div class="form-group">
                    <input type="text" v-model="user.name" class="form-control blur" placeholder="Логин"
                           @keypress="isLetter($event)"
                           :class="[errors.name ? 'error-field' : '']" @input="errors.name = ''">
                    <span v-if="errors.name" class="error">{{ errors.name }}</span>
                </div>
                <div class="form-group">
                    <input type="email" v-model="user.email" class="form-control blur" placeholder="Email"
                           :class="[errors.email ? 'error-field' : '']" @input="errors.email = ''"
                           @keypress="isLetter($event)">
                    <span v-if="errors.email" class="error">{{ errors.email }}</span>
                </div>
                <div class="form-group">
                    <input type="password" v-model="user.password" class="form-control blur" placeholder="Пароль"
                           :class="[errors.password ? 'error-field' : '']" @input="errors.password = ''"
                           @keypress="isLetter($event)">
                    <span v-if="errors.password" class="error">{{ errors.password }}</span>
                </div>
                <div class="form-group">
                    <input type="password" v-model="user.password_confirmation"
                           class="form-control blur" placeholder="Подтверждение пароля"
                           :class="[errors.password_confirmation ? 'error-field' : '']"
                           name="password_confirmation"
                           @input="errors.password_confirmation = ''"
                           @keypress="isLetter($event)">
                    <span v-if="errors.password_confirmation" class="error">{{ errors.password_confirmation }}</span>
                </div>
                <Checkbox @input="checked" options="Ознакомлен и согласен с правилами работы в системе otClick"/>
                <span v-if="errors.checkbox && !user.checkbox" class="error">{{ errors.checkbox }}</span>
                <Button
                    :text="loading ? 'Загрузка...' : 'Зарегистрироваться'"
                    width="120px"
                    @click.native="register"/>
                <!-- todo: нужно добавить successRegister = !successRegister чтобы воспроизвести регистрацию -->
            </form>
            <SuccessRegisterMessage v-else @success="successRegister = false"/>
        </div>
        <BallsAuth :balls="balls"/>
        <Footer/>
    </div>
</template>

<script>
import Checkbox from "../helpers/Checkbox";
import Button from "../helpers/Button";
import Header from "../Header";
import Footer from "../Footer";
import BallsAuth from "../modules/BallsAuth";
import SuccessRegisterMessage from "./SuccessRegisterMessage";

export default {
    name: 'Register',
    components: {SuccessRegisterMessage, BallsAuth, Footer, Header, Button, Checkbox},
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                checkbox: ''
            },
            successRegister: false,
            errors: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                checkbox: ''
            },
            balls: [
                {className: 'ballOne', img: 'ball-2'},
                {className: 'ballTwo', img: 'ball-2'},
                {className: 'ballThree', img: 'ball-2'},
                {className: 'ballFour', img: 'ball-1'},
                {className: 'ballFifth', img: 'ball-2'},
                {className: 'ballSixth', img: 'ball-2'},
                {className: 'ballSeventh', img: 'ball-2'},
            ],
            loading: false,
        }
    },

    methods: {
        // ...mapActions({
        //     signIn: 'auth/login'
        // }),

        isLetter(e) {
            let char = String.fromCharCode(e.keyCode)

            if (!/а|б|в|г|д|е|ё|ж|з|и|ё|к|л|м|н|о|п|р|с|т|у|ф|х|ц|ч|ш|щ|ъ|ы|ь|э|ю|я/gi.test(char)) {
                return true
            } else {
                e.preventDefault()
            }
        },

        async register() {
            this.loading = true
            await axios.post('/register', this.user).then(() => {
                // this.signIn()
                this.$refs.register.reset()
                this.successRegister = !this.successRegister
            }).catch(({response: {data}}) => {
                this.errors.name = data.errors.name ? data.errors.name[0] : ''
                this.errors.email = data.errors.email ? data.errors.email[0] : ''
                this.errors.password = data.errors.password ? data.errors.password[0] : ''
                this.errors.password_confirmation = data.errors.password_confirmation ? data.errors.password_confirmation[0] : ''
                this.errors.checkbox = data.errors.checkbox ? data.errors.checkbox[0] : ''
            }).finally(() => {
                this.loading = false
            })
        },

        checked(val) {
            this.user.checkbox = val
        }
    }
}
</script>
