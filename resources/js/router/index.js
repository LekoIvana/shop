import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Man from '../views/Man.vue'
import Admin from '../views/Admin.vue'
import Kid from '../views/Kid.vue'
import Woman from '../views/Woman.vue'
import Cart from '../views/Cart.vue'
import SearchResult from '../views/SearchResult.vue'
import Home from '../views/Home.vue'


import store from '../store/index';



const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [

        {
            path: '/mens',
            name: 'mens',
            component: Man
        },

        {
            path: '/register',
            name: 'register',
            component: Register
        },

        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            /* beforeEnter(to, from, next) {
                // Dobijte loggedInUser iz Vašeg Vuex store-a pomoću gettera
                const loggedInUser = store.getters.loggedInUser;
                
                // Provjerite je li loggedInUser null
                if (loggedInUser.role === "korisnik") {
                  // Ako jest, korisnik nije prijavljen, pa ga preusmjerite na željenu rutu 
                  window.location.href = 'https://www.google.com';
                } else {
                  // Inače, korisnik je prijavljen, pa dopustite pristup košarici
                  next();
                }
              }*/
        },
        {
            path: '/kids',
            name: 'kid',
            component:  Kid
        },

        {
            path: '/womens',
            name: 'woman',
            component: Woman
        },
        {
            path: '/cart',
            name: 'cart',
            component:Cart,
            /*beforeEnter(to, from, next) {
                // Dobijte loggedInUser iz Vašeg Vuex store-a pomoću gettera
                const loggedInUser = store.getters.loggedInUser;
                
                // Provjerite je li loggedInUser null
                if (loggedInUser === null) {
                  // Ako jest, korisnik nije prijavljen, pa ga preusmjerite na željenu rutu 
                  window.open('https://www.google.com', '_blank');
                } else {
                  // Inače, korisnik je prijavljen, pa dopustite pristup košarici
                  next();
                }
              }*/
            
        },
        {
            path: '/searchResult',
            name: 'searchResult',
            component:SearchResult
        },
        {
            path: '/',
            name: 'home',
            component:Home
        },
        
        

    ]
});

  


export default router
