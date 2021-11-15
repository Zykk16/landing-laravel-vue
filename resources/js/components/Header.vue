<template>
    <header class="header my">
        <div class="header-logo">
            <router-link to="/">
                <img src="../../img/svg/logo.svg" alt="Logo">
            </router-link>
        </div>
        <nav class="header-nav">
            <ul class="header-nav-container">
                <li class="header-nav-list" v-for="item in menu">
                    <a href="#" v-scroll-to="item.url">{{ item.name }}</a>
                </li>
            </ul>
        </nav>
        <Button url="#" scroll-to="#contactForm" :width="screen ? 'auto' : '115px'" :mobile="screen" text="Связаться со мной"/>
        <MobileMenu v-if="screen" :menu="menu"/>
        <router-link class="login blur" to="/admin">Admin</router-link>
    </header>
</template>

<script>
import Button from "./helpers/Button";
import MobileMenu from "./modules/MobileMenu";
export default {
    name: "Header",
    components: {MobileMenu, Button},
    data() {
        return {
            menu: [
                {name: 'О нас', url: '#about'},
                {name: 'Кейсы', url: '#cases'},
                {name: 'Преимущества', url: '#advantages'},
                {name: 'Форматы', url: '#formats'},
                {name: 'Клиенты', url: '#clients'}
            ],
            screen: false
        }
    },

    methods: {
        onResize() {
            this.screen = window.innerWidth <= 920;
        }
    },

    created() {
        window.addEventListener('resize', this.onResize)
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.onResize)
    },

    mounted() {
        this.onResize()
    }
}
</script>

<style lang="scss" scoped>
@import "../../scss/helpers/media";

::v-deep .button-container {
    .button {
        @include mobile {
            width: auto !important;
        }
        @include mobile-max {
            width: auto !important;
        }
    }
}

a.login {
    position: absolute;
    top: 0;
    right: 0;
    padding: 1em;
    font: normal 14px/1 'ArtegraSoft-Bold', sans-serif;
}

</style>
