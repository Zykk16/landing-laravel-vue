<template>
    <div class="remind-password my">
        <h1>Напомнить пароль</h1>
        <p>Пожалуйста, введите адрес e-mail, указанный при регистрации Вашей учетной записи, после чего Вам будет
            отправлено письмо с инструкциями по ее восстановлению.</p>
        <input type="email">
        <Button text="Оправить" width="124" @click.native="send"/>
    </div>
</template>

<script>
import Button from "../../../components/helpers/Button";

export default {
    name: "RemindPassword",
    components: {Button},
    methods: {
        send() {
            this.$emit('sendRemind', true)
        }
    }
}
</script>

<style scoped>

</style>
