<template lang="html">
    <h2 class="ui-title">{{ title }}</h2>
</template>

<script>
export default {
    name: 'UiTitle',
    props: {
        title: {
            type: String,
            default: null
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-title {
    margin-bottom: $spacer * 2;
    text-transform: capitalize;
    letter-spacing: 2px;
}
</style>
