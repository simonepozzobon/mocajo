<template lang="html">
    <div>
        <h1 class="pt-3">{{ title }}</h1>
        <hr>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'PageTemplate',
    props: {
        title: {
            type: String,
            default: 'titolo'
        }
    }
}
</script>

<style lang="css" scoped>
</style>
