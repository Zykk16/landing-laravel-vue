<template>
    <div>
        <v-card>
            <v-card-title>
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Найти по таблице"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                v-if="loading"
                :headers="headers"
                :items="filteredCases"
                :search.sync="search"
                :sort-by="['category_id.name', 'id']"
                :sort-desc="[false, true]"
                multi-sort
                item-key="id"
                class="elevation-1"
                :items-per-page="15"
                :item-class="rowClass">
                <template v-slot:item.status_id="{ item }">
                    <div v-if="loading">
                        <v-chip :color="getColor(item.status_id)" dark>
                            {{ statusHandler(item.status_id) }}
                        </v-chip>
                    </div>
                </template>
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Кейсы</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <case-create @send="sendItem"/>
                        <case-edit v-if="openEditCase"
                                   :data="form"
                                   :openEditCase="openEditCase"
                                   @close="closeDialog"
                                   @send="sendItem"/>
                        <cases-copy v-if="openCopyCase"
                                    :data="form"
                                    :openEditCase="openCopyCase"
                                    @close="closeDialog"
                                    @send="sendItem"/>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5 delete-title">Действительно удалить?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <template>
                                        <v-btn color="blue darken-1" text @click="closeDelete">Отменить</v-btn>
                                        <v-btn color="blue darken-1" text @click="deleteItemConfirm()">Удалить</v-btn>
                                        <v-spacer></v-spacer>
                                    </template>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
                    <v-icon small class="mr-2" @click="deleteItem(item)">mdi-delete</v-icon>
                    <v-icon small @click="copyItem(item)">mdi-content-copy</v-icon>
                </template>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex"
import CaseCreate from "./CaseCreate"
import CaseEdit from "./CaseEdit"
import CasesCopy from "./CaseCopy";

export default {
    name: "CasesAdmin",
    components: {CasesCopy, CaseEdit, CaseCreate},
    data() {
        return {
            dialogDelete: false,
            openEditCase: false,
            openCopyCase: false,
            search: '',
            form: [],
            headers: [
                {text: 'ID', value: 'id'},
                {text: 'Название клиента', value: 'title'},
                {text: 'Категория', value: 'category_id.name'},
                {text: 'Дата создания', value: 'created_at'},
                {text: 'Дата обновления', value: 'updated_at'},
                {text: 'Статус', value: 'status_id'},
                {value: 'actions', sortable: false},
            ],
            editedIndex: -1,
            filters: {
                category_id: [],
            },
            delete: '',
            statusClass: '',
            copy: false
        }
    },

    watch: {
        loading() {
            this.getCases()
            this.getStatuses()
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
            cases: 'cases/cases',
            statuses: 'cases/statuses',
            loading: 'cases/loading'
        }),

        filteredCases() {
            if (this.loading) {
                return this.cases.filter(d => {
                    return Object.keys(this.filters).every(f => {
                        return this.filters[f].length < 1 || this.filters[f].includes(d[f].name)
                    })
                })
            }
        }
    },

    methods: {
        ...mapActions({
            deleteCases: 'cases/remove',
            getCases: 'cases/getCases',
            getStatuses: 'cases/getStatuses'
        }),

        statusHandler(status) {
            if (this.loading) {
                return this.statuses.find(e => e.id === status).name
            }
        },

        getColor(calories) {
            if (calories === 1) return 'green'
            else if (calories === 2) return 'orange'
            else return 'gray'
        },

        editItem(item) {
            this.editedIndex = this.cases.indexOf(item)
            this.form = Object.assign({}, item)
            this.openEditCase = true
        },

        copyItem(item) {
            this.editedIndex = this.cases.indexOf(item)
            this.form = Object.assign({}, item)
            this.openCopyCase = true
        },

        deleteItem(item) {
            this.delete = item.id
            this.editedIndex = this.cases.indexOf(item)
            this.form = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.cases.splice(this.editedIndex, 1)

            this.deleteCases(this.delete).finally(() => {
                this.closeDelete()
            })
        },

        closeDelete() {
            this.dialogDelete = false
        },

        columnValueList(val) {
            return this.cases.map(d => {
                const container = {}
                container[val] = d.category.name

                return container.category
            })
        },

        customSort(items, index, isDesc) {
            items.sort((a, b) => {
                if (!isDesc) {
                    return a[index] < b[index] ? -1 : 1
                } else {
                    return b[index] < a[index] ? -1 : 1
                }
            })
            return items
        },

        sendItem() {
            this.getCases()
            this.openEditCase = false
            this.openCopyCase = false
        },

        closeDialog() {
            this.openEditCase = false
            this.openCopyCase = false
        },

        rowClass() {
            return 'centered-item'
        },
    },

    mounted() {
        this.getStatuses()
        this.getCases()
    }
}
</script>

<style lang="scss" scoped>
</style>