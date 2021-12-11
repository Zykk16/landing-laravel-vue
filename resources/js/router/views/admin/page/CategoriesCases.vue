<template>
    <v-data-table
        v-if="loading"
        :headers="headers"
        :items="categories"
        sort-by="name"
        class="elevation-1"
        :item-class="rowClass">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Категории кейсов</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            <span class="new-default-admin-button">Новая категория</span>
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field v-model="editedItem.name" label="Название"
                                                      :error="errors.has('name')"
                                                      :error-messages="errors.get('name')"
                                                      @input="errors.clear('name')">
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Удалить категорию?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
        </template>
    </v-data-table>
</template>

<script>
import {mapActions, mapGetters} from "vuex"
import Form from "../../../../utils/Form"
import Errors from "../../../../utils/Errors";

export default {
    name: "CategoriesCases",
    data: () => ({
        dialog: false,
        dialogDelete: false,
        errors: new Errors(),
        headers: [
            {text: 'ID', align: 'start', sortable: false, value: 'id'},
            {text: 'Имя', value: 'name', width: '80%'},
            {text: 'Дата создания', value: 'created_at', width: '10%'},
            {text: 'Actions', value: 'actions', sortable: false, width: '10%'},
        ],
        editedIndex: -1,
        editedItem: new Form({
            name: ''
        }),
        defaultItem: {
            name: ''
        },
        delete: ''
    }),

    watch: {
        loading() {
            this.getCategory()
        },
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    computed: {
        ...mapGetters({
            categories: 'categories_cases/categories',
            loading: 'categories_cases/loading'
        }),

        formTitle() {
            return this.editedIndex === -1 ? 'Новая категория' : 'Изменить категорию'
        },
    },

    methods: {
        ...mapActions({
            getCategory: 'categories_cases/getCategories',
            createCategory: 'categories_cases/createCategory',
            updateCategory: 'categories_cases/updateCategory',
            remove: 'categories_cases/remove'
        }),

        rowClass() {
            return 'centered-item'
        },

        editItem(item) {
            this.editedIndex = this.categories.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.delete = item.id
            this.editedIndex = this.categories.indexOf(item)
            this.form = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.remove(this.delete).finally(() => {
                this.getCategory()
                this.closeDelete()
            })
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
        },

        save() {
            let formData = new FormData()
            formData.append('name', this.editedItem.name)

            if (this.editedIndex > -1) {

                this.updateCategory({id: this.editedItem.id, data: this.editedItem}).then(() => {
                    this.getCategory()
                    this.close()
                }).catch(error => {
                    let {data} = error.response

                    if (data) {
                        this.errors.record(data)
                    }
                })
            } else {
                axios.post('/api/categories_cases', formData).then((data) => {
                    this.createCategory(data)
                    this.getCategory()
                    this.close()
                }).catch(error => {
                    let {data} = error.response

                    if (data) {
                        this.errors.record(data)
                    }
                })
            }
        },
    },

    created() {
        this.getCategory()
    }
}
</script>

<style scoped>

</style>