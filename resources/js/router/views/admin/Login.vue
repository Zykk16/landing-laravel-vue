<template>
    <form action="#" @submit.prevent="login">
        <div>
            <label for="email">Email address</label>
            <input type="text" name="email" id="email" v-model="form.email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="text" name="password" id="password" v-model="form.password">
        </div>
        <div>
            <button type="submit">
                Sign in
            </button>
        </div>
    </form>
</template>

<script>
import {mapActions} from 'vuex'
import axios from "axios"

export default {
    name: 'Login',

    data() {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },

    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),

        async login() {
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login', this.form).then(() => {
                this.signIn()
            }).catch(data => {
                alert(data.message)
            }).finally(() => {
                this.processing = false
            })
        },
    }
}
</script>

<style scoped>

</style>
