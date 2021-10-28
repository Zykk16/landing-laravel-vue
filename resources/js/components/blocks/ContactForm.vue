<template>
    <div>
        <form v-if="!success" class="contact-form" @submit.prevent="submit">
            <div class="contact-form-group">
                <input type="text" class="field" name="name" id="name" v-model="fields.name"
                       placeholder="Имя"/>
                <div v-if="errors && errors.name" class="error-message">{{ errors.name[0] }}</div>
            </div>

            <div class="contact-form-group">
                <input type="text" class="field" name="phone" id="phone" v-model="fields.phone"
                       placeholder="Телефон"/>
                <div v-if="errors && errors.phone" class="error-message">{{ errors.phone[0] }}</div>
            </div>

            <div class="contact-form-group">
                <input type="email" class="field" name="email" id="email" v-model="fields.email"
                       placeholder="Почта"/>
                <div v-if="errors && errors.email" class="error-message">{{ errors.email[0] }}</div>
            </div>

            <select v-model="fields.category">
                <option disabled value="">Являюсь представителем: </option>
                <option>Представитель</option>
                <option>Предприниматель</option>
                <option>Программист</option>
            </select>

            <div class="contact-form-group">
                <textarea class="field" v-model="fields.message" placeholder="Комментарий"></textarea>
                <div v-if="errors && errors.message" class="error-message">{{ errors.message[0] }}</div>
            </div>

            <button type="submit" class="button">Отправить заявку</button>
        </form>
        <div v-else class="sent-message">
            <div>Спасибо, сообщение отправлено</div>
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
    },
}
</script>

<style scoped>

</style>