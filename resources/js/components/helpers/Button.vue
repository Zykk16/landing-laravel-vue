<template>
    <div :class="['button-container', mobile ? 'mobile' : '']">
        <a :href="url" :class="['button', mobile ? 'mobile' : '']"
           v-html="text" :style="{width: width}" v-scroll-to="scrollTo"/>
    </div>
</template>

<script>
export default {
    name: "Button",
    props: {
        url: String,
        text: String,
        mobile: Boolean,
        width: String,
        scrollTo: String
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/varibles";
@import "../../../scss/helpers/mixins";

.button-container {
    .button {
        position: relative;
        display: block;
        height: 12px;
        width: 115px;
        padding: 1.8em 3em 1.4em 3em;
        font: normal 10px/1 'ArtegraSoft-Medium', sans-serif;
        background-color: $red;
        text-transform: uppercase;
        border-radius: 112px;
        border: 1px solid $red;
        opacity: 0.95;
        color: #fff;
        text-align: center;
        letter-spacing: .2px;
        cursor: pointer;
        z-index: 1;
        transition: .2s ease-in-out;

        &.mobile {
            font-family: "ArtegraSoft-Bold", sans-serif;
            font-weight: 600;
            background-color: transparent;
            text-decoration-line: underline;
            color: $red;
            border: none;

            &:hover {
                background-color: transparent;
                border: none;
            }
        }

        &:hover {
            background-color: $white;
            border: 1px solid $gray-input;
            color: $black;
        }
    }

    &.mobile {
        margin-left: calc(0% - 0.5em);
    }
}
</style>
