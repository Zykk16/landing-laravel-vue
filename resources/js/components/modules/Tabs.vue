<template lang="html">
    <div class="tabs">
        <ul class='tabs-header'>
            <li v-for='(tab, index) in tabs'
                :key='tab.title'
                @click='selectTab(index)'
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
        selectTab(i) {
            this.selectedIndex = i

            this.$emit('indexTab', this.selectedIndex)

            this.tabs.forEach((tab, index) => {
                tab.isActive = (index === i)
            })
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/media";

.tabs-header {
    text-align: center;
}

.tabs-header > li {
    padding: 15px 30px;
    border-radius: 10px;
    display: inline-block;
    margin: 0 5px 0 0;
    cursor: pointer;
    font: 14px/18px 'ArtegraSoft-Bold', sans-serif;
    color: #fff;
}

.tab {
    display: inline-block;
    width: 100%;
    min-height: 400px;

    @include mobile {
        min-height: 300px;
    }

    @include mobile-max {
        min-height: 300px;
    }
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