<template>
    <div ref="parallax" class="parallaxAdvantages">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap, Linear} from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger.js";

export default {
    name: "BallsAdvantages",
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
            duration: 1,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballTwo, {
            y: -400,
            ease: Linear.easeNone,
            triggerHook: 0.4,
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballThree, {
            y: -500,
            duration: 3,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballFour, {
            y: -500,
            duration: 4,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballFifth, {
            y: -500,
            duration: 5,
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

.parallaxAdvantages {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;

    @include small-desktop {
        height: 550px;
    }

    @include tablet {
        width: 93%;
        height: 610px;
    }

    @include mobile {
        width: 86.3%;
        height: 340px;
    }
    @include mobile-max {
        width: 86.3%;
        height: 340px;
    }

    .ballOne {
        width: 128px;
        height: 128px;
        top: 500px;
        left: -60px;

        @include mobile {
            width: 90px;
            height: 90px;
            top: 220px;
            left: -30px;
        }
        @include mobile-max {
            width: 90px;
            height: 90px;
            top: 220px;
            left: -30px;
        }
    }

    .ballTwo {
        width: 36px;
        height: 36px;
        top: 500px;
        left: 800px;
        opacity: .5;

        @include small-desktop {
            left: 550px;
        }

        @include tablet {
            left: 550px;
        }

        @include mobile {
            top: auto;
            bottom: -200px;
            left: 0;
        }

        @include mobile-max {
            top: auto;
            bottom: -200px;
            left: 0;
        }
    }

    .ballThree {
        width: 64px;
        height: 64px;
        right: -30px;
        top: 230px;

        @include mobile {
            display: none;
        }

        @include mobile-max {
            display: none;
        }
    }

    .ballFour {
        width: 18px;
        height: 18px;
        bottom: -170px;
        left: 10px;
        opacity: .5;

        @include small-desktop {
            bottom: -340px;
            left: 10px;
        }

        @include tablet {
            bottom: -560px;
            left: 10px;
        }

        @include mobile-max {
            display: none;
        }

        @include mobile {
            display: none;
        }
    }

    .ballFifth {
        width: 18px;
        height: 18px;
        right: 430px;
        bottom: -150px;

        @include small-desktop {
            bottom: -320px;
            right: 300px;
        }
        @include tablet {
            bottom: -520px;
            right: 100px;
        }

        @include mobile {
            right: -40px;
            bottom: -260px;
        }
    }

    > * {
        position: absolute;
    }
}
</style>