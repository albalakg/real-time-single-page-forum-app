import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import Signup from '../components/login/signup'
import Read from '../components/forum/read'
import Create from '../components/forum/create'
import Forum from '../components/forum/forum'
import Category from '../components/category/createCategory'
import Logout from '../components/login/logout'

const routes = [{
        path: '/login',
        component: Login
    },
    {
        path: '/logout',
        component: Logout
    },
    {
        path: '/signup',
        component: Signup
    },
    {
        path: '/forum',
        component: Forum,
        name: 'forum'
    },
    {
        path: '/question/:slug',
        component: Read,
        name: 'read'
    },
    {
        path: '/ask',
        component: Create
    },
    {
        path: '/category',
        component: Category
    },
]



const router = new VueRouter({
    routes, // short for `routes: routes`
    hasbang: false,
    mode: 'history'
})

export default router
