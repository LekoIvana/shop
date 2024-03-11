<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
    <Navigation />
    <div v-if="isAdded" class="position-absolute end-0 me-5 mt-3">
        <div
            class="alert alert-light text-light"
            role="alert"
            style="background-color: #ff26c2"
        >
            {{message}}
        </div>
    </div>
<div class="container">
    <div class="d-flex gap-5 flex-wrap mt-5 ms-5">
        <div class="card shadow-lg" v-for="product in products" style="width: 18rem">
            <img
                    :src="'/images/' + product.image"
                    class="card-img-top"
                    alt="Image description"
                    width="18rem"
                    height="200px"
                />
            <div class="card-body"  style="background-color: #E4D9D9 !important;">
                <h5 class="card-title text-center text-dark">{{ product.name }}</h5>
                <hr>
                <p class="card-text text-dark">
                   Opis artikla:  {{product.description}}
                </p>
            </div>
            <ul class="list-group list-group-flush" >
                <li class="list-group-item text-dark" style="background-color: #E4D9D9 !important;">Veličina: {{ product.size }}</li>
                <li class="list-group-item text-dark" style="background-color: #E4D9D9 !important;">Namjenjeno: {{product.gender.name}}</li>
                <li class="list-group-item text-dark" style="background-color: #E4D9D9 !important;">Kategorija: {{product.category.name}}</li>
            </ul>
            <div class="card-body d-flex justify-content-between" style="background-color: #E4D9D9 !important;">
                <a href="#"  class="card-link fs-4 text-muted text-decoration-underline">{{ product.price }}</a>
                <a v-if="isUserLogin" href="#" @click="addCart(product.id)" class="card-link"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart cartSvg" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></a>
            </div>
        </div>
    </div>
</div>
    <Footer />
</template>

<script>
export default {
    data() {
        return {
            products: [],
            message:'',
            isAdded:false,
            isUserLogin: false,
        };
    },
    created() {
        this.getProductWoman();
        this.isUserLogged();
    },

    methods: {
        getProductWoman() {
            axios
                .get("/getProductWoman")
                .then((response) => {
                    this.products = response.data.proizvodiZenski;
                    console.log("Ovo su zenski proizvodi", this.products);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addCart(id){
            axios.post(`/addCart/${id}`)
                .then(response => {
                    console.log(response);
                    location.reload();
                })
                .catch(error => {
                    this.message = error.response.data.message;
                    this.isAdded = true;
                    console.log(this.message);
                })
        },
        isUserLogged() {
            axios
                .get("/isUserLogged")
                .then((response) => {
                    this.message = response.data.message;
                    this.isUserLogin= true;
                    console.log(this.message)
                    if(this.message === "Niste prijavljeni!"){
                        this.isUserLogin = false;
                    }

                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>

.cartSvg{
    color: #FF26C2;
}
.container {
        margin-bottom: 100px; 
    }
</style>
