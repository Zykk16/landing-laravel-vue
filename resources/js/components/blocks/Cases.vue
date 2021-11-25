<template>
    <div v-if="loading" class="cases my">
        <h1>Кейсы</h1>
        <tabs v-if="!screen" @indexTab="activeTabs">
            <tab :title="item" v-for="(item, i) in getCategoryTabs" :key="i">
                <div class="cases-items">
                    <router-link class="item blur" v-for="(item, key) in pageOfItems" :key="key"
                                 :to="{ name: 'case', params: {slug: item.slug + '-' + item.id, data: item}}">
                        <div class="item-image">
                            <img :src="item.image" :alt="item.title">
                        </div>
                        <h4 class="item-audience">Аудитория</h4>
                        <div class="item-audience-wrapper">
                            <div v-if="item.gender" class="stats">Пол: {{ item.gender }};</div>
                            <div v-if="item.age" class="stats">Возраст: {{ item.age }};</div>
                            <div v-if="item.income" class="stats">Доход: {{ item.income }};</div>
                            <div v-if="item.goal" class="stats">Цель: {{ item.goal }};</div>
                            <div class="stats" v-show="readMore"></div>
                            <div class="read-more" @click.prevent="readMore =! readMore">
                                <div class="hidden" v-if="readMore">свернуть</div>
                                <div class="more" v-else>...подробнее</div>
                            </div>
                        </div>

                        <div class="item-wrapper-indicators">
                            <div class="indicator">
                                <h4 class="indicator-title">Клики</h4>
                                <div class="indicator-value gradient-h1">{{ item.clicks }}</div>
                            </div>
                            <div class="indicator">
                                <h4 class="indicator-title">CTR</h4>
                                <div class="indicator-value gradient-h1">{{ item.ctr }}</div>
                            </div>
                            <div class="indicator">
                                <h4 class="indicator-title">Показы</h4>
                                <div class="indicator-value gradient-h1">{{ item.shows }}</div>
                            </div>
                            <div class="indicator">
                                <h4 class="indicator-title">Охват</h4>
                                <div class="indicator-value gradient-h1">{{ item.coverage }}</div>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div v-if="loading">
                    <jw-pagination :class="sortCasesByTabs.length <= 6 ? 'disabled' : ''"
                                   :items="sortCasesByTabs" @changePage="onChangePage" :pageSize="6"/>
                </div>
            </tab>
        </tabs>
        <tabs v-else @indexTab="activeTabs">
            <tab :title="item" v-for="(item, i) in getCategoryTabs" :key="i">
                <div class="cases-items">
                    <swiper ref="mySwiper" :options="swiperOptions">
                        <swiper-slide class="item blur" v-for="(item, key) in sortCasesByTabs" :key="key"
                                      @click.native="$router.push({ name: 'case', params: {slug: item.slug, data: item}})">
                            <div class="item-image">
                                <img :src="item.image" :alt="item.title">
                            </div>
                            <h4 class="item-audience">Аудитория</h4>
                            <div class="item-audience-wrapper">
                                <div v-if="item.gender" class="stats">Пол: {{ item.gender }};</div>
                                <div v-if="item.age" class="stats">Возраст: {{ item.age }};</div>
                                <div v-if="item.income" class="stats">Доход: {{ item.income }};</div>
                                <div v-if="item.goal" class="stats">Цель: {{ item.goal }};</div>
                            </div>

                            <div class="item-wrapper-indicators">
                                <div class="indicator">
                                    <h4 class="indicator-title">Клики</h4>
                                    <div class="indicator-value gradient-h1">{{ item.clicks }}</div>
                                </div>
                                <div class="indicator">
                                    <h4 class="indicator-title">CTR</h4>
                                    <div class="indicator-value gradient-h1">{{ item.ctr }}</div>
                                </div>
                                <div class="indicator">
                                    <h4 class="indicator-title">Показы</h4>
                                    <div class="indicator-value gradient-h1">{{ item.shows }}</div>
                                </div>
                                <div class="indicator">
                                    <h4 class="indicator-title">Охват</h4>
                                    <div class="indicator-value gradient-h1">{{ item.coverage }}</div>
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>
            </tab>
        </tabs>
        <BallsCases :balls="balls"/>
    </div>
</template>

<script>
import Tabs from "../modules/Tabs"
import Tab from "../modules/Tab"
import {mapActions, mapGetters} from "vuex"
import {Swiper, SwiperSlide, directive} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'
import JwPagination from 'jw-vue-pagination'
import BallsCases from "../modules/BallsCases";

export default {
    name: "Cases",
    components: {BallsCases, Tabs, Tab, Swiper, SwiperSlide, JwPagination},
    data() {
        return {
            screen: false,
            activeTab: 0,
            pageOfItems: [],
            readMore: false,
            swiperOptions: {
                slidesPerView: "auto",
                centeredSlides: true,
                spaceBetween: 20,
            },
            balls: [
                {className: 'ballOne', img: 'ball-2'},
                {className: 'ballTwo', img: 'ball-1'},
                {className: 'ballThree', img: 'ball-2'},
                {className: 'ballFour', img: 'ball-2'},
                {className: 'ballFifth', img: 'ball-2'},
            ]
        }
    },

    directives: {
        swiper: directive
    },

    computed: {
        ...mapGetters({
            cases: 'cases/casesAll',
            loading: 'cases/loading'
        }),

        swiper() {
            return this.$refs.mySwiper.$swiper
        },

        getCategoryTabs() {
            return [...new Set(this.cases.map(a => a.category.name).sort())]
        },

        sortCasesByTabs() {
            return this.cases.filter(x => x.category.name === this.getCategoryTabs[this.activeTab])
        }
    },

    methods: {
        ...mapActions({
            getCases: 'cases/getCasesAll'
        }),

        onResize() {
            this.screen = window.innerWidth <= 768;
        },

        activeTabs(i) {
            this.activeTab = i
        },

        onChangePage(pageOfItems) {
            this.pageOfItems = pageOfItems.filter(e => e.status_id === 1)
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
        this.getCases()
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/media";

.swiper-container {
    position: absolute;
    left: -83px;
    padding-bottom: 3.125rem;
    padding-left: 4rem;
    max-width: 97vw;

    @include mobile-max {
        width: 96vw;
    }
}

.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    width: 370px;
    height: auto;
    margin: 50px 0;

    @include mobile {
        width: 320px;
        margin: 0;
    }

    @include mobile-max {
        width: 320px;
        margin: 0;
    }
}
</style>