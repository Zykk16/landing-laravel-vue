<template>
    <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="(item, key) in array" :key="key" class="item">
            <div class="image-wrapper">
                <img :src="imagePath(item.img)" :alt="item.title">
            </div>
            <div class="title">{{ item.title }}</div>
        </swiper-slide>
    </swiper>
</template>

<script>
import {Swiper, SwiperSlide, directive} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

export default {
    name: "SwiperFormats",
    props: {
        array: Array
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
            return require('../../../img/blocks/banners/' + icon + '.png')
        }
    },

    directives: {
        swiper: directive
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/media";

.swiper-container {
    position: absolute;
    left: -100px;
    padding-bottom: 3.125rem;
    padding-left: 6.25rem;
    max-width: 100vw;

    @include huge-mobile {
        left: 0;
        width: 100vw;
        padding: 0;
    }

    @include mobile-max {
        left: 0;
        width: 100vw;
        padding: 0;
    }
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