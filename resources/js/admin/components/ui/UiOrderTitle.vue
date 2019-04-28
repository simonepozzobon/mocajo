<template lang="html">
    <div class="mt-4 col col-md-12">
        <h3>{{ title }}</h3>
    </div>
</template>

<script>

export default {
    name: 'UiOrderTitle',
    props: {
        title: {
            type: String,
            default: 'Titolo'
        }
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
