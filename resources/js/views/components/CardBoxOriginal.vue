<div>
<b-card
    :title="card_title"
    :img-src="card_img_src"
    :img-alt="card_img_alt"
    img-top
    :tag="card_tag"
    style="max-width: 20rem;"
    class="mb-2"
>
    <b-card-text>
        {{ card_description }}
    </b-card-text>

    <b-button href="#" variant="primary">Go somewhere</b-button>
</b-card>
</div>

<script>

export default {
    name: 'CardBoxOriginal',
    props: {
        'card_title': '',
        'card_img_src': '',
        'card_img_alt': '',
        'card_tag': '',
        'card_description': '',
    },
}

</script>
