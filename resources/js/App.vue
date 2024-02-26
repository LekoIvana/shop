<script setup>
import { RouterLink, RouterView } from "vue-router";
 import Navigation from "./components/Navigation.vue";
</script>

<template>
     <div>
        <router-view></router-view>
     </div>

</template>

<script>
export default {
    name: "App",
};
</script>

<style></style>
