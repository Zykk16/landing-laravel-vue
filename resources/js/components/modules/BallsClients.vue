<template>
    <div ref="parallax" class="parallaxClients">
        <img :ref="item.className" v-for="(item, key) in balls" :src="imagePath(item.img)" :class="item.className"
             :key="key" :alt="item.img">
    </div>
</template>

<script>
import {gsap} from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger.js";

export default {
    name: "BallsClients",
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
            y: -200,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })

        gsap.to(ballTwo, {
            y: -300,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })

        gsap.to(ballThree, {
            y: -300,
            duration: 700,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true
            },
        })

        gsap.to(ballFour, {
            y: -300,
            duration: 900,
            ease: "none",
            scrollTrigger: {
                trigger: parallax,
                scrub: true,
            },
        })

        gsap.to(ballFifth, {
            y: -300,
            duration: 800,
            ease: "none",
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

.parallaxClients {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;

    //@include small-desktop {
    //    height: 550px;
    //}
    //
    //@include tablet {
    //    width: 93%;
    //    height: 610px;
    //}
    //
    //@include mobile {
    //    width: 86.3%;
    //    height: 340px;
    //}
    //@include mobile-max {
    //    width: 86.3%;
    //    height: 340px;
    //}

    .ballOne {
        width: 65px;
        height: 65px;
        top: 260px;
        right: -20px;

        @include small-desktop {
            top: 240px;
        }

        @include tablet {
            top: 240px;
        }
        //
        @include mobile {
            top: 220px;
        }
        @include mobile-max {
            top: 150px;
            left: -40px;
            right: auto;
        }
    }

    .ballTwo {
        width: 69px;
        height: 69px;
        top: 53%;
        left: -2%;

        @include small-desktop {
            top: 41%;
        }

        @include tablet {
            top: 41%;
        }

        @include mobile {
            top: 41%;
        }

        @include mobile-max {
            width: 24px;
            height: 24px;
            top: 540px;
            left: auto;
            right: -10px;
        }
    }

    .ballThree {
        width: 36px;
        height: 36px;
        top: 80%;
        left: 30%;

        @include small-desktop {
            top: 63%;
            left: 36%;
        }

        @include tablet {
            top: 63%;
            left: 36%;
        }

        @include mobile-max {
            width: 18px;
            height: 18px;
            top: 52%;
            left: -1%;
        }
    }

    .ballFour {
        width: 67px;
        height: 67px;
        top: 99%;
        right: -2%;
        opacity: .5;

        //@include small-desktop {
        //    top: 60px;
        //    right: 4%;
        //}
        //
        //@include tablet {
        //    top: 60px;
        //    right: 0;
        //}
        //
        //@include mobile {
        //    top: 90px;
        //    right: 50%;
        //}
        //
        @include mobile-max {
            top: auto;
            bottom: -6%;
            right: -5%;
        }
    }

    .ballFifth {
        width: 57px;
        height: 57px;
        bottom: -18%;
        left: 14%;
        opacity: .5;

        //@include small-desktop {
        //    bottom: 220px;
        //    right: 600px;
        //}
        //
        //@include tablet {
        //    bottom: 240px;
        //    left: 290px;
        //}
        //
        @include mobile {
            bottom: -13%;
            left: 28%;
        }

        @include mobile-max {
            bottom: -11%;
            left: -12%;
        }
    }

    > * {
        position: absolute;
    }
}
</style>