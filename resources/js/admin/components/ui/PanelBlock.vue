<template lang="html">
    <div>
        <h3>{{ title }}</h3>
        <div class="p-4">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PanelBlock',
    props: {
        title: {
            type: String,
            default: 'titolo'
        }
    }
}
</script>

<style lang="scss">
</style>
