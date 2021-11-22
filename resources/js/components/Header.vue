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
                    <div :id="item.id" @click.prevent="backToHome(item.id)">
                        <a href="#" v-scroll-to="item.url">{{ item.name }}</a>
                    </div>
                </li>
            </ul>
        </nav>
        <Button url="#" scroll-to="#contactForm"
                :id="'another-button'"
                @click.native.prevent="backToHome('another-button')"
                :width="screen ? 'auto' : '115px'"
                :mobile="screen" text="Связаться со мной"/>
        <MobileMenu v-if="screen" :menu="menu"/>
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
                {name: 'О нас', url: '#about', id: 'about-header'},
                {name: 'Кейсы', url: '#cases', id: 'cases-header'},
                {name: 'Преимущества', url: '#advantages', id: 'advantages-header'},
                {name: 'Форматы', url: '#formats', id: 'formats-header'},
                {name: 'Клиенты', url: '#clients', id: 'clients-header'}
            ],
            screen: false
        }
    },

    methods: {
        onResize() {
            this.screen = window.innerWidth <= 920;
        },

        backToHome(el) {
            if (this.$route.name !== 'main') {
                this.$router.push('/')
                setTimeout(() => {
                    document.getElementById(el).children[0].click()
                }, 300)
            }
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

</style>
