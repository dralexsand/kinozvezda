require('./bootstrap');

import Vue from 'vue'
import App from './views/app.vue'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import router from './router/admin';
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
    el: '#app',
    router,
    store,
    axios,
    render: h => h(App)
    //components: {App, BootstrapVue, IconsPlugin}
});


