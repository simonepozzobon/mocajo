<template lang="html">
    <div>
        <ui-subtitle
            :title="shop.name"
            :no-margin="true"/>
        <p>{{ shop.address }}</p>
    </div>
</template>

<script>
import { UiSubtitle } from './ui'
export default {
    name: 'WineShop',
    components: {
        UiSubtitle,
    },
    props: {
        shop: {
            type: Object,
            default: function() {}
        }
    }
}
</script>

<style lang="css" scoped>
</style>
