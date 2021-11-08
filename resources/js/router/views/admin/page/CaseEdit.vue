<template>
    <v-dialog id="edit-case" content-class="edit-case" v-model="openEditCase" persistent max-width="1000px"
              @submit.prevent>
        <v-card>
            <v-card-title>
                <span class="text-h5">Edit case</span>
            </v-card-title>
            <v-card-text>
                <v-form @submit.prevent>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <cases-image-uploader :cover="form.image" @loaded="updateImage"/>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="form.title"
                                              label="Клиент"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-select :items="categories"
                                          item-text="name"
                                          item-value="id"
                                          label="Категория"
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
                                    label="Период компании"></v-text-field>
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
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="form.thematic_resources"
                                    label="Тематические ресурсы"></v-text-field>
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
                <v-btn color="blue darken-1" text @click="closeDialog">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="createItem(form.id)">Save</v-btn>
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
    name: "CaseEdit",
    components: {CasesImageUploader},
    props: ['openEditCase', 'form'],
    data() {
        return {
            editedIndex: -1,
            errors: new Errors(),
            formEdit: ''
        }
    },

    computed: {
        ...mapGetters({
            categories: 'categories_cases/categories'
        })
    },

    methods: {
        ...mapActions({
            updateCases: 'cases/updateCases',
            getCategories: 'categories_cases/getCategories',
        }),

        updateImage(image) {
            this.form.image = image
        },

        createItem() {
            this.formEdit = new Form({
                title: this.form.title ?? '',
                category_id: this.form.category_id.id ?? '',
                logo: this.form.image ?? '',
                goal: '',
                geography: '',
                placement: '',
                gender: '',
                age: '',
                income: '',
                interest: '',
                thematic_resources: '',
                shows: '',
                clicks: '',
                ctr: '',
                vtr: '',
                coverage: '',
                refusals: '',
                depth: '',
                duration_session: '',
                objectives: ''
            })

            this.formEdit.submit(`/api/cases/${this.form.id}`, false, 'put')
                .then(data => {
                    this.updateCases(data);
                    this.$emit('send')
                }).catch(error => {
                let formErrors = error.response;

                if (formErrors) {
                    this.errors.record(formErrors);
                } else {
                    alert('Error request!')
                }
            })
        },

        closeDialog() {
            this.$emit('close')
        }
    }
}
</script>

<style scoped>

</style>