<template>
    <div class="sidebar">
        <div id="burger" :class="{ 'active' : isBurgerActive }" @click.prevent="toggle">
            <button type="button" class="burger-button" title="Menu">
                <span class="burger-bar burger-bar--1"></span>
                <span class="burger-bar burger-bar--2"></span>
                <span class="burger-bar burger-bar--3"></span>
            </button>
        </div>
        <transition name="slide">
            <div v-if="isBurgerActive" class="sidebar-panel blur">
                <ul class="sidebar-panel-nav">
                    <li @click="isNavOpen = false" v-for="(item, key) in menu" :key="key">
                        <a href="#" v-scroll-to="item.url">{{ item.name }}</a>
                    </li>
                </ul>
                <Button url="#" scroll-to="#contactForm" width="120px" text="Связаться со мной"/>
            </div>
        </transition>
    </div>
</template>

<script>
import Button from "../helpers/Button";

export default {
    name: "MobileMenu",
    components: {Button},
    props: ['menu'],
    data() {
        return {
            isNavOpen: false,
            isPanelOpen: false
        }
    },

    computed: {
        isBurgerActive() {
            return this.isNavOpen
        }
    },

    methods: {
        toggle() {
            this.isNavOpen = !this.isNavOpen;
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/varibles";
@import "../../../scss/helpers/mixins";

.sidebar-panel {
    position: absolute;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    top: 6.86em;
    right: 0;
    background: rgba(255, 255, 255, 0.32);
    overflow: hidden;
    text-align: center;
    border-top: 1px solid $whiteGray;
    box-sizing: border-box;
    z-index: 999;

    &-nav {
        list-style-type: none;
        margin-bottom: 2.5em;

        li {
            padding-bottom: 1.27em;

            a {
                font: 600 14px/1 'ArtegraSoft-Bold', sans-serif;
                color: $black;
                padding-bottom: 0.5em;
                transition: color .2s ease-in-out;

                &:hover {
                    color: $red;
                }
            }
        }
    }

    @include huge-mobile {
        top: 5.16em;
    }

    @include mobile-max {
        top: 5.16em;
    }
}

/* burger */

.hidden {
    visibility: hidden;
}

.burger-button {
    position: relative;
    height: 30px;
    width: 40px;
    display: block;
    z-index: 999;
    border: 0;
    border-radius: 0;
    background-color: transparent;
    pointer-events: all;
    transition: transform .6s cubic-bezier(.165, .84, .44, 1);
    cursor: pointer;

    &:focus {
        outline: 0;
    }

    .burger-bar {
        background-color: $red;
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        height: 3px;
        border-radius: 5px;
        width: auto;
        transition: transform .6s cubic-bezier(.165, .84, .44, 1),
        opacity .3s cubic-bezier(.165, .84, .44, 1),
        background-color .6s cubic-bezier(.165, .84, .44, 1);

        @include huge-mobile {
            width: 30px;
        }

        @include mobile-max {
            width: 30px;
        }
    }
}

//@include huge-mobile {
//    max-width: 85px;
//}
.burger-bar--1 {
    top: 15px !important;
    left: 8px;
    transform: translateY(-6px);
}

.burger-bar--2 {
    transform: scaleX(1);
}

.burger-bar--3 {
    top: 15px !important;
    left: 8px;
    transform: translateY(6px);
}

.active {
    .burger-bar--1,
    .burger-bar--3 {
        top: auto;
    }
}

.burger-button:hover .burger-bar--2 {
    transform: scaleX(1);
}

.no-touchevents .burger-bar--2:hover {
    transform: scaleX(1);
}

#burger.active .burger-button {
    transform: rotate(-180deg);
}

#burger.active .burger-bar {
    background-color: $red;
}

#burger.active .burger-bar--1 {
    top: 15px !important;
    left: 8px;
    transform: rotate(45deg)
}

#burger.active .burger-bar--2 {
    opacity: 0;
}

#burger.active .burger-bar--3 {
    top: 15px !important;
    left: 8px;
    transform: rotate(-45deg)
}

/** sidebar **/

.slide-enter-active,
.slide-leave-active {
    transition: transform .3s ease-in-out;
}

.slide-enter,
.slide-leave-to {
    transform: translateX(100%);
    transition: all .3s ease-in 0s
}
</style>
