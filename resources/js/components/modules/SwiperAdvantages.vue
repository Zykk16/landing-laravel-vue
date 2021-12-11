<template>
    <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="(item, key) in advantages" :key="key" class="advantages-item blur">
            <div class="advantages-item-icon">
                <img :src="imagePath(item.icon)" :alt="item.title">
            </div>
            <div class="advantages-item-title">{{ item.title }}</div>
            <div class="advantages-item-description">{{ item.description }}</div>
        </swiper-slide>
    </swiper>
</template>

<script>
import {Swiper, SwiperSlide, directive} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

export default {
    name: "SwiperAdvantages",
    props: {
        advantages: Array
    },
    components: {
        Swiper,
        SwiperSlide
    },
    data() {
        return {
            swiperOptions: {
                slidesPerView: "auto",
                centeredSlides: true,
                spaceBetween: 20,
            }
        }
    },

    computed: {
        swiper() {
            return this.$refs.mySwiper.$swiper
        }
    },

    methods: {
        imagePath(icon) {
            return require('../../../img/svg/blocks/advantages/' + icon + '.svg')
        }
    },

    directives: {
        swiper: directive
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/mixins";

.swiper-container {
    position: absolute;
    left: -83px;
    padding-bottom: 3.125rem;
    padding-left: 3.95rem;
    max-width: 97vw;
}

.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    width: 370px;
    height: 290px;
    margin: 50px 0;
}
</style>
