<template>
    <div>
        Dashboard <br>
        {{user}}
        <div v-if="user">
            Name: {{ user.name }} <br>
            Email: {{ user.email }}<br><br>
            <button @click.prevent="logout">Logout</button>
        </div>

    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'Admin',
    data() {
        return {
            user: this.$store.state.auth.user
        }
    },
    methods: {
        logout() {
            axios.post('/logout').then(() => {
                this.$router.push({name: "Home"})
            })
        }
    },
    // mounted() {
    //     axios.get('/user').then((res) => {
    //         this.user = res.data
    //     })
    // }
}
</script>

<style lang="sass" scoped>
</style>
