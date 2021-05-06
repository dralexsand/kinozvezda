import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'
import List from "../views/List"
import Profile from '../views/Profile'
import Userprofile from "../views/Userprofile";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
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
        {
            path: '/userprofile/:id',
            name: 'userprofile',
            component: Userprofile,
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

export default router;
