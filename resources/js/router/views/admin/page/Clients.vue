<template>
    <div class="plates">
        <ImagesUpload class="upload-image" @upload="getClients()"/>
        <div class="plate-image">
            <div class="plate-image-item" v-for="(item, key) in clients" :key="key">
                <img :src="item.path" :alt="item.name">
                <div class="cross" @click="deleteImage(item.id)">
                    <img src="../../../../../img/svg/cross.svg" alt="">
                </div>
                <input class="order" type="text" v-model="item.order" @focusout="handlerInput(item.id, item.order)">
            </div>
        </div>
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
            loading: true
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
                this.getClients()
                // this.$notify({
                //     text: `Вакансия ${id} успешно удалена.`,
                //     type: 'success'
                // })
            })
        },
        handlerInput(id, orderId) {
            this.update({
                id: id,
                orderId: orderId
            })
        }
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