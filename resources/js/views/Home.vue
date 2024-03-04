<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";

</script>



<template>
    <Navigation />
    <div>
        <div class="allItems d-flex flex-column align-items-center justify-content-center">
            <h1 class="text-center"><span style="color:#ff26c2; letter-spacing: 5px;">KUPI</span> ili <span style="color:#ff26c2; letter-spacing: 5px;" >PRODAJ</span></h1>
            <p class="fs-4">odjeću, cipele ili modne dodatke online</p>
            <button class="btn text-light" style="background-color: #ff26c2;">Saznaj više</button>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="d-flex justify-content-center align-items-center flex-column mt-4 p-4 col-lg-5 col-12 col-md-8 col-sm-10" style="background-color: #ff26c2; ">
                <p class="text-light">Kako koristiti Trustap na TvojeKrpice.hr</p>
                <button class="btn bg-light text-dark">Više informacija</button>
                <div class="mt-3">
                    <p class="text-light">TVOJEKRPICE | TRUSTAP</p>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>


<style  scoped>
.allItems{
    background-image: url('../images/home.png');
    height: 300px;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
