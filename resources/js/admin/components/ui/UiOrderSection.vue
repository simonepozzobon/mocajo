<template lang="html">
    <div class="row">
        <ui-order-title :title="title" />
        <ui-order-div />
        <slot></slot>
    </div>
</template>

<script>
import UiOrderDiv from './UiOrderDiv.vue'
import UiOrderTitle from './UiOrderTitle.vue'

export default {
    name: 'UiOrderSection',
    components: {
        UiOrderDiv,
        UiOrderTitle,
    },
    props: {
        title: {
            type: String,
            default: 'Titolo'
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
