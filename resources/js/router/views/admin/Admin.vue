<template>
    <v-app class="admin-panel">
        <v-card>
            <v-navigation-drawer app v-model="drawer">
                <v-list-item class="px-2">
                    <v-list-item-title>{{ user.name }}</v-list-item-title>
                </v-list-item>
                <v-list-item class="px-2">
                    <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
                </v-list-item>

                <v-divider></v-divider>

                <v-list dense>
                    <v-list-item v-for="item in items" :key="item.title" link :to="item.href" exact>
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <template v-slot:append>
                    <div class="pa-2">
                        <v-btn block depressed rounded elevation="2" href="/">Back to site</v-btn>
                    </div>
                </template>
            </v-navigation-drawer>
        </v-card>
        <v-main>
            <v-container fluid class="admin-content">
                <div v-if="$route.name === 'admin'">Welcome!</div>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import {mapActions} from "vuex";
import 'vuetify/dist/vuetify.min.css'

export default {
    name: 'Admin',
    data() {
        return {
            user: this.$store.state.auth.user,
            drawer: true,
            items: [
                {title: 'Dashboard', href: '/admin', icon: 'mdi-monitor-dashboard'},
                {title: 'Applications', href: '/admin/applications', icon: 'mdi-email-outline'},
                {title: 'Cases', href: '/admin/cases', icon: 'mdi-briefcase-variant-outline'},
                {title: 'Clients', href: '/admin/brands', icon: 'mdi-human-handsup'},
                {title: 'Users', href: '/admin/users', icon: 'mdi-account'},
            ],
        }
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),

        // async logout() {
        //     await axios.post('/logout').then(({data}) => {
        //         this.signOut()
        //         this.$router.push({name: "login"})
        //     })
        // }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../../scss/helpers/varibles";

$font-family: 'ArtegraSoft-Medium', sans-serif;
.v-btn {
    letter-spacing: 0 !important;
}

.v-application {
    [class*='text-'] {
        color: #36405a;
        font-family: $font-family, sans-serif !important;
        letter-spacing: normal !important;
    }

    font-family: $font-family, sans-serif !important;
}

.admin-panel {
    display: flex;

    .sidebar {
        flex: 0 0 300px;
        padding: 1em;
        background-color: #343a40;
        color: #fff;

        .back-to-landing {
            display: block;
            margin-bottom: 1em;
            font: 16px/1 'ArtegraSoft-Medium', sans-serif;
            color: $white;
        }

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
