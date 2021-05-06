<!--<template src="./main.html">
</template>-->

<template>
    <b-container>

        <b-row>
            <b-col>
                <h4>Userprofile</h4>
                <h5>Profile Id: {{ $route.params.id }}</h5>
            </b-col>
        </b-row>

        <b-row>
            <b-col>
                <FormUpload
                    :user_id="$route.params.id"
                ></FormUpload>

            </b-col>
        </b-row>

    </b-container>
</template>

<script>

import FormUpload from "./components/FormUpload";

export default {
    name: 'Userprofile',
    components: {
        FormUpload
    },

    methods: {

        /*uploadImage(event) {

            console.log(event);

            let api_url = 'api/v1/upload';
            let data = new FormData();
            data.append('name', 'my-picture');
            data.append('file', event.target.files[0]);

            let config = {
                header: {
                    'Content-Type': 'image/png'
                }
            }

            axios.put(api_url,{
                    data,
                    config
                })
                .then(response => {
                    console.log('image upload response > ', response)
                })
                .catch(err => {
                    console.log(err);
                    this.errored = true;
                })
                .finally(() => this.loading = false);
        },*/


    }
}

</script>
