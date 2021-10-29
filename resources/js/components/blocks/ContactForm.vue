<template>
    <div class="contact my blur">
        <div v-if="!success">
            <h2>У Вас остались вопросы?</h2>
            <p>Если Вы заинтересовались нашими услугами или у Вас остались вопросы, свяжитесь, пожалуйста, с нами. <br v-if="screen">
                Отвечаем оперативно.</p>
        </div>
        <form v-if="!success" class="contact-form" @submit.prevent="submit">
            <div class="contact-form-group">
                <input type="text" :class="['field', errors && errors.name ? 'field-error' : '']"
                       name="name" id="name" v-model="fields.name"
                       placeholder="Имя" @input="errors.name = ''"/>
            </div>

            <div class="contact-form-group">
                <input type="text" :class="['field', errors && errors.phone ? 'field-error' : '']"
                       name="phone" id="phone" v-model="fields.phone"
                       placeholder="Номер телефона" @input="errors.phone = ''"/>
            </div>

            <div class="contact-form-group">
                <input type="email" :class="['field', errors && errors.email ? 'field-error' : '']"
                       name="email" id="email" v-model="fields.email"
                       placeholder="Почта" @input="errors.email = ''"/>
            </div>

            <div class="contact-form-group">
                <select v-model="fields.category">
                    <option disabled value="">Являюсь представителем:</option>
                    <option>Представитель</option>
                    <option>Предприниматель</option>
                    <option>Программист</option>
                </select>
            </div>

            <div class="contact-form-group group-textarea">
                <textarea :class="['field', errors && errors.message ? 'field-error' : '']" v-model="fields.message"
                          placeholder="Комментарий" @input="errors.message = ''"></textarea>
            </div>

            <p class="personal-data">Отправляя данные, Вы даете согласие на обработку своих персональных данных</p>

            <button type="submit" class="button">Отправить заявку</button>
        </form>
        <div v-else class="sent-message">
            <p>Спасибо, заявка отправлена</p>
            <Button width="150px" text="Отправить еще раз" @click.native="success = false"/>
        </div>
    </div>
</template>

<script>
import Button from "../helpers/Button";

export default {
    name: "ContactForm",
    components: {Button},
    data() {
        return {
            fields: {},
            errors: {},
            success: false,
            loaded: true,
            screen: false
        }
    },
    methods: {
        submit() {
            if (this.loaded) {
                this.loaded = false
                this.success = false
                this.errors = {}
                axios.post('/api/contact', this.fields).then(response => {
                    this.fields = {}
                    this.loaded = true
                    this.success = true
                }).catch(error => {
                    this.loaded = true
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {}
                    }
                })
            }
        },
        onResize() {
            this.screen = window.innerWidth >= 1440;
        }
    },

    created() {
        window.addEventListener('resize', this.onResize)
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.onResize)
    },

    mounted() {
        this.onResize()
    }
}
</script>

<style scoped>

</style>