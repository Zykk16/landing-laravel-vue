<template>
    <div class="login-container my blur">
        <form v-if="!remindPassword" action="javascript:void(0)" class="login-form" method="post">
            <h1>Авторизация</h1>
            <div class="form-group">
                <input type="text" v-model="auth.email" class="form-control blur" placeholder="Логин">
            </div>
            <div class="form-group">
                <input type="password" v-model="auth.password" class="form-control blur" placeholder="Пароль">
            </div>
            <Checkbox options="Запомнить меня"/>
            <div class="remind" @click="remindPassword = !remindPassword">Напомнить пароль</div>
            <Button :text="loading ? 'Загрузка...' : 'Авторизоваться'" width="160" @click.native="login"/>
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
                alert(data.message)
            }).finally(() => {
                this.auth = []
                this.loading = false
            })
        }
    }
}
</script>

<style scoped>

</style>
