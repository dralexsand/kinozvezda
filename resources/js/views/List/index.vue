<template src="./main.html">
</template>

<script>

//const default_layout = 'default';

import ImageBox from "../components/ImageBox";
import CardBox from "../components/CardBox";

export default {
    name: 'List',
    components: {
        ImageBox, CardBox
    },
    computed: {},
    props: {},
    data() {
        return {
            age_value: '',
            gender_value: '',
            name_search: '',

            message: 'Фильтры поиска',
            items: [],
            posts: [],
            post: {
                user_id: '',
                gender: '',
                last_name: '',
                first_name: '',
                age: '',
                img: '',
                link: '',
            },
            post_id: '',
            pagination: {},
            edit: false,
            loading: true,
            errored: false,
        }
    },

    created() {
        //this.initData();
        this.getPosts();
    },

    methods: {
        paginateTable(response) {
            let pagination = {
                current_page: response.current_page,
                last_page: response.last_page,
                prev_page_url: response.prev_page_url,
                next_page_url: response.next_page_url,

                per_page: response.per_page,
                total: response.total
            }
            this.pagination = pagination;
            //console.log(this.pagination);
        },

        initData() {
            //this.$store.dispatch('filter/SET_FILTER_ONLOAD_APPLY');
            let params = {
                "age": 14
            };

            let page_url = `api/v1/filter/avatars`

            axios.post(page_url, {
                    params
                })
                .then(response => {

                    /*console.log('RESPONSE');
                    console.log(response);*/

                    let posts = response.data.data;
                    this.items = posts;
                    this.posts = posts;
                    this.paginateTable(response.data.data)
                    //this.paginateTable(response.data.data)
                    /*console.log('RESPONSE INIT');
                    console.log(posts);*/

                    this.paginateTable(response.data.pagination);
                    /*console.log('RESPONSE PAGINATION initData()');
                    console.log(response.data.pagination);*/

                })
                .catch(err => {
                    console.log(err);
                    this.errored = true;
                })
                .finally(() => this.loading = false);
        },

        getPosts(page_url) {

            //let params = this.$store.getters['filters/GET_FILT'];
            //let params = this.$store.getters['filter/GET_FILTERDATA'];

            let params = {
                "age": this.age_value,
                "gender": this.gender_value,
                "name_search": this.name_search,
            };


            console.log('params');
            console.log(params);

            page_url = page_url || `api/v1/filter/avatars`;

            axios.post(page_url, {
                    params
                })
                .then(response => {

                    console.log('RESPONSE');
                    console.log(response);

                    let posts = response.data.data;
                    this.items = posts;
                    this.posts = posts;

                    this.paginateTable(response.data.pagination);
                    console.log('RESPONSE PAGINATION getPosts()');
                    console.log(response.data.pagination);
                })
                .catch(err => {
                    console.log(err);
                    this.errored = true;
                })
                .finally(() => this.loading = false);
        },
    },
}

</script>
