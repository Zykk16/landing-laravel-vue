<template>
    <div>
        <Header/>
        <keep-alive>
            <router-view :key="$route.fullPath"/>
        </keep-alive>
        <Footer/>
    </div>
</template>

<script>

import Header from "./components/Header";
import Footer from "./components/Footer";

export default {
    name: "App",
    components: {Footer, Header}
}
</script>
