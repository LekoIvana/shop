<script setup>
import Navigation from "../components/Navigation.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
    <Navigation />

    <div v-if="user.role === 'korisnik'" class="container mt-3 d-flex justify-content-center">
        <div class="alert alert-warning text-center col-12 col-sm-6 col-lg-6 col-md-6">Nemate pristup administraciji!</div>
    </div>

    <div  v-if="user.role === 'admin'">
        <div v-if="isUserLogin" class="dropdown position-absolute end-0 me-3 mt-2">
        <button
            class="btn custom-btn dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            

        >
            Opcije
        </button>
        <ul class="dropdown-menu">
            <li>
                <button
                    class="btn btn-transparent"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal10"
                    data-bs-whatever="@mdo"
                >
                    Dodaj kategoriju
                </button>
            </li>
            <li>
                <button
                    class="btn btn-transparent"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal20"
                    data-bs-whatever="@mdo"
                >
                    Dodaj artikl
                </button>
            </li>
        </ul>
    </div>

    <div class="container mt-5">
        <div
            class="accordion accordion-flush shadow-lg"
            id="accordionFlushExample"
        >
            <div class="accordion-item" :class="{ 'disabled': isDisabled }">
                <h2 class="accordion-header">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne"
                        aria-expanded="false"
                        aria-controls="flush-collapseOne"
                    >
                        Pregled svih korisnika
                    </button>
                </h2>
                <div
                    id="flush-collapseOne"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample"
                >
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <th>Ime Prezime</th>
                                    <th>Email</th>
                                    <th>Uloga</th>
                                    <th>Opcije</th>
                                    <th>Promoviraj</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1">
                                                    {{ user.name }}
                                                </p>
                                                <p class="fw-bold mb-0">
                                                    {{ user.surname }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-muted mb-1">
                                            {{ user.email }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-muted mb-1">
                                            {{ user.role }}
                                        </p>
                                    </td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-link text-danger btn-sm btn-rounded"
                                            @click="deleteUser(user.id)"
                                        >
                                            Izbrisi
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            v-if="user.role !== 'admin'"
                                            type="button"
                                            class="btn btn-link text-success btn-sm btn-rounded"
                                            data-bs-toggle="modal"
                                            :data-bs-target="
                                                '#exampleModal' + user.id
                                            "
                                        >
                                            Promoviraj
                                        </button>
                                        <button
                                            v-else
                                            type="button"
                                            class="btn btn-link text-success btn-sm btn-rounded text-decoration-line-through"
                                            data-bs-toggle="modal"
                                            :data-bs-target="
                                                '#exampleModal' + user.id
                                            "
                                            disabled
                                        >
                                            Promoviraj
                                        </button>
                                        <div
                                            class="modal fade"
                                            :id="'exampleModal' + user.id"
                                            tabindex="-1"
                                            aria-labelledby="exampleModalLabel"
                                            aria-hidden="true"
                                        >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1
                                                            class="modal-title fs-5"
                                                            id="exampleModalLabel"
                                                        >
                                                            Promoviraj korisnika
                                                        </h1>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Dodaj korisnika
                                                        <span
                                                            class="fw-muted fw-bold"
                                                            >{{ user.name }}
                                                            {{
                                                                user.surname
                                                            }}</span
                                                        >
                                                        kao administratora?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Zatvori
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-primary"
                                                            @click="
                                                                promoteUser(
                                                                    user.id
                                                                )
                                                            "
                                                        >
                                                            Potvrdi
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="accordion-item" :class="{ 'disabled': isDisabled }">
                <h2 class="accordion-header">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo"
                        aria-expanded="false"
                        aria-controls="flush-collapseTwo"
                    >
                        Pregled svih kategorija
                    </button>
                </h2>
                <div
                    id="flush-collapseTwo"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample"
                >
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 bg-white">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID Kategorije</th>
                                        <th>Ime</th>
                                        <th>Dodao/la</th>
                                        <th>Opcije</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="category in categories"
                                        :key="category.id"
                                    >
                                        <td>
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">
                                                        {{ category.id }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ category.name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ category.user.name }}
                                            </p>
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-link text-danger btn-sm btn-rounded"
                                                @click="
                                                    deleteCategory(category.id)
                                                "
                                            >
                                                Izbrisi
                                            </button>
                                        </td>
                                       
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item" :class="{ 'disabled': isDisabled }">
                <h2 class="accordion-header">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree"
                        aria-expanded="false"
                        aria-controls="flush-collapseThree"
                    >
                        Pregled artikala
                    </button>
                </h2>
                <div
                    id="flush-collapseThree"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample"
                >
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 bg-white">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID artikla</th>
                                        <th>Ime</th>
                                        <th>Opis</th>
                                        <th>Veličina</th>
                                        <th>Cijena</th>
                                        <th>Kategorija</th>
                                        <th>Namjenjeno</th>
                                        <th>Dodao/la</th>
                                        <th>Izbrisi</th>
                                        <th>Uredi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="product in products"
                                        :key="product.id"
                                    >
                                        <td>
                                            <div
                                                class="d-flex align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">
                                                        {{ product.id }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.description }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.size }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.price }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.category.name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.gender.name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p
                                                class="fw-normal text-muted mb-1"
                                            >
                                                {{ product.user.name }}
                                            </p>
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-link text-danger btn-sm btn-rounded"
                                                @click="
                                                    deleteProduct(product.id)
                                                "
                                            >
                                                Izbrisi
                                            </button>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-link text-primary"
                                                data-bs-toggle="modal"
                                                :data-bs-target="
                                                    '#exampleModal4' +
                                                    product.id
                                                "
                                                data-bs-whatever="@mdo"
                                                @click="
                                                    updateProductItem(product)
                                                "
                                            >
                                                Uredi
                                            </button>
                                            <div
                                                class="modal fade"
                                                :id="
                                                    'exampleModal4' + product.id
                                                "
                                                tabindex="-1"
                                                :aria-labelledby="
                                                    'exampleModalLabel' +
                                                    product.id
                                                "
                                                aria-hidden="true"
                                            >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div
                                                            class="modal-header"
                                                        >
                                                            <h1
                                                                class="modal-title fs-5"
                                                                :id="
                                                                    '#exampleModal4' +
                                                                    product.id
                                                                "
                                                            >
                                                                Uredi artikl
                                                            </h1>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form @submit.prevent="urediArtikl(product.id)">
                                                                <div
                                                                    class="mb-3"
                                                                >
                                                                    <label
                                                                        for="recipient-name"
                                                                        class="col-form-label"
                                                                        >Ime
                                                                        artikla:</label
                                                                    >
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        id="recipient-name"
                                                                        v-model="
                                                                            updateProduct.name
                                                                        "
                                                                        required
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="mb-3"
                                                                >
                                                                    <label
                                                                        for="message-text"
                                                                        class="col-form-label "
                                                                        >Opis
                                                                        artikla:</label
                                                                    >
                                                                    <textarea
                                                                        class="form-control"
                                                                        id="message-text"
                                                                        v-model="
                                                                            updateProduct.description
                                                                        "
                                                                        required
                                                                    ></textarea>
                                                                </div>
                                                                <div
                                                                    class="mb-3"
                                                                >
                                                                    <label
                                                                        for="recipient-name"
                                                                        class="col-form-label"
                                                                        >Velicina
                                                                        artikla:</label
                                                                    >
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        id="recipient-name"
                                                                        v-model="
                                                                            updateProduct.size
                                                                        "
                                                                        required
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="mb-3"
                                                                >
                                                                    <label
                                                                        for="recipient-name"
                                                                        class="col-form-label"
                                                                        >Cijena
                                                                        artikla:</label
                                                                    >
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        id="recipient-name"
                                                                        v-model="
                                                                            updateProduct.price
                                                                        "
                                                                        required
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="mt-3"
                                                                >
                                                                    <label
                                                                        for="trainSelect"
                                                                        class="col-form-label"
                                                                        >Kategorija
                                                                        artikla</label
                                                                    >
                                                                    <select
                                                                        class="form-select"
                                                                        id="trainSelect"
                                                                        aria-label="Default select example"
                                                                        v-model="
                                                                            updateProduct.category_id
                                                                        "
                                                                        required
                                                                    >
                                                                        <option
                                                                            disabled
                                                                            value=""
                                                                        >
                                                                            Kategorija
                                                                            artikla
                                                                        </option>
                                                                        <option
                                                                            v-for="category in categories"
                                                                            :value="
                                                                                category.id
                                                                            "
                                                                        >
                                                                            {{
                                                                                category.name
                                                                            }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div
                                                                    class="mt-3"
                                                                >
                                                                    <label
                                                                        for="trainSelect"
                                                                        class="col-form-label"
                                                                        >Namjenjeno
                                                                        za:</label
                                                                    >
                                                                    <select
                                                                        class="form-select"
                                                                        id="trainSelect"
                                                                        aria-label="Default select example"
                                                                        v-model="
                                                                            updateProduct.gender_id
                                                                        "
                                                                        required
                                                                    >
                                                                        <option
                                                                            disabled
                                                                            value=""
                                                                        >
                                                                            Odaberi
                                                                        </option>
                                                                        <option
                                                                            v-for="gender in genders"
                                                                            :value="
                                                                                gender.id
                                                                            "
                                                                        >
                                                                            {{
                                                                                gender.name
                                                                            }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div
                                                                    class="mt-3 mb-3"
                                                                >
                                                                    <label
                                                                        for="formFileSm"
                                                                        class="form-label"
                                                                        >Slika
                                                                        artikla
                                                                    </label>
                                                                    <input
                                                                        class="form-control form-control-sm"
                                                                        id="formFileSm"
                                                                        type="file"
                                                                        @change="
                                                                            imageChangeUpdate
                                                                        "
                                                                        required
                                                                    />
                                                                </div>
                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-primary w-100"
                                                                >
                                                                    Potvrdi
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div
                                                            class="modal-footer"
                                                        >
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary w-100"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Zatvori
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="exampleModal10"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Dodaj kategoriju
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addCategory()" method="POST">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label"
                                >Ime kategorije:</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="recipient-name"
                                v-model="category.name"
                                required
                            />
                        </div>
                        <button type="submit" class="btn custom-btn w-100">
                            Potvrdi
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        data-bs-dismiss="modal"
                        class="btn btn-secondary w-100"
                    >
                        Zatvori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="exampleModal20"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Dodaj artikl
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addProduct()" method="POST">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label"
                                >Ime artikla:</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="recipient-name"
                                required
                                v-model="product.name"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label"
                                >Opis artikla:</label
                            >
                            <textarea
                                class="form-control"
                                id="message-text"
                                required
                                v-model="product.description"
                            ></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label"
                                >Veličina artikla:</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="recipient-name"
                                required
                                v-model="product.size"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label"
                                >Cijena artikla:</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="recipient-name"
                                required
                                v-model="product.price"
                            />
                        </div>
                        <div class="mt-3">
                            <label for="trainSelect" class="col-form-label"
                                >Kategorija artikla</label
                            >
                            <select
                                class="form-select"
                                id="trainSelect"
                                aria-label="Default select example"
                                v-model="product.category_id"
                                required
                            >
                                <option disabled value="">
                                    Kategorija artikla
                                </option>
                                <option
                                    v-for="category in categories"
                                    :value="category.id"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="trainSelect" class="col-form-label"
                                >Namjenjeno za:</label
                            >
                            <select
                                class="form-select"
                                id="trainSelect"
                                aria-label="Default select example"
                                v-model="product.gender_id"
                                required
                            >
                                <option disabled value="">Odaberi</option>
                                <option
                                    v-for="gender in genders"
                                    :value="gender.id"
                                >
                                    {{ gender.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="formFileSm" class="form-label"
                                >Slika artikla
                            </label>
                            <input
                                class="form-control form-control-sm"
                                id="formFileSm"
                                type="file"
                                @change="imageChange"
                                required
                            />
                        </div>
                        <button
                            type="submit"
                            class="btn custom-btn mt-3 w-100"
                        >
                            Potvrdi
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary w-100"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>


    <Footer />
</template>

<script>
import axios from "axios";


export default {
    data() {
        return {
            users: [],
            message: "",
            category: {
                name: "",
            },
            genders: [],
            categories: [],
            product: {
                name: "",
                description: "",
                size: "",
                price: "",
                category_id: "",
                gender_id: "",
                image: "",
            },
            products: [],
            updateProduct: {
                name: "",
                description: "",
                size: "",
                price: "",
                category_id: "",
                gender_id: "",
                image: "",
            },
            productId: null,
            isUserLogin:false,
            isDisabled:false,
            user:[],
        };
    },
    
    
    created() {
        this.getUsers();
        this.getCategory();
        this.getGender();
        this.getProduct();
        this.isUserLogged();
        this.getUser();
    },
    methods: {
        getUsers() {
            axios
                .get("/getUsers")
                .then((response) => {
                    this.users = response.data.users;
                    console.log(this.users);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteUser(id) {
            axios
                .post(`/deleteUser/${id}`)
                .then((response) => {
                    this.message = response.data.message;
                    this.getUsers();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        promoteUser(id) {
            axios
                .post(`/promoteUser/${id}`)
                .then((response) => {
                    this.message = response.data.message;
                    $("#exampleModal" + id).modal("hide");
                    this.getUsers();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addCategory() {
            const Category = {
                name: this.category.name,
            };
            axios
                .post("/addCategory", Category)
                .then((response) => {
                    this.message = response.data.message;
                    $("#exampleModal10").modal("hide");
                    this.getCategory();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCategory() {
            axios
                .get("/getCategory")
                .then((response) => {
                    this.categories = response.data.category;
                    console.log(this.categories);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteCategory(id) {
            axios
                .post(`/deleteCategory/${id}`)
                .then((response) => {
                    this.message = response.data.message;
                    this.getCategory();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getGender() {
            axios
                .get("/getGender")
                .then((response) => {
                    this.genders = response.data.gender;
                    console.log(this.genders);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        imageChange(event) {
            this.product.image = event.target.files[0];
        },
        

        addProduct() {
            const Product = new FormData();
            Product.append("name", this.product.name);
            Product.append("description", this.product.description);
            Product.append("size", this.product.size);
            Product.append("price", this.product.price);
            Product.append("category_id", this.product.category_id);
            Product.append("gender_id", this.product.gender_id);
            Product.append("image", this.product.image);

            axios
                .post("/addProduct", Product)
                .then((response) => {
                    this.message = response.data.message;
                    this.getProduct();
                    $("#exampleModal20").modal("hide");
                    this.product = {
                        name: "",
                        description: "",
                        size: "",
                        price: "",
                        category_id: "",
                        gender_id: "",
                        image: "",
                    };
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                });
        },

        getProduct() {
            axios
                .get("/getProduct")
                .then((response) => {
                    this.products = response.data.product;
                    console.log(this.products);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteProduct(id) {
            axios
                .post(`/deleteProduct/${id}`)
                .then((response) => {
                    this.message = response.data.message;
                    this.getProduct();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateProductItem(product) {
            this.productId = product.id;
            this.updateProduct.name = product.name;
            this.updateProduct.description = product.description;
            this.updateProduct.size = product.size;
            this.updateProduct.price = product.price;
            this.updateProduct.category_id = product.category_id;
            this.updateProduct.gender_id = product.gender_id;
            this.updateProduct.image = product.image;
            $("#exampleModal20" + product.id).modal("show");
        },

        urediArtikl(id) {
            let updateProductItem = new FormData();
            updateProductItem.append("name", this.updateProduct.name);
            updateProductItem.append("description", this.updateProduct.description);
            updateProductItem.append("size", this.updateProduct.size);
            updateProductItem.append("price", this.updateProduct.price);
            updateProductItem.append("category_id", this.updateProduct.category_id);
            updateProductItem.append("gender_id", this.updateProduct.gender_id);
            updateProductItem.append("image", this.updateProduct.image);

            axios
                .post(`/updateProduct/${id}`, updateProductItem)
                .then((response) => {
                    this.message = response.data.message;

                    const product = response.data.product;
                    const index = this.products.findIndex(
                        (product) => product.id === this.productId
                    );
                    if (index !== -1) {
                        this.products[index].name = product.name;
                        this.products[index].description = product.description;
                        this.products[index].size = product.size;
                        this.products[index].price = product.price;
                        this.products[index].category_id = product.category_id;
                        this.products[index].gender_Id = product.gender_id;
                        this.products[index].image = product.image;
                    }
                    this.getProduct();
                });
            $("#exampleModal20" + this.productId).modal("hide");
        },

        imageChangeUpdate(event) {
            this.updateProduct.image = event.target.files[0];
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
                        this.isDisabled = true;
                    }

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
    },
};
</script>

<style>
.container{
    
}

.disabled{
    pointer-events: none;
}
.custom-btn {
        background-color: #ff26c2; 
        color: #ffffff;
}
.custom-btn:active,
.custom-btn:hover {
        background-color: #ff26c2; 
        color: #ffffff; 
}
.accordion-item {
    --bs-accordion-active-bg: #ff26c2;
    --bs-accordion-active-color: #ffffff; 
    
    --bs-accordion-btn-focus-box-shadow: #ff26c2;
    
}

</style>
