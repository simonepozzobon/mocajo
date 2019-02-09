<template lang="html">
    <div class="collapse-header">
        <div class="button">
            +
        </div>
        <div class="title">
            {{ title }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'titolo'
        }
    }
}
</script>

<style lang="scss" >
@import '~styles/shared';

</style>
