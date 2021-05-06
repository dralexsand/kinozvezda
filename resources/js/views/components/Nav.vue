<template>
    <nav class="one">
        <ul>
            <li>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click.prevent="$router.push({ name: 'list' })"
                >
                    На Главную
                </button>
            </li>

        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Nav'
}
</script>

<style scoped>

ul {
    list-style: none;
    margin: 0 auto;
}

a {
    text-decoration: none;
    font-family: 'Lora', serif;
    transition: .5s linear;
}

i {
    margin-right: 10px;
}

nav {
    display: block;
    width: 660px;
    margin: 0 auto 30px;
}

.one ul {
    padding: 1em 0;
}

.one a {
    padding: 1em;
    background: rgba(177, 152, 145, .3);
    border-right: 1px solid #b19891;
    color: #695753;
}

.one li {
    display: inline;
}

</style>
