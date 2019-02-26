<template lang="html">
    <div>
        <panel-block :title="title">
            <slot></slot>
        </panel-block>
        <hr>
    </div>
</template>

<script>
import PanelBlock from './PanelBlock.vue'

export default {
    name: 'GeneralSection',
    components: {
        PanelBlock,
    },
    props: {
        title: {
            type: String,
            default: 'Titolo'
        },
    }
}
</script>

<style lang="css" scoped>
</style>
