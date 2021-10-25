<template>
    <div class="banner py">
        <div class="banner-wrapper banner-offer">
            <h2>Уникальная баннерная</h2>
            <h1 class="gradient-h1">Programmatic сеть</h1>
            <h2>Otclick ADV</h2>
            <p>Мы используем свой стек технологий, собственные аудиторные данные и многолетний опыт работы для
                того, чтобы рекламные кампании проходили качественно и эффективно.</p>
            <Button width="100px" text="Заказать услугу"/>
        </div>
        <div class="banner-wrapper banner-sphere">
            <div class="banner-sphere-advantages item-1 blur">Более 10 000 проведенных рекламных кампаний</div>
            <div class="banner-sphere-advantages item-2 blur">10 лет на рынке</div>
            <div class="banner-sphere-advantages item-3 blur">Более 1000 сайтов в сети</div>
            <div class="banner-sphere-advantages item-4 blur">Более 50 млн уникальных профилей</div>
            <div class="banner-sphere-advantages item-5 blur">Охват 240 млн уникальных устройств</div>
        </div>
    </div>
</template>

<script>
import Button from "../helpers/Button";

export default {
    name: "Banner",
    components: {Button}
}
</script>

<style scoped>

</style>
