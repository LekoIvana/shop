<script setup>


</script>

<template>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
    <div>

    <nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light p-3 shadow-sm" style="background-color: #E4D9D9 !important;">
      <div class="container">
        <router-link  class="navbar-brand" to="/"><i class="fa-solid fa-shop me-2"></i> <strong>TVOJE KRPICE</strong></router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
          <div class="ms-auto  d-lg-block">
            <div class="input-group">
                <form class="d-flex" @submit.prevent="searchProducts" >
              <input type="text" class="form-control" v-model="text"  style="color:#7a7a7a; border:1px solid #FF26C2">
              <button type="submit" class="btn  text-white" style="background-color: #FF26C2;">Search</button>
            </form>
            </div>
          </div>
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
              <router-link class="nav-link mx-2 text-uppercase active " aria-current="page" to="/">Početna</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link mx-2 text-uppercase active " aria-current="page" to="/mens">Muškarci</router-link>
            </li>
            <li class="nav-item">
            <router-link class="nav-link mx-2 text-uppercase active " aria-current="page" to="/womens">Žene</router-link>

            </li>
            <li class="nav-item">
                <router-link class="nav-link mx-2 text-uppercase active " aria-current="page" to="/kids">Djeca</router-link>

            </li>
          </ul>
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
              <router-link to="/cart" class="nav-link mx-2 text-uppercase d-flex align-items-center position-relative" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg> Košarica

<span v-if="isLoggedIn" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="background-color: #FF26C2  !important ;">
    {{number}}
    <span class="visually-hidden">unread messages</span>
  </span>
</router-link>
            </li>
            <li  v-if="user.role === 'admin'" class="nav-item">

<router-link class="nav-link mx-2 text-uppercase d-flex align-items-center" to="/admin"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg>ADMIN</router-link>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto" v-if="!isLoggedIn">
            <li class="nav-item ">
                <router-link class="nav-link mx-2 text-uppercase" style="color:#FF26C2;" to="/register">Registracija</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link mx-2 text-uppercase" style="color:#FF26C2;" to="/login">Prijava</router-link>
            </li>
          </ul>
          <ul class="navbar-nav">
                        <li class="nav-item dropdown" v-if="isLoggedIn">
                            <a
                                class="nav-link dropdown-toggle text-dark"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{ loggedInUser.name }}
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdown"
                            >

                                <li>
                                    <a
                                        @click="logoutUser()"
                                        class="dropdown-item"
                                        href="#"
                                    >
                                        Odjavi se! <i class="bi bi-box-arrow-in-right" style="color: #ff26c2;"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
        </div>
      </div>
    </nav>
    </div>
    <div v-if="!isLoggedIn" class="position-absolute end-0 me-5 z-3 mt-3">
        <div
            class="alert alert-light text-light"
            role="alert"
            style="background-color: #ff26c2"
        >
            Pregledavate ovu stranicu kao gost.
        </div>
    </div>

</template>

<script>
     import { mapState } from "vuex";
     import axios from "axios";
    import { mapGetters } from "vuex";
    import { mapActions } from "vuex";

    export default {

        data(){
            return {
            isLoggedIn: false,
            user: {},
            number:'',
            text: "",

        };
        },
        computed: {
        ...mapState(["loginMessage"]),
        ...mapGetters(["loggedInUser"]),

        isLoggedIn() {
            return this.loggedInUser !== null;
        },
    },
    created(){
        this.getUser();
        this.getCartNumber();


    },
    methods:{
            logoutUser() {
            axios
                .post("/logoutUser")
                .then((response) => {
                    this.isLoggedIn = false;
                    this.loggedInUser = null;
                    this.$store.dispatch("logout");
                    this.$router.push("/login");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getUser() {
            axios
                .get("/getUser")
                .then((response) => {
                    this.user = response.data;
                    console.log(this.user.role);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCartNumber(){
            axios
                .get("/getCartNumber")
                .then((response) => {
                    this.number = response.data.numberOfItems;
                    console.log("Broj artikala u kosarici", this.number)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        searchProducts() {
            axios
                .get("/search", { params: { text: this.text } })
                .then((response) => {
                    const results = response.data.results;
                    this.search = true;
                    console.log(results);

                    this.$router.push({
                         name: "searchResult",
                        query: { results: JSON.stringify(results) },

                    } ).then(() => {
    location.reload();
});;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        }
    };
</script>

<style scoped>
.form-control:focus {
        border-color: #ff26c2;
        box-shadow: inset 0 1px 1px rgb(224, 62, 216), 0 0 8px rgb(224, 62, 216);
    }
    .form-select:focus {
        box-shadow: inset 0 1px 1px rgb(224, 62, 216), 0 0 8px rgb(224, 62, 216);
        border-color: #ff26c2;
}
</style>
