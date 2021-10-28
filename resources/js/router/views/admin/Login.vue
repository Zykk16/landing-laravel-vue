<template>
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
</template>

<script>
import {mapActions} from 'vuex'
import Checkbox from "../../../components/helpers/Checkbox";
import RemindPassword from "./RemindPassword";
import Button from "../../../components/helpers/Button";

export default {
    name: "Login",
    components: {Button, RemindPassword, Checkbox},
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
            }
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async login() {
            this.loading = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login', this.auth).then(() => {
                this.signIn()
            }).catch(({response: {data}}) => {
                this.errors.email = data.errors.email ? data.errors.email[0] : ''
                this.errors.password = data.errors.password ? data.errors.password[0] : ''
            }).finally(() => {
                this.loading = false
            })
        }
    }
}
</script>

<style scoped>

</style>
