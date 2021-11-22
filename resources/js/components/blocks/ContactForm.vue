<template>
    <div :class="['contact my', success ? 'disable-icon' : '']">
        <form v-if="!success" class="contact-form blur" @submit.prevent="submit">
            <div class="contact-form-info">
                <h2>Если Вы заинтересовались нашими услугами или у Вас остались вопросы, свяжитесь, пожалуйста, с
                    нами.</h2>
            </div>
            <div class="contact-form-group">
                <input type="text" :class="['field', errors && errors.name ? 'field-error' : '']"
                       name="name" id="name" v-model="fields.name"
                       placeholder="Имя" @input="errors.name = ''"/>
            </div>

            <div class="contact-form-group">
                <masked-input :mask="'\\+\\' + country + ' (111) 111-11-11'" placeholder="Номер телефона"
                              @input="errors.phone = ''"
                              v-model="fields.phone" name="phone" id="phone"
                              :class="['field', errors && errors.phone ? 'field-error' : '']"/>
            </div>

            <div class="contact-form-group">
                <input type="email" :class="['field', errors && errors.email ? 'field-error' : '']"
                       name="email" id="email" v-model="fields.email"
                       placeholder="Почта" @input="errors.email = ''"/>
            </div>

            <div class="contact-form-group select-dropdown">
                <select v-model="fields.category" class="minimal"
                        :class="['field', errors && errors.category ? 'field-error' : '']">
                    <option value="" disabled>Являюсь представителем:</option>
                    <option v-for="(category, key) in categories"
                            :key="key" :value="category.id">
                        {{ category.name }}
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
        <div v-else class="send-message blur">
            <a class="cross-back" @click="success = false">
                <img src="../../../img/svg/cross.svg" alt="">
            </a>
            <h1 class="gradient-h1">Заявка успешно отправлена, менеджер свяжется с Вами в ближайшее время!</h1>
        </div>
        <BallsContactForm :balls="balls"/>
    </div>
</template>

<script>
import Button from '../helpers/Button'
import MaskedInput from 'vue-masked-input'
import {mapActions, mapGetters} from 'vuex'
import BallsContactForm from '../modules/BallsContactForm'

export default {
    name: "ContactForm",
    components: {BallsContactForm, Button, MaskedInput},
    data() {
        return {
            fields: {
                category: ''
            },
            errors: {},
            success: false,
            screen: false,
            balls: [
                {className: 'ballOne', img: 'ball-2'},
                {className: 'ballTwo', img: 'ball-1'},
                {className: 'ballThree', img: 'ball-2'}
            ],
            country: ''
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
            axios.post('/api/contact', this.fields).then(() => {
                this.fields = {}
                this.success = true
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {}
                }
            }).finally(() => {
                this.fields.category = ''
            })
        },

        onResize() {
            this.screen = window.innerWidth >= 1440;
        },

        async inputMaskCountry() {
            await axios.get('/api/sypexgeo')
                .then(request => {
                    this.country = request.data.country.phone
                })
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
        this.inputMaskCountry()
    }
}
</script>

<style scoped>

</style>