<template>
    <div :class="['contact my', success ? 'disable-icon' : '']">
        <form v-if="!success" class="contact-form blur" @submit.prevent="submit">
            <div class="contact-form-info">
                <h2>Если Вы заинтересовались нашими услугами или у Вас остались вопросы, свяжитесь, пожалуйста, с
                    нами.</h2>
            </div>
            <div class="contact-form-group required">
                <input type="text" :class="['field', errors && errors.name ? 'field-error' : '']"
                       name="name" id="name" v-model="fields.name"
                       placeholder="Имя" @input="errors.name = ''"/>
                <span v-if="errors.name" class="error">{{ errors.name }}</span>
            </div>

            <div class="contact-form-group required">
                <masked-input :mask="'\\+\\' + country + ' (111) 111-11-11'" placeholder="Номер телефона"
                              @input="errors.phone = ''"
                              v-model="fields.phone" name="phone" id="phone"
                              :class="['field', errors && errors.phone ? 'field-error' : '']"/>
                <span v-if="errors.phone" class="error">{{ errors.phone }}</span>
            </div>

            <div class="contact-form-group required">
                <input type="text" :class="['field', errors.email ? 'field-error' : '']"
                       name="email" id="email" v-model="fields.email"
                       placeholder="Почта" @input="errors.email = ''"/>
                <span v-if="errors.email" class="error">{{ errors.email }}</span>
            </div>

            <div class="contact-form-group required select-dropdown">
                <select v-model="fields.category" class="minimal"
                        :class="['field', errors.category && !fields.category ? 'field-error' : '']">
                    <option value="" disabled>Являюсь представителем:</option>
                    <option v-for="(category, key) in categories"
                            :key="key" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
                <span v-if="errors.category && !fields.category" class="error">{{ errors.category }}</span>
            </div>

            <div class="contact-form-group group-textarea">
                <textarea :class="['field', errors && errors.message ? 'field-error' : '']" v-model="fields.message"
                          placeholder="Комментарий" @input="errors.message = ''"></textarea>
            </div>
            <p class="personal-data">Отправляя данные, Вы даете согласие на обработку своих персональных данных</p>

            <button type="submit" class="button">Отправить заявку</button>
        </form>
        <div v-else class="send-message blur">
            <a class="cross-back" @click="close">
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
            errors: {
                name: '',
                email: '',
                category: ''
            },
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

        close() {
            this.success = false
            this.fields.category = ''
        },

        submit() {
            axios.post('/api/contact', this.fields).then(() => {
                this.success = true
                this.fields.name = ''
                this.fields.email = ''
                this.fields.phone = ''
                this.fields.category = ''
                this.fields.message = ''
            }).catch(({response: {data}}) => {
                this.errors.name = data.errors.name ? data.errors.name[0] : ''
                this.errors.email = data.errors.email ? data.errors.email[0] : ''
                this.errors.phone = data.errors.phone ? data.errors.phone[0] : ''
                this.errors.category = data.errors.category ? data.errors.category[0] : ''
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