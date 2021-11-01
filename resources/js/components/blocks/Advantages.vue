<template>
    <div id="advantages" class="advantages my">
        <h1>Почему стоит работать с Нами</h1>
        <div v-if="!screen" class="advantages-wrapper">
            <div v-for="(item, key) in advantages" :key="key" class="advantages-item blur">
                <div class="advantages-item-icon">
                    <img :src="imagePath(item.icon)" :alt="item.title">
                </div>
                <div class="advantages-item-title">{{ item.title }}</div>
                <div class="advantages-item-description">{{ item.description }}</div>
            </div>
        </div>
        <SwiperAdvantages :advantages="advantages" v-if="advantages && screen"/>
        <BallsAdvantages :balls="balls"/>
    </div>
</template>

<script>
import SwiperAdvantages from "../modules/SwiperAdvantages";
import BallsAdvantages from "../modules/BallsAdvantages";

export default {
    name: "Advantages",
    components: {BallsAdvantages, SwiperAdvantages},

    data() {
        return {
            screen: false,
            advantages: [
                {
                    icon: 'data',
                    title: 'Real Estate Data',
                    description: 'Таргетируем по уникальным данным, собираемым на платформе Otclick CPA'
                },
                {
                    icon: 'resources',
                    title: 'Открытые ресурсы',
                    description: 'Предоставляем по запросу'
                },
                {
                    icon: 'standards',
                    title: 'Соблюдаем стандарты',
                    description: 'Оптимизируя кампании по установленным KPI'
                },
                {
                    icon: 'cods',
                    title: 'Любые счетчики и коды',
                    description: 'Принимаем для верификации трафика'
                },
                {
                    icon: 'banners',
                    title: 'Любые размеры баннеров',
                    description: 'Подготавливаем бесплатно для размещения в рамках нашей сети'
                },
                {
                    icon: 'targets',
                    title: 'Широкий выбор таргетов',
                    description: 'Используем для настроек рекламных кампаний, в том числе SuperGeo для IN-APP'
                },
                {
                    icon: 'personal',
                    title: 'Индивидуальный подход',
                    description: 'Персональный менеджер соблюдает на всех этапах коммуникации'
                },
                {
                    icon: 'technologies',
                    title: 'Современные технологии',
                    description: 'Аудиторный таргетинг, look-a-like, ретаргетинг, таргетинг по тематическим ресурсам'
                },
            ],
            balls: [
                {className: 'ballOne', img: 'ball-2'},
                {className: 'ballTwo', img: 'ball-2'},
                {className: 'ballThree', img: 'ball-1'},
                {className: 'ballFour', img: 'ball-1'},
                {className: 'ballFifth', img: 'ball-2'},
            ]
        }
    },

    methods: {
        onResize() {
            this.screen = window.innerWidth <= 768;
        },
        imagePath(icon) {
            return require('../../../img/svg/blocks/advantages/' + icon + '.svg')
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

<style scoped>

</style>
