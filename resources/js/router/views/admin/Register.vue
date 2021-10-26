<template>
    <div class="login-container registr my blur">
        <form action="javascript:void(0)" class="login-form" method="post">
            <h1>Регистрация</h1>
            <div class="form-group">
                <input type="text" v-model="user.name" class="form-control blur" placeholder="Логин">
            </div>
            <div class="form-group">
                <input type="email" v-model="user.email" class="form-control blur" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" v-model="user.password" class="form-control blur" placeholder="Пароль">
            </div>
            <div class="form-group">
                <input type="password_confirmation" v-model="user.password_confirmation"
                       class="form-control blur" placeholder="Подтверждение пароля">
            </div>
            <Checkbox options="Ознакомлен и согласен с правилами работы в системе otClick"/>
            <Button :text="loading ? 'Загрузка...' : 'Зарегистрироваться'" width="120px" @click.native="register"/>
        </form>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
import Checkbox from "../../../components/helpers/Checkbox";
import Button from "../../../components/helpers/Button";

export default {
    name: 'Register',
    components: {Button, Checkbox},
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            loading: false
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async register() {
            this.loading = true
            await axios.post('/register', this.user).then(response => {
                this.signIn()
            }).catch(({response: {data}}) => {
                alert(data.message)
            }).finally(() => {
                this.loading = false
            })
        }
    }
}
</script>
