<template>
    <div>
        <v-card>
            <v-card-title>
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                v-if="loading"
                :headers="headers"
                :items="filteredCases"
                :search.sync="search"
                item-key="id"
                class="elevation-1"
                :item-class="rowClass">
                <template v-slot:item.logo="{ item }">
                    <img class="image-brand-backend" :src="item.image" alt="">
                </template>
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Cases</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>

                        <case-create @send="sendItem"/>
                        <case-edit v-if="openEditCase"
                                   :data="form"
                                   :openEditCase="openEditCase"
                                   @close="closeDialog"
                                   @send="sendItem"/>

                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5 delete-title">Действительно удалить?
                                </v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <template>
                                        <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                        <v-btn color="blue darken-1" text @click="deleteItemConfirm()">OK</v-btn>
                                        <v-spacer></v-spacer>
                                    </template>
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
        </v-card>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import CaseCreate from "./CaseCreate";
import CaseEdit from "./CaseEdit";

export default {
    name: "CasesAdmin",
    components: {CaseEdit, CaseCreate},
    data() {
        return {
            dialogDelete: false,
            openEditCase: false,
            search: '',
            form: [],
            headers: [
                {text: 'Бренд', sortable: false, value: 'logo'},
                {text: 'Клиент', value: 'title'},
                {text: 'Категория', value: 'category_id.name'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],
            editedIndex: -1,
            filters: {
                category_id: [],
            },
            delete: ''
        }
    },

    watch: {
        loading() {
            this.getCases()
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
        }),

        editItem(item) {
            this.editedIndex = this.cases.indexOf(item)
            this.form = Object.assign({}, item)
            this.openEditCase = true
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
                if (index === "date") {
                    if (!isDesc) {
                        return dateHelp.compare(a.date, b.date);
                    } else {
                        return dateHelp.compare(b.date, a.date);
                    }
                } else {
                    if (!isDesc) {
                        return a[index] < b[index] ? -1 : 1;
                    } else {
                        return b[index] < a[index] ? -1 : 1;
                    }
                }
            });
            return items;
        },

        sendItem() {
            this.getCases()
            this.openEditCase = false
        },

        closeDialog() {
            this.openEditCase = false
        },

        rowClass() {
            return 'centered-item'
        },
    },

    mounted() {
        this.getCases()
    }
}
</script>

<style lang="scss" scoped>
.image-brand-backend {
    width: 100px;
    height: auto;
    padding: 1em;
}
</style>