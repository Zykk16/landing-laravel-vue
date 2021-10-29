<template lang="html">
    <div class='tab' v-show='isActive'>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "Tab",
    props: {
        title: {
            type: String,
            default: 'Tab'
        }
    },
    data() {
        return {
            isActive: true
        }
    }
}
</script>

<style scoped>

</style>