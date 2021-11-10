<template>
    <div>
        <div class="cross" @click="success">
            <img src="../../../img/svg/cross.svg" alt="">
        </div>
        <div class="success-register">
            <div class="success-message">
                <h1 class="gradient-h1">Регистрация прошла успешно!</h1>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SuccessRegisterMessage",
    methods: {
        success() {
            this.$emit('success', true)
        }
    }
}
</script>

<style scoped>

</style>