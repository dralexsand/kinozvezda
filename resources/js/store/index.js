import Vue from "vue";
import Vuex from 'vuex';

import filter from './modules/filter'

/*import cars from './modules/cars'
import orders from './modules/orders'
import filters from './modules/filters'
import filterspost from './modules/filterspost'*/

import 'es6-promise/auto';

Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    modules: {
        filter,
        /*cars,
        orders,
        filters,
        filterspost*/
    }
});
