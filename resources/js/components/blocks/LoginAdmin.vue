<template>
    <div class="login-admin">
        <form action="javascript:void(0)" class="login-form" method="post">
            <h1>Админ панель</h1>
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
            <Button :text="loading ? 'Загрузка...' : 'Авторизоваться'" width="105px" @click.native="login"/>
        </form>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import Button from "../helpers/Button";

export default {
    name: "LoginAdmin",
    components: {Button},
    data() {
        return {
            auth: {
                email: '',
                password: ''
            },
            loading: false,
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

<style lang="scss" scoped>
@import "../../../scss/helpers/varibles";

.login-admin {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0;
    margin-left: 0;
    margin-right: 0;
    width: 100%;
    height: 100%;

    h1 {
        margin-bottom: 1.125em;
        text-align: center;
    }


    .login-form {
        width: 500px;
    }

    ::v-deep .button {
        margin: 1.125em auto 0;
    }

    .error {
        display: block;
        margin-bottom: 1.25em;
        color: $red;
        font: bold 14px/18px 'ArtegraSoft-Medium', sans-serif;
        text-align: center;
    }
}

</style>