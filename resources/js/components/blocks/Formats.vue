<template>
    <div class="formats my">
        <h1>Форматы</h1>
        <tabs v-if="!screen">
            <tab title="Дисплей">
                <div class="items">
                    <div class="item" v-for="(item, key) in display" :key="key">
                        <div class="image-wrapper blur">
                            <img :src="imagePath(item.img)" :alt="item.title">
                        </div>
                        <div class="title">{{ item.title }}</div>
                    </div>
                </div>
            </tab>
            <tab title="In-app">
                <div class="items">
                    <div class="item" v-for="(item, key) in inApp" :key="key">
                        <div class="image-wrapper">
                            <img :src="imagePath(item.img)" :alt="item.title">
                        </div>
                        <div class="title">{{ item.title }}</div>
                    </div>
                </div>
            </tab>
        </tabs>
        <tabs v-else>
            <tab title="Дисплей">
                <div class="items">
                    <SwiperFormats :array="display"/>
                </div>
            </tab>
            <tab title="In-app">
                <div class="items">
                    <SwiperFormats :array="inApp"/>
                </div>
            </tab>
        </tabs>
        <BallsFormats :balls="balls"/>
    </div>
</template>

<script>
import Tab from "../modules/Tab";
import Tabs from "../modules/Tabs";
import SwiperFormats from "../modules/SwiperFormats";
import BallsFormats from "../modules/BallsFormats";

export default {
    name: "Formats",
    components: {BallsFormats, SwiperFormats, Tab, Tabs},
    data() {
        return {
            screen: false,
            display: [
                {img: 'standard-banner', title: 'Стандартный баннер'},
                {img: 'banner-video', title: 'Баннер с видео'},
                {img: 'expanded-banner', title: 'Баннер с расхлопом'},
                {img: 'out-stream', title: 'Out-stream'},
                {img: 'in-stream', title: 'In-stream'},
            ],
            inApp: [
                {img: 'out-stream', title: 'Out-stream'},
                {img: 'in-stream', title: 'In-stream'},
            ],
            balls: [
                {className: 'ballOne', img: 'ball-2'},
                {className: 'ballTwo', img: 'ball-1'},
                {className: 'ballThree', img: 'ball-2'},
            ]
        }
    },

    methods: {
        imagePath(icon) {
            return require('../../../img/blocks/banners/' + icon + '.png')
        },
        onResize() {
            this.screen = window.innerWidth <= 467;
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

</style>
