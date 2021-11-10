<template>
    <div ref="parallax" class="parallaxFormats">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap, Linear} from "gsap"
import {ScrollTrigger} from "gsap/ScrollTrigger.js"

export default {
    name: "BallsFormats",
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

        gsap.registerPlugin(ScrollTrigger)

        gsap.to(ballOne, {
            yPercent: -500,
            duration: 1,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })

        gsap.to(ballTwo, {
            y: -400,
            ease: Linear.easeNone,
            triggerHook: 0.4,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })

        gsap.to(ballThree, {
            y: -500,
            duration: 3,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/mixins";
@import "../../../scss/helpers/media";

.parallaxFormats {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;

    @include huge-mobile {
        width: 86.3%;
        height: 340px;
    }

    @include mobile-max {
        width: 86.3%;
        height: 340px;
    }

    .ballOne {
        width: 72px;
        height: 72px;
        top: calc(85% - 50px);
        left: -35px;
        opacity: .5;

        @include small-desktop {
            top: 770px;
            left: -35px;
        }

        @include tablet {
            top: 720px;
            left: -25px;
        }

        @include mobile {
            top: 680px;
            left: -30px;
        }

        @include huge-mobile {
            width: 23px;
            height: 23px;
            left: 50px;
            top: 330px;
        }

        @include mobile-max {
            width: 23px;
            height: 23px;
            left: 50px;
            top: 330px;
        }
    }

    .ballTwo {
        width: 36px;
        height: 36px;
        top: 430px;
        right: -10px;

        @include small-desktop {
            top: 410px;
        }

        @include tablet {
            top: 390px;
            right: -80px;
            left: auto;
        }

        @include mobile {
            top: 340px;
            right: -10px;
            left: auto;
        }

        @include huge-mobile {
            width: 36px;
            height: 36px;
            top: 360px;
            right: -40px;
            left: auto;
        }

        @include mobile-max {
            width: 36px;
            height: 36px;
            top: 360px;
            right: -40px;
            left: auto;
        }
    }

    .ballThree {
        width: 18px;
        height: 18px;
        bottom: -270px;
        right: 34%;

        @include mobile {
            width: 18px;
            height: 18px;
            bottom: 10%;
            right: 1%;
        }

        @include huge-mobile {
            display: none;
        }

        @include mobile-max {
            display: none;
        }
    }

    > * {
        position: absolute;
    }
}
</style>