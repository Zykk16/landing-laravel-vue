<template lang="html">
    <div class="tabs">
        <div v-if="screen" class="select blur" @click="showList = true" v-html="selected"></div>
        <ul v-show="showList || !screen" class='tabs-header'>
            <li v-for='(tab, index) in tabs'
                :key='tab.title'
                @click='selectTab(index)'
                class="blur"
                ref="listValue"
                :class='{"tab__selected": (index === selectedIndex)}'>
                {{ tab.title }}
            </li>
        </ul>
        <slot></slot>
    </div>
</template>
<script>
export default {
    name: "Tabs",
    props: ['screen'],
    data() {
        return {
            selectedIndex: 0,
            selected: 'Выберите категорию',
            tabs: [],
            showList: false
        }
    },
    created() {
        this.tabs = this.$children
    },
    mounted() {
        setTimeout(() => {
            this.selectTab(0)
        }, 500)
    },
    methods: {
        selectTab(i) {
            this.selectedIndex = i

            this.$emit('indexTab', this.selectedIndex)

            this.tabs.forEach((tab, index) => {
                tab.isActive = (index === i)
            })

            setTimeout(() => {
                const self = this

                this.$refs.listValue.forEach(e => {
                    if (e.classList.value === 'blur tab__selected' && this.screen) {
                        self.selected = e.innerText
                    }
                })
            }, 100)

            this.showList = false
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/media";
@import "../../../scss/helpers/varibles";

.tabs {
    .select {
        position: relative;
        display: flex;
        margin-top: 2.5em;
        margin-bottom: 1em;
        padding: 1.125em;
        background: rgba(255, 255, 255, 0.22);
        border: 1px solid #DCDCDC;
        font: 14px/18px 'ArtegraSoft-Bold', sans-serif;
        color: $red;
        box-sizing: border-box;
        border-radius: 37px;

        &:before {
            content: '';
            position: absolute;
            top: 17px;
            right: 20px;
            width: 17px;
            height: 17px;
            background: url("../../../img/arrow-select.png") center no-repeat;
            background-size: contain;
        }
    }
}

.tabs-header {
    text-align: center;

    @include mobile {
        display: flex;
        justify-content: center;
        flex-direction: column;
    }

    @include mobile-max {
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
}

.tabs-header > li {
    display: inline-block;
    padding: 15px 30px;
    border-radius: 10px;
    margin: 0 5px 0 0;
    cursor: pointer;
    font: 14px/18px 'ArtegraSoft-Bold', sans-serif;
    color: #fff;

    @include mobile {
        width: 100%;
        margin-top: 0 !important;
    }

    @include mobile-max {
        width: 100%;
        margin-top: 0 !important;
    }
}

.tab {
    display: inline-block;
    width: 100%;
}

.tabs li {
    margin: 2.5em 1.25em 2.5em 0;
    background: rgba(255, 255, 255, 0.22);
    border: 1px solid #DCDCDC;
    box-sizing: border-box;
    color: #3A3535;
    border-radius: 37px;

    @include tablet {
        margin-bottom: .6em;
    }
    @include mobile {
        margin-bottom: .6em;
    }

    &:last-child {
        margin-right: 0;
    }
}

.tabs li.tab__selected {
    background: linear-gradient(241.44deg, #F45E64 16.71%, #E84542 40.25%, #B80F0C 81.58%, rgba(129, 97, 237, 0) 133.8%);
    opacity: 0.95;
    border-radius: 44px;
    color: #fff;
}

</style>