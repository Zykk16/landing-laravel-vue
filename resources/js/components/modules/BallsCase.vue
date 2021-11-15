<template>
    <div ref="parallax" class="parallaxCase">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap} from "gsap"
import {ScrollTrigger} from "gsap/ScrollTrigger.js"

export default {
    name: "BallsCase",
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
        const ballEighth = this.$refs.ballEighth[0]
        const ballNinth = this.$refs.ballNinth[0]

        gsap.registerPlugin(ScrollTrigger)

        gsap.to(ballOne, {
            y: -200,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballTwo, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballThree, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballFour, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballFifth, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballSixth, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballSeventh, {
            y: -800,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballEighth, {
            y: -500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballNinth, {
            y: -800,
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

.parallaxCase {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;

    .ballOne {
        left: -90px;
        top: -50px;
        width: 183px;
        height: 183px;

        @include mobile {
            width: 110px;
            height: 110px;
            left: -30px;
        }

        @include mobile-max {
            width: 58px;
            height: 58px;
            left: -20px;
            top: 0;
        }
    }

    .ballTwo {
        right: 380px;
        top: -40px;
        width: 67px;
        height: 67px;
        opacity: .5;

        @include small-desktop {
            right: 180px;
        }

        @include tablet {
            right: 180px;
        }

        @include mobile {
            right: -30px;
            top: -30px;
        }

        @include mobile-max {
            right: -20px;
            top: 110px;
        }
    }

    .ballThree {
        width: 38px;
        height: 38px;
        right: -20px;
        top: 160px;
        opacity: .5;

        @include mobile {
            top: 320px;
        }

        @include mobile-max {
            top: 520px;
        }
    }

    .ballFour {
        top: 320px;
        left: -70px;
        width: 18px;
        height: 18px;

        @include mobile {
            left: -40px;
        }

        @include mobile-max {
            left: -10px;
        }
    }

    .ballFifth {
        top: 600px;
        left: -20px;
        width: 38px;
        height: 38px;
        opacity: .5;

        @include mobile-max {
            top: 800px;
        }
    }

    .ballSixth {
        top: 800px;
        right: -10px;
        width: 26px;
        height: 26px;

        @include mobile {
            top: 650px;
        }

        @include mobile-max {
            top: 1150px;
        }
    }

    .ballSeventh {
        bottom: 50px;
        left: -100px;
        width: 128px;
        height: 128px;

        @include mobile {
            bottom: -350px;
            left: -40px;
            width: 79px;
            height: 79px;
        }

        @include mobile-max {
            bottom: -350px;
            left: -40px;
            width: 79px;
            height: 79px;
        }
    }

    .ballEighth {
        bottom: 0;
        right: 680px;
        width: 36px;
        height: 36px;
    }

    .ballNinth {
        bottom: -500px;
        right: -30px;
        width: 64px;
        height: 64px;

        @include mobile-max {
            bottom: -600px;
            right: -15px;
            width: 36px;
            height: 36px;
            opacity: .5;
        }
    }

    > * {
        position: absolute;
    }
}
</style>