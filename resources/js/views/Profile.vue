<template>
    <div>
        <h4>Profile Id: {{ $route.params.id }}</h4>

        <hr>

        <b-container>

            <b-row>
                <b-col>
                    Last Name:
                    <h3>{{ itemdata.last_name }}</h3>
                </b-col>
                <b-col>
                    First Name:
                    <h3> {{ itemdata.first_name }}</h3>
                </b-col>
                <b-col>
                    Email:
                    <h3> {{ itemdata.email }}</h3>
                </b-col>
            </b-row>

            <hr>

            <b-row>
                <b-col>
                    Gender:
                    <h3>{{ itemdata.gender }}</h3>
                </b-col>
                <b-col>
                    Birthday: <h3> {{ itemdata.birthday }}</h3>
                </b-col>
                <b-col>
                    Age:
                    <h3> {{ itemdata.age }}</h3>
                </b-col>
            </b-row>

            <hr>

            <b-row>
                <b-col>
                    <h3>Short Bio:</h3>
                    <p>{{ itemdata.short_bio }}</p>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <h3>Bio:</h3>
                    <p>{{ itemdata.bio }}</p>
                </b-col>
            </b-row>

            <hr>

            <b-row>

                <b-col v-for="photo in itemdata.photos" :key="photo.id">

                    <ImageBox
                        :src_image="photo.path"
                        :w_image="300"
                    ></ImageBox>

                </b-col>

            </b-row>

            <hr>

            <b-row>

                <b-col v-for="video in itemdata.videos" :key="video.id">

                    <h5>{{ video.genre }}</h5>

                    <iframe width="420" height="315"
                            :src="video.path"
                            frameborder="0"
                            allowfullscreen>
                    </iframe>


                </b-col>

            </b-row>

            <hr>


        </b-container>

    </div>
</template>

<script>

import ImageBox from "./components/ImageBox";

export default {
    name: 'Profile',
    components: {
        ImageBox
    },
    data() {
        return {
            itemdata: {
                user_id: '',
                gender: '',
                last_name: '',
                first_name: '',
                birthday: '',
                age: '',
                photos: [],
                videos: [],
                short_bio: '',
                bio: '',
                email: '',
            }
        }
    },
    created() {
        this.getPrifileData();
    },
    methods: {

        getPrifileData() {
            let page_url = `/api/v1/profile/` + this.$route.params.id;

            console.log('page_url');
            console.log(page_url);

            axios.get(page_url)

                .then(response => {

                    /*console.log('RESPONSE');
                    console.log(response);*/

                    let posts = response.data.data;
                    this.itemdata = posts[0];

                    console.log('RESPONSE INIT');
                    console.log(posts);

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
