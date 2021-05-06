import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'
import List from "../views/List"
import Profile from '../views/Profile'

Vue.use(VueRouter)

const routeradmin = new VueRouter({
    mode: 'history',
    routes: [
        /*{
            path: '/',
            name: 'home',
            component: Home,
        },*/
        {
            path: '/',
            name: 'list',
            component: List,
        },
        {
            path: '/profile/:id',
            name: 'profile',
            component: Profile,
        },
        /*
        {
            path: '/about',
            name: 'about',
            component: () => import('../views/About'),
        },
        {
            path: '/admin',
            name: 'admin',
            component: () => import('../views/admin/AdminHome'),
        },*/
    ],
    linkActiveClass: 'active'
})

export default routeradmin;
