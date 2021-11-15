<template>
    <div class="banner py">
        <div class="banner-wrapper banner-offer">
            <h2>Уникальная баннерная</h2>
            <h1 class="gradient-h1">Programmatic сеть</h1>
            <h2>Otclick ADV</h2>
            <p>Мы используем свой стек технологий, собственные аудиторные данные и многолетний опыт работы для
                того, чтобы рекламные кампании проходили качественно и эффективно.</p>
            <Button url="#" scroll-to="#contactForm" width="100px" text="Заказать услугу"/>
        </div>
        <div class="banner-wrapper banner-sphere">
            <div class="banner-sphere-advantages item-1 blur">Более 10 000 проведенных рекламных кампаний</div>
            <div class="banner-sphere-advantages item-2 blur">10 лет на рынке</div>
            <div class="banner-sphere-advantages item-3 blur">Более 1000 сайтов в сети</div>
            <div class="banner-sphere-advantages item-4 blur">Более 50 млн уникальных профилей</div>
            <div class="banner-sphere-advantages item-5 blur">Охват 240 млн уникальных устройств</div>
        </div>
        <BallsBanner :balls="balls"/>
    </div>
</template>

<script>
import Button from "../helpers/Button";
import BallsBanner from "../modules/BallsBanner";

export default {
    name: "Banner",
    components: {BallsBanner, Button},
    data() {
        return {
            balls: [
                {className: 'ballOne', img: 'ball-1'},
                {className: 'ballTwo', img: 'ball-1'},
                {className: 'ballThree', img: 'ball-2'},
                {className: 'ballFour', img: 'ball-2'},
                {className: 'ballFifth', img: 'ball-2'},
                {className: 'ballSixth', img: 'ball-2'},
                {className: 'ballSeventh', img: 'ball-2'},
                {className: 'ballEighth', img: 'ball-2'},
            ]
        }
    }
}
</script>