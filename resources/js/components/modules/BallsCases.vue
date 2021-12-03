<template>
    <div ref="parallax" class="parallaxCases">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap, Linear} from "gsap"
import {ScrollTrigger} from "gsap/ScrollTrigger.js"

export default {
    name: "BallsCases",
    props: ['balls'],

    methods: {
        imagePath(icon) {
            return require('../../../img/svg/balls/' + icon + '.svg')
        }
    },

    mounted() {
        const parallax = this.$refs.parallax[0]

        const ballOne = this.$refs.ballOne[0]
        const ballTwo = this.$refs.ballTwo[0]
        const ballThree = this.$refs.ballThree[0]
        const ballFour = this.$refs.ballFour[0]
        const ballFifth = this.$refs.ballFifth[0]

        gsap.registerPlugin(ScrollTrigger)

        gsap.to(ballOne, {
            yPercent: -500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballTwo, {
            y: -400,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballThree, {
            y: -500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballFour, {
            y: -500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballFifth, {
            y: -500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/mixins";
@import "../../../scss/helpers/media";

.parallaxCases {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;

    .ballOne {
        width: 36px;
        height: 36px;
        top: 50px;
        left: -110px;

        @include tablet {
            top: 40px;
            left: 0;
        }

        @include mobile {
            display: none;
        }

        @include mobile-max {
            display: none;
        }
    }

    .ballTwo {
        width: 183px;
        height: 183px;
        top: 180px;
        left: -100px;

        @include small-desktop {

        }

        @include tablet {

        }

        @include mobile {
            left: -130px;
        }

        @include mobile-max {
            left: -130px;
        }
    }

    .ballThree {
        width: 120px;
        height: 120px;
        right: -80px;
        top: 740px;

        @include tablet {
            right: -30px;
            top: 660px;
        }

        @include mobile {
            top: 260px;
            width: 18px;
            height: 18px;
            right: 0;
        }

        @include mobile-max {
            top: 260px;
            width: 18px;
            height: 18px;
            right: 0;
        }
    }

    .ballFour {
        width: 36px;
        height: 36px;
        bottom: -120px;
        left: -10px;

        @include mobile-max {
            width: 18px;
            height: 18px;
            bottom: -80px;
            left: -20px;
        }

        @include mobile {
            width: 18px;
            height: 18px;
            bottom: -80px;
            left: -20px;
        }
    }

    .ballFifth {
        width: 67px;
        height: 67px;
        left: 32%;
        bottom: -150px;
        opacity: .5;

        @include small-desktop {
            left: 66%;
            bottom: -140px;
        }

        @include tablet {
            left: 66%;
            bottom: -140px;
        }

        @include mobile {
            width: 36px;
            height: 36px;
            left: auto;
            bottom: 150px;
            right: 0;
        }

        @include mobile-max{
            width: 36px;
            height: 36px;
            left: auto;
            bottom: 150px;
            right: 0;
        }
    }

    > * {
        position: absolute;
    }
}
</style>