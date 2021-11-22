<template>
    <v-data-table
        v-if="users"
        :headers="headers"
        :items="users"
        sort-by="name"
        class="elevation-1"
        :item-class="rowClass">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Пользователи</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">Новый пользователь</v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field v-model="editedItem.name" label="Название"></v-text-field>
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
import Form from "../../../../utils/Form"

export default {
    name: "Users",
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {text: 'Имя', value: 'name'},
            {text: 'Email', value: 'email'},
            {text: 'Дата создания', value: 'created_at'},
            {text: 'Actions', value: 'actions', sortable: false, width: '10%'},
        ],
        users: [],
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
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    computed: {

        formTitle() {
            return this.editedIndex === -1 ? 'Новый пользователь' : 'Редактировать пользователя'
        },
    },

    methods: {

        rowClass() {
            return 'centered-item'
        },

        editItem(item) {
            this.editedIndex = this.users.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.delete = item.id
            this.editedIndex = this.users.indexOf(item)
            this.form = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.remove(this.delete).finally(() => {
                this.getUsers()
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

        getUsers() {
            axios.get('/api/users').then(response => {
                this.users = response.data
            })
        },

        save() {
            let formData = new FormData()
            formData.append('name', this.editedItem.name)
            formData.append('email', this.editedItem.email)
            formData.append('email', this.editedItem.password)
            formData.append('email', this.editedItem.password_confirmation)

            if (this.editedIndex > -1) {
                axios.put(`/api/users/${id}`, formData).then(() => {
                    this.getUsers()
                    this.close()
                })
            } else {
                axios.post('/api/users', formData).then(() => {
                    this.getUsers()
                    this.close()
                })
            }
        },
    },

    created() {
        this.getUsers()
    }
}
</script>

<style scoped>

</style>