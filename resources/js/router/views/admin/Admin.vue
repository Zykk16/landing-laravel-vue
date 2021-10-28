<template>
    <div class="admin-panel">
        <div class="sidebar">
            <div class="character">
                <div class="name">{{ user.name }}</div>
                <div class="email">{{ user.email }}</div>
                <a href="javascript:void(0)" @click="logout">Выйти из аккаунта</a>
            </div>
            <nav class="menu">
                <router-link class="menu-item" :to="{name: 'admin.brands'}">Клиенты</router-link>
                <router-link class="menu-item" :to="{name: 'admin.applications'}">Заявки</router-link>
            </nav>
        </div>
        <div class="admin-content">
            <keep-alive>
                <router-view/>
            </keep-alive>
        </div>
    </div>
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

<style lang="scss" scoped>
@import "../../../../scss/helpers/varibles";

.admin-panel {
    display: flex;

    .sidebar {
        flex: 0 0 300px;
        padding: 1em;
        background-color: #343a40;
        color: #fff;

        .character {
            padding-bottom: .3em;
            border-bottom: 1px solid $white;

            .name {
                margin-bottom: .3em;
                font: 16px/1 'ArtegraSoft-Medium', sans-serif;
            }

            .email {
                margin-bottom: .3em;
                font: 14px/1 'ArtegraSoft-Light', sans-serif;
            }

            a {
                font: 14px/1 'ArtegraSoft-Light', sans-serif;
                color: $white;
            }
        }

        .menu {
            display: flex;
            flex-direction: column;
            padding: 1em 0;

            &-item {
                padding-bottom: .5em;
                font: 14px/1 'ArtegraSoft-Bold', sans-serif;
                color: $white;
            }
        }
    }
}
</style>
