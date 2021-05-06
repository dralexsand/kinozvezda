<template>
    <div class="card" style="width: 18rem;">

        <img
            :src="card_img_src"
            class="card-img-top"
            :alt="card_img_alt"
            width="50"
        />
        <div class="card-body">

            <h5 class="card-title">{{ card_title }}</h5>

            <p class="card-text">
                {{ card_description }}
            </p>

            <!--            <router-link
                            :to="link"
                        >
                            {{ card_tag }}
                        </router-link>-->

            <button
                type="button"
                class="btn btn-primary"
                @click.prevent="$router.push(link)"
            >
                Profile {{ card_title }}
            </button>

            <hr>

            <button
                type="button"
                class="btn btn-primary"
                @click.prevent="$router.push(linkuser)"
            >
                User Profile
            </button>

        </div>

    </div>
</template>

<script>

export default {
    name: 'CardBox',
    props: {
        'card_title': '',
        'card_img_src': '',
        'card_img_alt': '',
        'card_tag': '',
        'card_description': '',
        'link': '',
        'linkuser': '',
    },
    methods: {
        goTo(id) {

            this.$router.push(id);
        },
        goToUserProfile(id) {

            this.$router.push(id);
        },
    }
}

</script>
