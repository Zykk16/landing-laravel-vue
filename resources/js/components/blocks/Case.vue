<template>
    <div>
        <Header/>
        <main role="main" v-if="data">
            <div class="case">
                <div class="case-wrapper blur">
                    <a class="cross-back" @click="backHome">
                        <img src="../../../img/svg/cross.svg" alt="">
                    </a>
                    <img :src="data.image" :alt="data.title">
                    <div class="case-sections">
                        <div class="section">
                            <div v-if="data.title" class="info">
                                <div class="case-title">Клиент:</div>
                                <div class="case-value">{{ data.title }}</div>
                            </div>
                            <div v-if="data.goal" class="info">
                                <div class="case-title">Цель:</div>
                                <div class="case-value">{{ data.goal }}</div>
                            </div>
                            <div v-if="data.geography" class="info">
                                <div class="case-title">География:</div>
                                <div class="case-value">{{ data.geography }}</div>
                            </div>
                            <div v-if="data.period" class="info">
                                <div class="case-title">Период:</div>
                                <div class="case-value">{{ data.period }}</div>
                            </div>
                            <div v-if="data.gender" class="info">
                                <div class="case-title">Пол:</div>
                                <div class="case-value">{{ data.gender }}</div>
                            </div>
                            <div v-if="data.age" class="info">
                                <div class="case-title">Возраст:</div>
                                <div class="case-value">{{ data.age }}</div>
                            </div>
                            <div v-if="data.income" class="info">
                                <div class="case-title">Доход:</div>
                                <div class="case-value">{{ data.income }}</div>
                            </div>
                            <div v-if="data.interest" class="info">
                                <div class="case-title">Интерес:</div>
                                <div class="case-value">{{ data.interest }}</div>
                            </div>
                        </div>
                        <div class="section with-icon">
                            <h1 class="section-title">Результаты кампании</h1>
                            <div v-if="data.shows" class="info icon">
                                <img src="../../../img/blocks/cases/shows.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Показы</div>
                                    <div class="case-value">{{ data.shows }}</div>
                                </div>
                            </div>
                            <div v-if="data.goal" class="info icon">
                                <img src="../../../img/blocks/cases/clicks.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Клики</div>
                                    <div class="case-value">{{ data.clicks }}</div>
                                </div>
                            </div>
                            <div v-if="data.geography" class="info icon">
                                <img src="../../../img/blocks/cases/ctr.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">CTR</div>
                                    <div class="case-value">{{ data.geography }}</div>
                                </div>
                            </div>
                            <div v-if="data.coverage" class="info icon">
                                <img src="../../../img/blocks/cases/coverage.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Охват</div>
                                    <div class="case-value">{{ data.coverage }}</div>
                                </div>
                            </div>
                            <div v-if="data.refusals" class="info icon">
                                <img src="../../../img/blocks/cases/refusals.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Отказы</div>
                                    <div class="case-value">{{ data.refusals }}</div>
                                </div>
                            </div>
                            <div v-if="data.depth" class="info icon">
                                <img src="../../../img/blocks/cases/depth.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Глубина</div>
                                    <div class="case-value">{{ data.depth }}</div>
                                </div>
                            </div>
                            <div v-if="data.duration_session" class="info icon">
                                <img src="../../../img/blocks/cases/duration_session.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Длительность сеанса</div>
                                    <div class="case-value">{{ data.duration_session }}</div>
                                </div>
                            </div>
                            <div v-if="data.cpv" class="info icon">
                                <img src="../../../img/blocks/cases/cpv.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">CPV</div>
                                    <div class="case-value">{{ data.cpv }}</div>
                                </div>
                            </div>
                            <div v-if="data.transaction" class="info icon">
                                <img src="../../../img/blocks/cases/transaction.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Транзакции</div>
                                    <div class="case-value">{{ data.transaction }}</div>
                                </div>
                            </div>
                            <div v-if="data.objectives" class="info icon">
                                <img src="../../../img/blocks/cases/objectives.svg" alt="">
                                <div class="helper">
                                    <div class="case-title">Цели</div>
                                    <div class="case-value">{{ data.objectives }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <BallsCase :balls="balls"/>
            </div>
        </main>
        <Footer/>
    </div>
</template>

<script>
import Header from "../Header";
import Footer from "../Footer";
import BallsCase from "../modules/BallsCase";

export default {
    name: "Case",
    components: {BallsCase, Footer, Header},
    data() {
        return {
            data: this.$route.params.data,
            balls: [
                {className: 'ballOne', img: 'ball-1'},
                {className: 'ballTwo', img: 'ball-2'},
                {className: 'ballThree', img: 'ball-2'},
                {className: 'ballFour', img: 'ball-2'},
                {className: 'ballFifth', img: 'ball-2'},
                {className: 'ballSixth', img: 'ball-1'},
                {className: 'ballSeventh', img: 'ball-2'},
                {className: 'ballEighth', img: 'ball-2'},
                {className: 'ballNinth', img: 'ball-1'},
            ]
        }
    },

    methods: {
        backHome() {
            this.$router.go(-1)
        },

        init() {
            axios.get('/api/cases/' + this.$route.params.slug)
                .then(response => {
                    this.data = response.data
                }).finally(() => {
                document.title = this.data.title
            })
        }
    },

    watch: {
        '$route'(to, from) {
            if (from.name !== 'case') {
                this.init()
            } else {
                this.data = ''
            }
        }
    },

    mounted() {
        this.init()
    }
}
</script>

<style scoped>

</style>