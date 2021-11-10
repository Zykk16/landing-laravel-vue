<template>
    <div ref="parallax" class="parallaxAuth">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap, Linear} from "gsap"
import {ScrollTrigger} from "gsap/ScrollTrigger.js"

export default {
    name: "BallsAuth",
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
        const ballSixth = this.$refs.ballSixth[0]
        const ballSeventh = this.$refs.ballSeventh[0]

        gsap.registerPlugin(ScrollTrigger)

        gsap.to(ballOne, {
            yPercent: -200,
            duration: 1,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })

        gsap.to(ballTwo, {
            yPercent: -150,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })

        gsap.to(ballThree, {
            y: -170,
            duration: 3,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })

        gsap.to(ballFour, {
            y: -140,
            duration: 4,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })

        gsap.to(ballFifth, {
            y: -150,
            duration: 5,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })

        gsap.to(ballSixth, {
            y: -150,
            duration: 6,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })

        gsap.to(ballSeventh, {
            y: -200,
            duration: 7,
            ease: Linear.easeNone,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/mixins";
@import "../../../scss/helpers/media";

.parallaxAuth {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;

    .ballOne {
        width: 36px;
        height: 36px;
        top: 230px;
        left: 40px;

        @include small-desktop {
            top: 150px;
            left: 40px;
        }

        @include tablet {
            top: 150px;
            left: 30px;
        }

        @include mobile {
            top: 140px;
            left: 20px;
        }

        @include mobile-max {
            width: 25px;
            height: 25px;
            top: 95px;
            left: 15px;
        }
    }

    .ballTwo {
        width: 13px;
        height: 13px;
        top: 230px;
        left: 41%;

        @include small-desktop {
            top: 150px;
            left: 550px;
        }

        @include tablet {
            left: 40%;
            top: 150px;
        }

        @include mobile {
            left: 40%;
            top: 135px;
        }

        @include mobile-max {
            left: 60%;
            top: 90px;
        }
    }

    .ballThree {
        width: 38px;
        height: 38px;
        right: 110px;
        top: 230px;
        opacity: .5;

        @include small-desktop {
            top: 150px;
        }

        @include tablet {
            right: 30px;
            top: 150px;
        }

        @include mobile {
            right: 20px;
            top: 140px;
        }

        @include mobile-max {
            width: 20px;
            height: 20px;
            right: 20px;
            top: 100px;
        }
    }

    .ballFour {
        width: 183px;
        height: 183px;
        top: 400px;
        left: 20px;

        @include small-desktop {
            top: 300px;
            left: 10px;
        }

        @include tablet {
            top: 310px;
            left: -60px;
            width: 120px;
            height: 120px;
        }

        @include mobile {
            top: 280px;
            left: -20px;
            width: 80px;
            height: 80px;
        }

        @include mobile-max {
            display: none;
        }
    }

    .ballFifth {
        width: 18px;
        height: 18px;
        left: 80px;
        top: 710px;

        @include small-desktop {
            top: 590px;
            bottom: 0;
            right: auto;
            left: 80px;
        }

        @include tablet {
            top: 550px;
            left: -5px;
        }

        @include mobile {
            top: 550px;
            left: 10px;
        }

        @include mobile-max {
            top: 370px;
            left: 10px;
        }
    }

    .ballSixth {
        width: 18px;
        height: 18px;
        top: 800px;
        left: 25%;

        @include small-desktop {
            bottom: -130px;
            left: 25%;
        }

        @include tablet {
            left: 25%;
            top: 710px;
        }

        @include mobile {
            left: 30%;
            top: 680px;
        }

        @include mobile-max {
            left: 25%;
            top: 600px;
        }
    }

    .ballSeventh {
        width: 134px;
        height: 134px;
        right: 60px;
        top: 720px;

        @include small-desktop {
            bottom: -150px;
            right: 50px;
        }
        @include tablet {
            width: 99px;
            height: 99px;
            right: 10px;
            top: 650px;
        }

        @include mobile {
            width: 60px;
            height: 60px;
            right: 20px;
            top: 650px;
        }

        @include mobile-max {
            width: 45px;
            height: 45px;
            right: 10px;
            top: 570px;
        }
    }

    > * {
        position: absolute;
    }
}
</style>