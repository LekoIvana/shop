<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <Navigation />

    <div class="container mt-6">
        <div
            class="login-form d-flex justify-content-center align-items-center"
            style="height: 80vh; background-color: "
        >
        <form
                class="col-lg-6 col-12 col-md-10 col-sm-8 p-5 rounded"
                style="background-color: #e4d9d9"
                @submit.prevent="registerUser()"
                method="POST"
            >
                <h3 class="text-center">Registracija</h3>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="floatingInput"
                        placeholder="name@example.com"
                        v-model="user.name"
                    />
                    <label for="floatingInput">Ime</label>
                    <p v-if="errors.name" class="text-danger">
                        {{ errors.name[0] }}
                    </p>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        id="floatingInput"
                        placeholder="name@example.com"
                        v-model="user.surname"
                    />
                    <label for="floatingInput">Prezime</label>
                    <p v-if="errors.surname" class="text-danger">
                        {{ errors.surname[0] }}
                    </p>
                </div>

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
                <div class="input-group mb-3">
                <div class="form-floating ">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        type="password"
                        class="form-control"
                        id="floatingPassword"
                        placeholder="Password"
                        v-model="user.repeat_password"
                    />
                    <label for="floatingPassword">Ponovi lozinku</label>
                    <p v-if="errors.repeat_password" class="text-danger">
                        {{ errors.repeat_password[0] }}
                    </p>
                    
                </div>
                <span class="input-group-text" @click="showPassword = !showPassword" >
                    <i class="bi" :class="[showPassword ? 'bi-eye' : 'bi-eye-slash']" aria-hidden="true" ></i>
                </span>
                </div>
                <div class="form-check d-flex justify-content-center mb-2">
                    <input  class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                    <label class="form-check-label" for="form2Example3g">
                    Prihvaćam opća <a href="#!" class="link" style="color: #ff26c2;"><u>pravila korištenja!</u></a>
                    </label>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary shadow-none w-100 regBtn"
                >
                    Registriraj se
                </button>
                
                <p class="text-center mt-3">Već si naš korisnik? <span><router-link class="text-decoration-underline" style="color:#ff26c2" to="/login">Prijavi se!</router-link></span></p>
                <div
                    v-if="successRegister"
                    class="alert alert-light text-light mt-3 text-center"
                    role="alert"
                    style="background-color: #ff26c2"
                >
                    {{ message }}
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
            showPassword:false,
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
.form-control:focus {
        border-color: #ff26c2;
        box-shadow: inset 0 1px 1px rgb(224, 62, 216), 0 0 8px rgb(224, 62, 216);
    }
    .form-select:focus {
        box-shadow: inset 0 1px 1px rgb(224, 62, 216), 0 0 8px rgb(224, 62, 216);
        border-color: #ff26c2;
}
.container {
        margin-bottom: 150px; 
        margin-top: 100px;
    }

    .form-check-input:checked {
    background-color: #ff26c2;
}
.form-check-input:checked {
  box-shadow:  0 0 5px #ff26c2 !important;
  border-color: #ff26c2;
  
}
.form-check-input{
    box-shadow:  0 0 5px #ff26c2 !important;
    border-color: #ff26c2 !important;

}
</style>
