<template>
    <div ref="parallax" class="parallaxContactForm">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap, Linear} from "gsap"
import {ScrollTrigger} from "gsap/ScrollTrigger.js"

export default {
    name: "BallsContactForm",
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
            y: -500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                start: "top bottom",
                end: "bottom top",
                scrub: true
            },
        });

        gsap.to(ballTwo, {
            y: -400,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                start: "top bottom",
                end: "bottom top",
                scrub: true
            },
        });

        gsap.to(ballThree, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                start: "top bottom",
                end: "bottom top",
                scrub: true
            },
        });
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/mixins";
@import "../../../scss/helpers/media";

.parallaxContactForm {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;

    .ballOne {
        width: 134px;
        height: 134px;
        top: 600px;
        left: -90px;

        //@include small-desktop {
        //    top: 770px;
        //    left: -35px;
        //}
        //
        //@include tablet {
        //    top: 720px;
        //    left: -25px;
        //}
        //
        @include tablet {
            top: 530px;
        }

        @include mobile {
            width: 88px;
            height: 88px;
            top: 550px;
            left: -60px;
        }

        @include mobile-max {
            width: 134px;
            height: 134px;
            top: 800px;
            left: -100px;
        }
    }

    .ballTwo {
        width: 65px;
        height: 65px;
        top: 600px;
        right: -40px;

        @include tablet {
            top: 500px;
            right: -20px;
        }

        @include mobile {
            width: 46px;
            height: 46px;
            top: 500px;
            right: -20px;
        }

        @include mobile-max {
            width: 46px;
            height: 46px;
            top: 270px;
            right: -10px;
        }
    }

    .ballThree {
        width: 57px;
        height: 57px;
        bottom: -300px;
        right: 300px;
        opacity: .5;

        @include tablet {
            right: 150px;
        }

        @include mobile {
            bottom: -270px;
            right: -20px;
        }

        @include mobile-max {
            bottom: -250px;
            right: -10px;
        }
    }

    > * {
        position: absolute;
    }
}
</style>