import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            loginMessage: "",
            isLoggedIn: JSON.parse(localStorage.getItem("isLoggedIn")) || false,
            loggedInUser:
                JSON.parse(localStorage.getItem("loggedInUser")) || null,
            cartItems: [],
        };
    },
    mutations: {
        setLoginMessage(state, message) {
            state.loginMessage = message;
        },
        clearLoginMessage(state) {
            state.loginMessage = "";
        },
        setLoggedInUser(state, user) {
            state.loggedInUser = user;
            localStorage.setItem("loggedInUser", JSON.stringify(user));
        },
        setIsLoggedIn(state, isLoggedIn) {
            state.isLoggedIn = isLoggedIn;
            localStorage.setItem("isLoggedIn", isLoggedIn);
        },
        logout(state) {
            state.loggedInUser = null;
            localStorage.removeItem("loggedInUser");
        },
        addToCart(state, product) {
            state.cartItems.push(product);
        },
        removeFromCart(state, productId) {
            state.cartItems = state.cartItems.filter(
                (item) => item.id !== productId
            );
        },
        clearCart(state) {
            state.cartItems = [];
        },
    },
    actions: {
        setLoginMessage({ commit }, message) {
            commit("setLoginMessage", message);
        },
        clearLoginMessage({ commit }) {
            commit("clearLoginMessage");
        },
        login({ commit }, user) {
            commit("setLoggedInUser", user);
            commit("setIsLoggedIn", true);
        },
        logout({ commit }) {
            commit("setLoggedInUser", null);
            commit("setIsLoggedIn", false);
        },

    },
    getters: {
        loggedInUser(state) {
            return state.loggedInUser;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        cartItemCount: state => state.cartItems.length,
    },
});

export default store;
