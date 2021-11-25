<template>
    <div>
        <form v-if="!success" class="remind-password">
            <h1>Напомнить пароль</h1>
            <p>Пожалуйста, введите адрес e-mail, указанный при регистрации Вашей учетной записи, после чего Вам будет
                отправлено письмо с инструкциями по ее восстановлению.</p>
            <input type="email" v-model="email" class="form-control" placeholder="Email" id="email" name="email">
            <span v-if="error" class="error">{{ error }}</span>
            <Button text="Оправить" width="64px" @click.native="checkForm"/>
        </form>
        <div v-else class="send-message blur">
            <a class="cross-back" @click="$router.push('/')">
                <img src="../../../img/svg/cross.svg" alt="">
            </a>
            <h1 class="gradient-h1">На вашу почту отправлено письмо с ссылкой для восстановления пароля</h1>
        </div>
    </div>
</template>

<script>
import Button from "../helpers/Button";

export default {
    name: "RemindPassword",
    components: {Button},
    data() {
        return {
            error: '',
            email: null,
            success: false
        }
    },

    methods: {
        send() {
            // this.$emit('sendRemind', true)
        },

        checkForm(e) {
            this.error = [];

            if (!this.email) {
                this.error = 'Данные введены некорректно'
            } else if (!this.validEmail(this.email)) {
                this.error = 'Данные введены некорректно'
            } else {
                this.error = ''
                this.success = true
            }

            if (!this.error.length) {
                return true;
            }

            e.preventDefault();
        },

        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../scss/helpers/mixins";

.button {
    position: relative;
    display: flex;
    justify-content: center;
    align-self: center;
    height: 44px;
    width: 124px;
    margin: 2.5em auto 0;
    padding: 1.125em 1.875em;
    font: normal 10px/1 "ArtegraSoft-Medium", sans-serif;
    background-color: #CE302D;
    text-transform: uppercase;
    border-radius: 112px;
    border: 1px solid #CE302D;
    opacity: 0.95;
    color: #fff;
    text-align: center;
    letter-spacing: 0.2px;
    cursor: pointer;
    z-index: 1;
    transition: 0.2s ease-in-out;

    &:hover {
        background-color: #F9F9F9;
        border: 1px solid #797979;
        color: #3A3535;
    }
}

.send-message {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 10em;
    box-sizing: border-box;
    border-radius: 40px;

    @include tablet {
        padding: 7em 5em;
    }

    @include mobile {
        padding: 7em 5em;
    }

    @include huge-mobile {
        padding: 5em 2.5em;

    }

    @include mobile-max {
        padding: 5em 2.5em;
    }

    h1 {
        width: 90%;
        text-align: center;
    }

    p {
        font: 500 22px/30px "ArtegraSoft-Medium", sans-serif;
        margin-bottom: 1.25em;
    }

    .cross-back {
        position: absolute;
        top: 30px;
        right: 30px;
    }
}
</style>
