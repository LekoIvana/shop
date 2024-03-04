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
            component: Admin
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
            component:Cart
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
        }

    ]
})


export default router
