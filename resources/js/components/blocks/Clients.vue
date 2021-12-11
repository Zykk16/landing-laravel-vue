<template>
    <div v-if="clients.length >= 1" class="clients my">
        <h1>Нам доверяют</h1>
        <div class="clients-wrapper">
            <div class="clients-item blur" v-for="(item, key) in clients" :key="key">
                <div class="clients-item-image">
                    <img :src="item.path" :alt="item.name">
                </div>
            </div>
        </div>
        <BallsClients :balls="balls"/>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import BallsClients from "../modules/BallsClients";

export default {
    name: "Clients",
    components: {BallsClients},
    data() {
        return {
            balls: [
                {className: 'ballOne', img: 'ball-1'},
                {className: 'ballTwo', img: 'ball-2'},
                {className: 'ballThree', img: 'ball-2'},
                {className: 'ballFour', img: 'ball-2'},
                {className: 'ballFifth', img: 'ball-2'},
            ]
        }
    },

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