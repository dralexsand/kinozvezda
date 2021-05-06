<!--<template src="./main.html">
</template>-->

<template>
    <b-container>

        <h4>Userprofile</h4>
        <h5>Profile Id: {{ $route.params.id }}</h5>

        <b-row>
            <b-col>

                <form class="cabinet-file-list">


                    <h3>Photo</h3>


                    <input type="file" accept="image/*" @change="uploadImage($event)" id="file-input">


                </form>


            </b-col>
        </b-row>

    </b-container>
</template>

<script>

export default {
    name: 'Userprofile1',


    methods: {

        uploadImage(event) {

            console.log(event);

            let api_url = '/api/v1/upload';
            let data = new FormData();
            data.append('name', 'my-picture');
            data.append('file', event.target.files[0]);

            let config = {
                header: {
                    'Content-Type': 'image/png'
                }
            }

            console.log(data);

            axios.post(api_url, {
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


        }
    }
}

</script>
