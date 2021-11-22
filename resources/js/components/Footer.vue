<template>
    <footer class="footer py">
        <div class="footer-top-wrapper">
            <p class="address">г. Москва, пер. 2-й Кожевнический, д. 12, строение 10, 2 подъезд, 2 этаж</p>
            <a href="tel:+7 (495) 994 93 89">+7 (495) 994 93 89</a>
            <a href="mailto:support@otclick-adv.ru">support@otclick-adv.ru</a>
            <a href="#" v-scroll-to="'#contactForm'">Форма обратной связи</a>
            <router-link to="/admin" class="account">Личный кабинет</router-link>
        </div>
        <div class="footer-bottom-wrapper">
            <div class="copyright">&copy; 2011 - {{ new Date().getFullYear() }} {{getHostname}}</div>
            <router-link class="privat-policy" to="/privacy-policy">Политика конфиденциальности</router-link>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer",
    computed: {
        getHostname() {
            return document.location.hostname
        }
    }
}
</script>

<style scoped>

</style>
