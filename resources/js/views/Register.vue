<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
    <Navigation />

    <div class="container">
        <div
            class="login-form d-flex justify-content-center align-items-center"
            style="height: 80vh; background-color: "
        >
            <form
                class="col-lg-6 col-12 col-md-10 col-sm-8 p-4 rounded"
                style="background-color: #e4d9d9"
                @submit.prevent="registerUser()"
                method="POST"
            >
                <h3 class="text-center">Registracija</h3>
                <div class="mb">
                    <label for="exampleInputPassword1" class="form-label"
                        >Ime</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputPassword1"
                        v-model="user.name"
                    />
                    <p v-if="errors.name" class="text-danger">
                        {{ errors.name[0] }}
                    </p>
                </div>
                <div class="mb">
                    <label for="exampleInputPassword1" class="form-label"
                        >Prezime</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputPassword1"
                        v-model="user.surname"
                    />
                    <p v-if="errors.surname" class="text-danger">
                        {{ errors.surname[0] }}
                    </p>
                </div>
                <div class="mb">
                    <label for="exampleInputEmail1" class="form-label"
                        >Email</label
                    >
                    <input
                        type="email"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        v-model="user.email"
                    />
                    <p v-if="errors.email" class="text-danger">
                        {{ errors.email[0] }}
                    </p>
                </div>
                <div class="mb">
                    <label for="exampleInputPassword1" class="form-label"
                        >Lozinka</label
                    >
                    <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword1"
                        v-model="user.password"
                    />
                    <p v-if="errors.password" class="text-danger">
                        {{ errors.password[0] }}
                    </p>
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label"
                        >Ponovi lozinku</label
                    >
                    <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword1"
                        v-model="user.repeat_password"
                    />
                    <p v-if="errors.repeat_password" class="text-danger">
                        {{ errors.repeat_password[0] }}
                    </p>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary shadow-none w-100 regBtn"
                >
                    Registriraj se
                </button>
                <div
                    v-if="successRegister"
                    class="alert alert-light text-light mt-3 text-center"
                    role="alert"
                    style="background-color: #ff26c2"
                >
                    {{ message }}
                </div>
                <div
                    v-if="existMailUser"
                    class="alert alert-light text-light mt-3 text-center"
                    role="alert"
                    style="background-color: #ff26c2"
                >
                    Postoji korisnik sa tim emailom!
                </div>
            </form>
        </div>
    </div>
    <Footer />
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: "",
                surname: "",
                email: "",
                password: "",
                repeat_password: "",
              
            },
            errors: {},
            existMailUser:false,
        };
    },
    methods: {
        registerUser() {
            const User = {
                name: this.user.name,
                surname: this.user.surname,
                email: this.user.email,
                password: this.user.password,
                repeat_password: this.user.repeat_password,
            };

            axios
                .post("/registerUser", User)
                .then((response) => {
                    this.message = response.data.message;
                    this.successRegister = true;
                    this.errors = {};
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else if(error.response && error.response.status === 404) {
                        this.existMailUser = true;
                    }else{
                        console.log(error)
                    }
                });
        },
    },
};
</script>

<style scoped>
.regBtn {
    background-color: #ff26c2;
    border: none;
}
</style>
