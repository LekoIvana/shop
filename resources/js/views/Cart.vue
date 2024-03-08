<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";


</script>

<template>
    <Navigation :number="number"  />
    <div v-if="!isLoggedIn" class="container mt-3 d-flex justify-content-center">
        <div class="alert alert-warning text-center col-12 col-sm-6 col-lg-6 col-md-6">Nemate pristup košarici</div>
    </div>

    <div
        class="container d-flex flex-column align-items-center justify-content-center mt-5 gap-3"
    >
        <h3 class="text-center">Tvoja košarica</h3>
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col" v-for="item in items" :key="item.id">
                <div
                    class="card"
                    style="max-width: 540px; background-color: #e4d9d9"
                >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img
                                :src="'/images/' + item.product.image"
                                class="card-img-top img-fluid rounded-start"
                                alt="Image description"
                                style="object-fit: cover; height: 100%"
                            />
                        </div>
                        <div class="col-md-8">
                            <div
                                class="card-body"
                                style="background-color: #e4d9d9"
                            >
                                <h5 class="card-title">
                                    {{ item.product.name }}
                                </h5>
                                <p class="card-text">
                                    {{ item.product.description }}
                                </p>
                                <p class="card-text">
                                    <small class="text-body-secondary">{{
                                        item.product.price
                                    }}</small>
                                </p>
                            </div>
                            <div
                                class="d-flex justify-content-end me-3 mb-2"
                                style="background-color: #e4d9d9"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="25"
                                    height="25"
                                    fill="currentColor"
                                    class="bi bi-trash trashIcon"
                                    viewBox="0 0 16 16"
                                    @click="deleteItem(item.id)"
                                >
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"
                                    />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
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
            items: [],
            number: "",
            isLoggedIn: false,
        };
        
    },
    isLoggedIn() {
            return this.loggedInUser !== null;
        },
    created() {
        this.getCartItems();
        this.getCartNumber();
    },
    methods: {
        getCartItems() {
            axios
                .get("/getCartItems")
                .then((response) => {
                    this.items = response.data.cartItems;
                    console.log(this.items);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCartNumber() {
            axios
                .get("/getCartNumber")
                .then((response) => {
                    this.number = response.data.numberOfItems;
                    console.log("Broj artikala u kosarici", this.number);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteItem(id) {
            axios
                .post(`/deleteItem/${id}`)
                .then((response) => {
                    console.log(response);
                    this.getCartItems();
                    this.getCartNumber();
                    location.reload();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
.trashIcon {
    color: #ff26c2;
    cursor: pointer;
}
</style>
