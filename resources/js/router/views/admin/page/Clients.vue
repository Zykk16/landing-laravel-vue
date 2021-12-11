<template>
    <div class="plates">
        <ImagesUpload class="upload-image" @upload="getClients()"/>
        <div class="plate-image">
            <div class="plate-image-item" v-for="(item, key) in clients" :key="key">
                <img :src="item.path" :alt="item.name">
                <div class="cross" @click="showDeleteDialog(item)">
                    <img src="../../../../../img/svg/cross.svg" alt="">
                </div>
                <input class="order" type="text" v-model="item.order" @focusout="handlerInput(item.id, item.order)">
            </div>
        </div>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="text-h5 grey lighten-2">Действительно удалить?</v-card-title>
                <v-card-text>
                    <img :src="itemToDelete.path" :alt="itemToDelete.name">
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">Отменить</v-btn>
                    <v-btn color="primary" text @click="deleteImage(itemToDelete.id)">Удалить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import ImagesUpload from "../ImagesUpload"
import {mapActions, mapGetters} from "vuex"

export default {
    name: "Clients",
    components: {ImagesUpload},
    data() {
        return {
            loading: true,
            dialog: false,
            itemToDelete: ''
        }
    },

    computed: {
        ...mapGetters({
            clients: 'clients/clients'
        })
    },

    methods: {
        ...mapActions({
            getClients: 'clients/getClients',
            delete: 'clients/remove',
            update: 'clients/saveOrder'
        }),

        deleteImage(id) {
            this.delete(id).finally(() => {
                this.dialog = false
                this.getClients()
            })
        },

        handlerInput(id, orderId) {
            this.update({
                id: id,
                orderId: orderId
            })
        },

        showDeleteDialog(item) {
            this.itemToDelete = item
            this.dialog = true
        },
    },

    mounted() {
        this.getClients()
    }
}
</script>

<style lang="scss" scoped>
.plates {
    padding: 2em;

    .plate-image {
        display: flex;
        flex-wrap: wrap;

        &-item {
            position: relative;
            margin-right: 1em;
            margin-bottom: 1em;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 255px;
            height: 255px;
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid #EEEEEE;
            box-sizing: border-box;
            border-radius: 46px;

            img {
                max-width: 180px;
                height: auto;
            }

            .cross {
                position: absolute;
                top: 15px;
                right: 15px;
                width: 20px;
                height: 20px;
                cursor: pointer;
                z-index: 1;
            }

            .order {
                position: absolute;
                top: 40px;
                right: 15px;
                width: 15px;
                border: 1px solid #e1e1e1;
                border-radius: 3px;
                outline: none;
                font: 14px/1 'ArtegraSoft-Regular', sans-serif;
                text-align: center;
            }
        }
    }

    .upload-image {
        margin-bottom: 1em;
    }
}
</style>