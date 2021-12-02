<template lang="html">
    <div class="tabs">
        <div v-if="screen" class="arrow-select">
            <select @change="switchView($event, $event.target.selectedIndex)" class="select blur">
                <option v-for='(tab, index) in tabs' :value="tab.title" :key='index'>
                    {{ tab.title }}
                </option>
            </select>
        </div>
        <ul v-show="!screen" class='tabs-header'>
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
            tabs: []
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
        switchView(event, selectedIndex) {
            this.selectedIndex = selectedIndex
            this.$emit('indexTab', this.selectedIndex)

            this.tabs.forEach((tab, index) => {
                tab.isActive = (index === this.selectedIndex)
            })
        },

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
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/media";
@import "../../../scss/helpers/varibles";

.tabs {
    .arrow-select {
        position: relative;

        .select {
            display: flex;
            width: 100%;
            margin-top: 2.5em;
            margin-bottom: 1em;
            padding: 1.125em;
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid #DCDCDC;
            font: 14px/18px 'ArtegraSoft-Bold', sans-serif;
            color: $red;
            box-sizing: border-box;
            border-radius: 37px;
            outline: none;
            -webkit-appearance: none;
        }

        &:before {
            content: '';
            position: absolute;
            top: 17px;
            right: 4px;
            width: 40px;
            height: 17px;
            background: #fff url("../../../img/arrow-select-red.png") no-repeat center;
            background-size: contain;
            z-index: 9;
        }
    }
}

.tabs-header {
    text-align: center;
}

.tabs-header > li {
    display: inline-block;
    padding: 15px 30px;
    border-radius: 10px;
    margin: 0 5px 0 0;
    cursor: pointer;
    font: 14px/18px 'ArtegraSoft-Bold', sans-serif;
    color: #fff;
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