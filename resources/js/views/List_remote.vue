<template>
    <b-container class="w-100">
        {{ message }}

        <hr>

        <b-row>

            <b-col>
                <select v-model="gender_value">
                    <option disabled value="">Выберите один из вариантов</option>
                    <option>male</option>
                    <option>female</option>
                </select>
                <br>
                <span>Выбрано: {{ gender_value }}</span>
            </b-col>

            <b-col>
                <input v-model="age_value" placeholder="Возраст">
                <p>Введённое сообщение: {{ age_value }}</p>
            </b-col>

            <b-col>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click.prevent="getPosts()"
                >
                    Apply
                </button>
            </b-col>

        </b-row>

        <hr>

        <div v-if="errored" class="alert alert-danger" role="alert">
            No records
        </div>

        <b-container v-else>

            <div v-if="loading">Loading...</div>

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

            <b-row>

                <b-col v-for="post in posts" :key="post.id">

                    <CardBox
                        :card_title="post.last_name + ' ' + post.first_name"
                        :card_img_src="post.photos[0]['path']"
                        :card_img_alt="post.last_name + ' ' + post.first_name"
                        :card_tag="post.last_name + ' ' + post.first_name"
                        :card_description="post.gender + ', ' + post.age"
                        :link="'/profile/' + post.user_id"
                        :linkuser="'/userprofile/' + post.user_id"
                    ></CardBox>

                </b-col>

            </b-row>

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

    </b-container>
</template>
<script>

//const default_layout = 'default';


import ImageBox from './components/ImageBox';
import CardBox from "./components/CardBox";

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

            card_title: "Card Title",
            card_img_src: "/upload/images/2021/04/07/image_f_10.jpg",
            card_img_alt: "Actor alt",
            card_tag: 'Actor tag',
            card_description: 'Mybsio Rexxwruno',

            message: 'Kinozvezda',
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
                "gender": this.gender_value
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
