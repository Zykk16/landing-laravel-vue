<template>
    <v-dialog id="edit-case" content-class="edit-case" v-model="openEditCase" persistent max-width="1000px"
              @submit.prevent>
        <v-card>
            <v-card-title>
                <span class="text-h5">Изменить кейс</span>
            </v-card-title>
            <v-card-text>
                <v-form @submit.prevent>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <cases-image-uploader :cover="data.image" @loaded="uploadImage"/>
                                <span class="size" v-if="size">{{'Размер файла: ' + size + ' Kb'}}</span>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.title" label="Клиент"></v-text-field>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-select
                                            v-if="statuses"
                                            :items="statuses"
                                            item-text="name"
                                            item-value="id"
                                            value="id"
                                            label="Статус"
                                            :error="errors.has('status_id')"
                                            :error-messages="errors.get('status_id')"
                                            @change="errors.clear('status_id')"
                                            v-model="form.status_id">
                                        </v-select>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-select :items="categories"
                                          item-text="name"
                                          item-value="id"
                                          label="Категория"
                                          v-model="form.category_id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" m="6" md="4">
                                <v-text-field v-model="form.goal" label="Цель"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.geography" label="География"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.placement_format" label="Формат размещения"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.period" label="Период кампании"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-card-title class="pl-0">Аудитория</v-card-title>
                        <v-row>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.gender" label="Пол"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.age" label="Возраст"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.income" label="Доход"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.interest" label="Интерес"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-card-title class="pl-0">Показатели</v-card-title>
                        <v-row>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.shows" label="Показы"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.clicks" label="Клики"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.ctr" label="CTR"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.vtr" label="VTR"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.cpv" label="CPV"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.coverage" label="Охват"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.refusals" label="Отказы"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.depth" label="Глубина"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.duration_session" label="Средняя длительность сеанса"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="form.objectives" label="Цели"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDialog">Закрыть</v-btn>
                <v-btn color="blue darken-1" text @click="update">Сохранить</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import CasesImageUploader from "../../../../components/helpers/CasesImageUploader"
import Errors from "../../../../utils/Errors"
import {mapActions, mapGetters} from "vuex"

export default {
    name: "CaseEdit",
    components: {CasesImageUploader},
    props: ['openEditCase', 'data'],
    data() {
        return {
            errors: new Errors(),
            form: {
                image: '',
                category_id: '',
                title: '',
            },
            size: null
        }
    },

    computed: {
        ...mapGetters({
            categories: 'categories_cases/categories',
            statuses: 'cases/statuses'
        })
    },

    methods: {
        ...mapActions({
            updateCases: 'cases/updateCases',
            getCategories: 'categories_cases/getCategories',
            getStatuses: 'cases/getStatuses'
        }),

        setForm() {
            this.form = {
                category_id: this.data.category_id.id,
                status_id: this.data.status_id,
                image: this.data.image ?? null,
                title: this.data.title,
                goal: this.data.goal ?? '',
                geography: this.data.geography ?? '',
                placement_format: this.data.placement_format ?? '',
                period: this.data.period ?? '',
                gender: this.data.gender ?? '',
                age: this.data.age ?? '',
                income: this.data.income ?? '',
                interest: this.data.interest ?? '',
                shows: this.data.shows ?? '',
                clicks: this.data.clicks ?? '',
                ctr: this.data.ctr ?? '',
                vtr: this.data.vtr ?? '',
                cpv: this.data.cpv ?? '',
                coverage: this.data.coverage ?? '',
                refusals: this.data.refusals ?? '',
                depth: this.data.depth ?? '',
                duration_session: this.data.duration_session ?? '',
                objectives: this.data.objectives ?? ''
            }
        },

        uploadImage(image) {
            this.form.image = image
            this.size = Math.round(image.size / 1024)
        },

        update() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            }

            let formData = new FormData()
            formData.append('category_id', this.form.category_id)
            formData.append('status_id', this.form.status_id)
            formData.append('image', this.form.image)
            formData.append('title', this.form.title)
            formData.append('goal', this.form.goal)
            formData.append('geography', this.form.geography)
            formData.append('placement_format', this.form.placement_format)
            formData.append('period', this.form.period)
            formData.append('gender', this.form.gender)
            formData.append('age', this.form.age)
            formData.append('income', this.form.income)
            formData.append('interest', this.form.interest)
            formData.append('shows', this.form.shows)
            formData.append('clicks', this.form.clicks)
            formData.append('ctr', this.form.ctr)
            formData.append('vtr', this.form.vtr)
            formData.append('cpv', this.form.cpv)
            formData.append('coverage', this.form.coverage)
            formData.append('refusals', this.form.refusals)
            formData.append('depth', this.form.depth)
            formData.append('duration_session', this.form.duration_session)
            formData.append('objectives', this.form.objectives)
            formData.append('_method', 'PUT')

            this.store(formData, config)
        },
        store(data, config) {
            axios.post(`/api/cases/${this.data.id}`, data, config)
                .then(() => {
                    this.updateCases(data)
                    this.$emit('send')
                })
                .catch(error => {
                    let formErrors = error.response.data.errors

                    if (formErrors) {
                        this.errors.record(formErrors)
                    }
                })
        },

        closeDialog() {
            this.$emit('close')
        }
    },

    mounted() {
        this.setForm()
    },

    created() {
        this.getCategories()
        this.getStatuses()
    }
}
</script>

<style scoped>

</style>