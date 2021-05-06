<template>
    <b-container class="w-100">
        {{ message }}

        <hr>

        <!--        <b-table :items="items" :fields="fields">
                    <template #table-caption>This is a table caption.</template>
                </b-table>-->

        <div v-if="errored" class="alert alert-danger" role="alert">
            No records
        </div>


        <table v-else class="table">

            <div v-if="loading">Loading...</div>

            <thead>
            <tr>
                <th>User Id</th>
                <th>Gender</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>

            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.user_id }}</td>
                <td>{{ post.gender }}</td>
                <td>{{ post.last_name }}</td>
                <td>{{ post.first_name }}</td>
                <td>{{ post.age }}</td>
                <td>
                    <button class="btn btn-success">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>

            </tbody>

        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li
                    :class="{disabled: !pagination.prev_page_url}"
                    @click.prevent="getPosts(pagination.prev_page_url)"
                    class="page-item">
                    <a
                        aria-label="Previous"
                        class="page-link"
                        href=""
                    >
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li
                    class="page-item disabled">
                    <a class="page-link" href="">
                        Page is {{ pagination.current_page }} of {{ pagination.last_page }}
                    </a>
                </li>

                <li
                    :class="{disabled: !pagination.next_page_url}"
                    @click.prevent="getPosts(pagination.next_page_url)"
                    class="page-item">
                    <a
                        aria-label="Next"
                        class="page-link"
                        href=""
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>

            </ul>
        </nav>


    </b-container>
</template>
<script>

//const default_layout = 'default';

export default {
    name: 'Home',
    computed: {},
    data() {
        return {
            message: 'Home page',
            /*fields: ['first_name', 'last_name', 'age'],
            items: [
                {age: 40, first_name: 'Dickerson', last_name: 'Macdonald'},
                {age: 21, first_name: 'Larsen', last_name: 'Shaw'},
                {age: 89, first_name: 'Geneva', last_name: 'Wilson'}
            ],*/
            fields:
                [
                    'User Id', 'Gender',
                    'Last Name', 'First Name', 'Age',
                ],
            items: [],
            posts: [],
            post: {
                user_id: '',
                gender: '',
                last_name: '',
                first_name: '',
                age: '',
            },
            post_id: '',
            pagination: {},
            edit: false,
            loading: true,
            errored: false,
        }
    },

    created() {
        this.initData();
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

                    this.paginateTable(response.data.paging);
                    /*console.log('RESPONSE PAGINATION initData()');
                    console.log(response.data.paging);*/

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
                "age": 14
            };

            console.log('params');
            console.log(params);

            page_url = page_url || `api/v1/filter/avatars`;

            //page_url = page_url || '/api/v1/cars';

            /*axios
                .get(page_url)*/

            axios.post(page_url, {
                    params
                })
                .then(response => {

                    console.log('RESPONSE');
                    console.log(response);

                    let posts = response.data.data;
                    this.items = posts;
                    this.posts = posts;

                    this.paginateTable(response.data.paging);
                    console.log('RESPONSE PAGINATION getPosts()');
                    console.log(response.data.paging);
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
