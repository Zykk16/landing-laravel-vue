<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="https://techvblogs.com/?ref=project" target="_blank" class="navbar-brand">TechvBlogs</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
import {mapActions} from "vuex";

export default {
    name: 'Admin',
    data() {
        return {
            user: this.$store.state.auth.user
        }
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post('/logout').then(({data}) => {
                this.signOut()
                this.$router.push({name: "login"})
            })
        }
    }
}
</script>

<style lang="sass" scoped>
</style>
