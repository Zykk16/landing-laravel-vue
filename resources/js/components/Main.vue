<template>
    <div>
        <Header/>
        <main role="main">
            <!-- Banner -->
            <Banner id="about"/>

            <!-- Cases -->
            <div id="cases" class="cases my">
                <h1>Кейсы</h1>
            </div>

            <!-- Advantages -->
            <Advantages id="advantages"/>

            <!-- Advantages -->
            <Formats/>

            <!-- Clients -->
            <Clients id="clients"/>

            <!-- Contact form -->
            <ContactForm/>
        </main>
        <Footer/>
    </div>
</template>

<script>
import Button from "./helpers/Button";
import Advantages from "./blocks/Advantages";
import Banner from "./blocks/Banner";
import Footer from "./Footer";
import Formats from "./blocks/Formats";
import Clients from "./blocks/Clients";
import Header from "./Header";
import ContactForm from "./blocks/ContactForm";

export default {
    name: "Main",
    components: {ContactForm, Header, Clients, Formats, Footer, Banner, Advantages, Button}
}
</script>

<style scoped>

</style>
