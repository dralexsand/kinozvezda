<template>
    <div>


        <input type="file" accept="image/*" @change=uploadImage>
        <button
            @click.prevent="applyUploadImage"
            type="button"
            class="btn btn-primary"
        >Send image
        </button>
        <img :src="previewImage" class="uploading-image" width="300"/>
    </div>
</template>

<script>
export default {
    props: {
        user_id: '',
    },
    name: 'ImageUpload',
    data() {
        return {
            previewImage: null,
            image_name: '',
            image_size: '',
            image_type: '',
        }
    },
    methods: {
        uploadImage(e) {
            const image = e.target.files[0];

            console.log('image');
            console.log(image);
            console.log(image.name);
            console.log(image.size);
            console.log(image.type);

            this.image_name = image.name;
            this.image_size = image.size;
            this.image_type = image.type;

            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.previewImage = e.target.result;
                console.log(this.previewImage);
            };
        },

        applyUploadImage() {

            console.log();

            let api_url = '/api/v1/upload';
            //let data = new FormData();
            let data = {
                'image': this.previewImage,
                'user': this.user_id,
                'image_name': this.image_name,
                'image_size': this.image_size,
                'image_type': this.image_type,
            };

            //data.append('name', 'uploaded_image');
            //data.append('file', event.target.files[0]);

            let config = {
                header: {
                    'Content-Type': 'image/png'
                }
            }

            axios.post(api_url, {
                    data,
                    //config
                })
                .then(response => {
                    console.log('image upload response > ', response);
                    this.updateProfile;
                })
                .catch(err => {
                    console.log(err);
                    this.errored = true;
                })
                .finally(() => this.loading = false);
        },
        updateProfile() {
            let url = '/userprofile/' + this.user_id;
            this.previewImage = null;
            this.$router.push(url);
        },

    },
}  // missing closure added
</script>


<style>
.uploading-image {
    display: flex;
}
</style>
