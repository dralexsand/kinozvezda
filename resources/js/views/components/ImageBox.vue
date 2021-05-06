<template>
    <div>
        <img
            :src="src_image"
            :width="w_image"
            :alt="description_image"
        />
    </div>
</template>

<script>
export default {
    name: 'ImageBox',
    props: {
        'src_image': '',
        'w_image': '',
        'description_image': '',
    },
}
</script>
