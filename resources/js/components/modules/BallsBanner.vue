<template>
    <div ref="parallax" class="parallaxBanner">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap} from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger.js";

export default {
    name: "BallsBanner",
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
            duration: 700,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        });

        gsap.to(ballFour, {
            y: -300,
            duration: 900,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballFifth, {
            y: -300,
            duration: 800,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballSixth, {
            y: -300,
            duration: 800,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballSeventh, {
            y: -500,
            duration: 500,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        });

        gsap.to(ballEighth, {
            y: -100,
            duration: 500,
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

.parallaxBanner {
    position: absolute;
    width: 87%;
    height: 830px;

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
        left: 160px;
        top: 190px;
        width: 23px;
        height: 23px;

        @include small-desktop {
            top: 140px;
            left: -100px;
        }

        @include tablet {
            left: 10px;
            top: 130px;
        }

        @include mobile {
            left: -50px;
            top: 95px;
        }
        @include mobile-max {
            left: -30px;
            top: 95px;
        }
    }

    .ballTwo {
        left: 700px;
        top: 90px;
        width: 87px;
        height: 87px;

        @include small-desktop {
            display: none;
        }

        @include tablet {
            display: none;
        }

        @include mobile {
            width: 38px;
            height: 38px;
            right: -20px;
            left: auto;
            top: auto;
            bottom: 10px;
        }

        @include mobile-max {
            width: 38px;
            height: 38px;
            right: -20px;
            left: auto;
            top: auto;
            bottom: -20px;
        }
    }

    .ballThree {
        top: 100px;
        right: 170px;
        width: 57px;
        height: 57px;

        @include small-desktop {
            display: none;
        }

        @include tablet {
            display: none;
        }

        @include mobile {
            display: none;
        }

        @include mobile-max {
            display: none;
        }

    }

    .ballFour {
        top: 120px;
        right: -6%;
        width: 25px;
        height: 25px;
        opacity: .5;

        @include small-desktop {
            top: 60px;
            right: 4%;
        }

        @include tablet {
            top: 60px;
            right: 0;
        }

        @include mobile {
            top: 90px;
            right: 50%;
        }

        @include mobile-max {
            top: 90px;
            right: 50%;
        }
    }

    .ballFifth {
        bottom: 320px;
        right: 900px;
        width: 16px;
        height: 16px;

        @include small-desktop {
            bottom: 220px;
            right: 600px;
        }

        @include tablet {
            bottom: 240px;
            left: 290px;
        }

        @include mobile {
            bottom: 100px;
            left: -45px;
        }

        @include mobile-max {
            bottom: 100px;
            left: -30px;
        }
    }

    .ballSixth {
        bottom: 50px;
        left: 340px;
        width: 38px;
        height: 38px;
        opacity: .5;

        @include small-desktop {
            bottom: 70px;
            left: 460px;
        }

        @include tablet {
            bottom: 20px;
            left: 220px;
        }

        @include mobile {
            display: none;
        }

        @include mobile-max {
            display: none;
        }
    }

    .ballSeventh {
        bottom: 50px;
        right: 450px;
        width: 67px;
        height: 67px;
        opacity: .5;

        @include small-desktop {
            display: none;
        }

        @include tablet {
            display: none;
        }

        @include mobile {
            display: none;
        }

        @include mobile-max {
            display: none;
        }
    }

    .ballEighth {
        bottom: 100px;
        right: 100px;
        width: 28px;
        height: 28px;

        @include small-desktop {
            bottom: 300px;
            right: -40px;
        }

        @include tablet {
            bottom: 260px;
            right: 40px;
        }

        @include mobile {
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