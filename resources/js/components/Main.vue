<template>
    <div>
        <Header/>
        <main role="main">
            <!-- Banner -->
            <Banner id="about"/>

            <!-- Cases -->
            <Cases id="cases"/>

            <!-- Advantages -->
            <Advantages id="advantages"/>

            <!-- Advantages -->
            <Formats id="formats"/>

            <!-- Clients -->
            <Clients id="clients"/>

            <!-- Contact form -->
            <ContactForm id="contactForm"/>
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
import Cases from "./blocks/Cases";

export default {
    name: "Main",
    components: {Cases, ContactForm, Header, Clients, Formats, Footer, Banner, Advantages, Button}
}
</script>

<style scoped>

</style>
