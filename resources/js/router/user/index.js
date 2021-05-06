import Vue from 'vue'
import VueRouter from 'vue-router'
import Userprofile from '../../views/Userprofile'

Vue.use(VueRouter)

const routeruser = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'userprofile',
            component: Userprofile,
        },
        /*{
            path: '/profile/:id',
            name: 'profile',
            component: Profile,
        },*/
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

export default routeruser;
