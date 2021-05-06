<template>
    <div>

        <Nav/>

        <h5>{{ message }}</h5>

        <hr>

        <b-container class="mt-3">
            <b-row>
                <router-view/>
            </b-row>
        </b-container>

    </div>
</template>
<script>

import Nav from "./components/Nav";

//const default_layout = 'default';

export default {
    components: {
        Nav
    },
    computed: {},
    data() {
        return {
            message: 'Appuser panel',
        }
    },
}

</script>



