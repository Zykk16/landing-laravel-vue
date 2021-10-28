<template>
    <div class="clients my">
        <h1>Нам доверяют</h1>
        <div class="clients-wrapper">
            <div class="clients-item" v-for="(item, key) in clients" :key="key">
                <div class="clients-item-image">
                    <img :src="item.path" :alt="item.name">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Clients",
    computed: {
        ...mapGetters({
            clients: 'clients/clients'
        })
    },

    methods: {
        ...mapActions({
            getClients: 'clients/getClients'
        })
    },

    mounted() {
        this.getClients()
    }
}
</script>

<style scoped>

</style>