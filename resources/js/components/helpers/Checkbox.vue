<template>
    <div class="checkbox">
        <div class="answers">
            <label class="item">
                <span>{{ options }}</span>
                <input v-model="checked" type="checkbox" :value="options" @change="onChange">
                <span class="checkmark"/>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "Checkbox",
    props: {
        options: {
            type: String,
            required: false,
        }
    },
    data() {
        return {
            checked: []
        };
    },
    methods: {
        onChange() {
            this.$emit('input', this.checked);
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/media";
@import "../../../scss/helpers/varibles";
@import "../../../scss/helpers/_fonts.css";

.checkbox {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 1.25em;

    .answers {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    label {
        margin-left: 1em;
        font: bold 14px/18px 'ArtegraSoft-Medium', sans-serif;
        color: $gray-input;

        @include mobile {
            text-align: initial;
        }

        @include mobile-max {
            text-align: initial;
        }
    }

    .item {
        display: flex;
        position: relative;
        padding-left: 30px;
        margin: 0 auto;
        cursor: pointer;
        height: 22px;
        user-select: none;
        align-items: center;

        input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        background: #EEEEEE;
        border: 1px solid #797979;
        box-sizing: border-box;
        backdrop-filter: blur(30px);
        border-radius: 5px;
    }
}

.checkbox .item:hover input ~ .checkmark {
    background-color: #949494;
}

.checkbox .item input:checked ~ .checkmark {
    background-color: $red;
}

.checkbox .checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox .item input:checked ~ .checkmark:after {
    display: block;
}

.checkbox .item .checkmark:after {
    left: 7px;
    top: 2px;
    width: 4px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
