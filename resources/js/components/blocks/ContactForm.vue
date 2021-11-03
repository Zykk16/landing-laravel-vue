<template>
    <div class="contact my blur">
        <div v-if="!success">
            <h2>У Вас остались вопросы?</h2>
            <p>Если Вы заинтересовались нашими услугами или у Вас остались вопросы, свяжитесь, пожалуйста, с нами. <br
                v-if="screen">
                Отвечаем оперативно.</p>
        </div>
        <form v-if="!success" class="contact-form" @submit.prevent="submit">
            <div class="contact-form-group">
                <input type="text" :class="['field', errors && errors.name ? 'field-error' : '']"
                       name="name" id="name" v-model="fields.name"
                       placeholder="Имя" @input="errors.name = ''"/>
            </div>

            <div class="contact-form-group">
                <masked-input mask="\+\7 (111) 111-11-11" placeholder="Номер телефона" @input="errors.phone = ''"
                              v-model="fields.phone" name="phone" id="phone"
                              :class="['field', errors && errors.phone ? 'field-error' : '']"/>
            </div>

            <div class="contact-form-group">
                <input type="email" :class="['field', errors && errors.email ? 'field-error' : '']"
                       name="email" id="email" v-model="fields.email"
                       placeholder="Почта" @input="errors.email = ''"/>
            </div>

            <div class="contact-form-group select-dropdown">
                <select v-model="fields.category">
                    <option disabled value="">Являюсь представителем:</option>
                    <option v-for="(category, key) in categories"
                            :key="key" :value="category.id">
                        {{category.name}}
                    </option>
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
            <h1 class="gradient-h1">Заявка успешно отправлена, менеджер свяжется с Вами в ближайшее время!</h1>
        </div>
    </div>
</template>

<script>
import Button from "../helpers/Button"
import MaskedInput from 'vue-masked-input'
import {mapActions, mapGetters} from "vuex";

export default {
    name: "ContactForm",
    components: {Button, MaskedInput},
    data() {
        return {
            fields: {},
            errors: {},
            success: false,
            screen: false
        }
    },

    computed: {
        ...mapGetters({
            categories: 'applications/categories'
        })
    },

    methods: {
        ...mapActions({
            getCategories: 'applications/getCategories'
        }),

        submit() {
            this.success = false
            this.errors = {}
            axios.post('/api/contact', this.fields).then(response => {
                this.fields = {}
                this.success = true
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {}
                }
            })
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
        this.getCategories()
        this.onResize()
    }
}
</script>

<style scoped>

</style>