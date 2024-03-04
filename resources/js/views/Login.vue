<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
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
                <div class="form-floating mb-3">
                    <input
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
                <button
                    type="submit"
                    class="btn btn-primary shadow-none w-100 regBtn"
                >
                    Prijava
                </button>
                <p v-if="falseLogin" class="text-danger text-center mt-3">
                    Pogrešan email ili lozinka
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
</style>
