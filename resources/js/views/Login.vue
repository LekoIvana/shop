<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <Navigation />
    <div class="container">
        <div
            class="login-form d-flex justify-content-center align-items-center"
            style="height: 70vh; background-color: "
        >
            <form
                class="col-lg-6 col-12 col-md-10 col-sm-8 p-5 rounded"
                style="background-color: #e4d9d9"
                @submit.prevent="loginUser()"
                method="POST"
            >
                <h3 class="text-center">Prijava</h3>
                <div class="form-floating mb-3">
                    <input
                        type="email"
                        class="form-control"
                        id="floatingInput"
                        placeholder="name@example.com"
                        v-model="user.email"
                    />
                    <label for="floatingInput">Email adresa</label>
                    <p v-if="errors.email" class="text-danger">
                        {{ errors.email[0] }}
                    </p>
                </div>
                <div class="input-group mb-3">
                <div class="form-floating ">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        type="password"
                        class="form-control"
                        id="floatingPassword"
                        placeholder="Password"
                        v-model="user.password"
                    />
                    <label for="floatingPassword">Lozinka</label>
                    <p v-if="errors.password" class="text-danger">
                        {{ errors.password[0] }}
                    </p>
                </div>
                <span class="input-group-text" @click="showPassword = !showPassword" >
                    <i class="bi" :class="[showPassword ? 'bi-eye' : 'bi-eye-slash']" aria-hidden="true" ></i>
                </span>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary shadow-none w-100 regBtn"
                >
                    Prijava
                </button>
                <p class="text-center mt-3">Još nisi naš korisnik? <span><router-link class="text-decoration-underline" style="color:#ff26c2" to="/register">Registriraj se!</router-link></span></p>
                <p class="text-center mt-3"><span><router-link class="text-decoration:none;" style="color:#ff26c2" to="#">Zaboravljena lozinka?</router-link></span></p>
                <p v-if="falseLogin" class="text-danger text-center mt-3">
                    Pogrešan email ili lozinka!
                </p>
            </form>
        </div>
    </div>
    <Footer />
</template>

<script>

export default {
   data(){
         return {
              user: {
                email: '',
                password: ''
              },
              errors: {},
              falseLogin: false,
              showPassword:false,
              
         };
    },
    methods:{
        loginUser() {
            const User = {
                email: this.user.email,
                password: this.user.password,
            };
            axios
                .post("/loginUser", User)
                .then((response) => {
                    this.loginMessage = response.data.message;

                    this.successLogin = true;
                    if (this.loginMessage == "Uspjesna prijava") {
                        this.$store.dispatch(
                            "setLoginMessage",
                            this.loginMessage
                        );
                        this.$store.commit(
                            "setLoggedInUser",
                            response.data.user
                        );
                        this.successLogin = true;
                        this.falseLogin = false;
                        this.$router.push("/");
                    } else {
                        this.falseLogin = true;
                        this.successLogin = false;
                    }
                })
                .catch((error) => {
                    console.log("Error:", error);
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },
    }
};
</script>

<style scoped>
.regBtn {
    background-color: #ff26c2;
    border: none;
}
.form-control:focus {
        border-color: #ff26c2;
        box-shadow: inset 0 1px 1px rgb(224, 62, 216), 0 0 8px rgb(224, 62, 216);
    }
    .form-select:focus {
        box-shadow: inset 0 1px 1px rgb(224, 62, 216), 0 0 8px rgb(224, 62, 216);
        border-color: #ff26c2;
}
</style>
