<template>
    <div>
        <Header/>
        <main role="main">
            <div class="case">
                {{ data }}
            </div>
        </main>
        <Footer/>
    </div>
</template>

<script>
import Header from "../Header";
import Footer from "../Footer";

export default {
    name: "Case",
    components: {Footer, Header},
    data() {
        return {
            data: this.$route.params.data
        }
    },

    computed: {},

    mounted() {
       axios.get('/api/cases/' + this.$route.params.id)
            .then(response => {
                this.data = response.data.data
                if (this.data.title) {
                    document.title = this.data.title
                }
            })
    }
}
</script>

<style scoped>

</style>