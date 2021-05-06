import axios from 'axios'

const state = () => ({
    fdata: {}
})

// getters
const getters = {
    GET_FILTERDATA(state) {
        /*console.log('GET_filt');
        console.log(state.filt);*/
        console.log('GET_FILTERDATA');
        return state.fdata;
    },
}

// actions
const actions = {
    async SET_FILTER_ONLOAD_APPLY(context, payload) {
        console.log('SET_FILTER_ONLOAD_APPLY');

        await axios
            .post('/api/v1/filter', {
                payload
            })
            .then(response => {
                let data = response.data.data;
                console.log(data);
                context.commit('SET_FILTERDATA', data);

            })
            .catch(err => {
                console.log(err);
                this.errored = true;
            })
            .finally(() => console.log('SET_FILTER_ONLOAD_APPLY complete'));
    },
}

// mutations
const mutations = {
    SET_FILTERDATA(state, payload) {
        return state.fdata = payload;
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
