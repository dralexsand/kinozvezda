require('./bootstrap');

import Vue from 'vue'
import App from './views/appuser.vue'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import routeruser from './router/user';
import store from './store';
import 'es6-promise/auto';

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueAxios, axios)
Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue({
    el: '#appuser',
    routeruser,
    store,
    axios,
    render: h => h(App)
    //components: {App, BootstrapVue, IconsPlugin}
});


