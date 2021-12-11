<template>
    <v-dialog id="create-case" content-class="create-case" v-model="dialogCreate" persistent max-width="1000px"
              @submit.prevent>
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                <span class="new-default-admin-button">Новый кейс</span>
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5 new-case-title">Создание кейса</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="formStore" @submit.prevent>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                {{form.image}}
                                <cases-image-uploader :cover="form.image" @loaded="updateImage"
                                                      @preloadImg="errorHandlerImage = true"/>
                                <div v-if="!errorHandlerImage">
                                    <v-alert v-if="errors.has('image')" color="red" dense text type="error">
                                        {{ errors.get('image') }}
                                    </v-alert>
                                </div>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.title"
                                              :error="errors.has('title')"
                                              :error-messages="errors.get('title')"
                                              label="Клиент" @input="errors.clear('title')"></v-text-field>
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
                                <v-select
                                    v-if="categories"
                                    :items="categories"
                                    item-text="name"
                                    item-value="id"
                                    value="id"
                                    label="Категория"
                                    :error="errors.has('category_id')"
                                    :error-messages="errors.get('category_id')"
                                    @change="errors.clear('category_id')"
                                    v-model="form.category_id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="form.goal"
                                    label="Цель"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="form.geography"
                                    label="География"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="form.placement_format"
                                    label="Формат размещения"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="form.period"
                                    label="Период кампании"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-card-title class="pl-0">Аудитория</v-card-title>
                        <v-row>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.gender"
                                    label="Пол"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.age"
                                    label="Возраст"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.income"
                                    label="Доход"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="form.interest"
                                    label="Интерес"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-card-title class="pl-0">Показатели</v-card-title>
                        <v-row>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.shows"
                                    label="Показы"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.clicks"
                                    label="Клики"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.ctr"
                                    label="CTR"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.vtr"
                                    label="VTR"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.cpv"
                                    label="CPV"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.coverage"
                                    label="Охват"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.refusals"
                                    label="Отказы"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.depth"
                                    label="Глубина"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.duration_session"
                                    label="Средняя длительность сеанса"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field
                                    v-model="form.objectives"
                                    label="Цели"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialogCreate = false">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="post()">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import CasesImageUploader from "../../../../components/helpers/CasesImageUploader";
import Errors from "../../../../utils/Errors";
import Form from "../../../../utils/Form";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "CaseCreate",
    components: {CasesImageUploader},
    data() {
        return {
            dialogCreate: false,
            editedIndex: -1,
            errors: new Errors(),
            errorHandlerImage: false,
            form: {
                category_id: '',
                status_id: '',
                logo: '',
                title: '',
                goal: '',
                geography: '',
                placement_format: '',
                period: '',
                gender: '',
                age: '',
                income: '',
                interest: '',
                shows: '',
                clicks: '',
                ctr: '',
                vtr: '',
                cpv: '',
                coverage: '',
                refusals: '',
                depth: '',
                duration_session: '',
                objectives: ''
            }
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
            createCases: 'cases/createCases',
            getStatuses: 'cases/getStatuses',
            getCategories: 'categories_cases/getCategories',
        }),

        updateImage(image) {
            this.form.logo = image
        },

        post() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            };

            let formData = new FormData();
            formData.append('category_id', this.form.category_id)
            formData.append('status_id', this.form.status_id)
            formData.append('image', this.form.logo)
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

            this.store(formData, config);
        },

        store(data, config) {
            axios.post('/api/cases', data, config)
                .then(() => {
                    this.createCases(data);
                    this.$emit('send')
                    this.dialogCreate = false

                    this.$refs.formStore.reset()
                    this.form.logo = ''
                })
                .catch(error => {
                    let {data} = error.response

                    if (data) {
                        this.errors.record(data)
                    }
                })
        }
    },

    mounted() {
        this.getCategories()
        this.getStatuses()
    }
}
</script>