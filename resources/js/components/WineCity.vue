<template lang="html">
    <div class="wine-city">
        <h4>{{ city.name }}</h4>
        <wine-shop
            v-for="shop in this.city.shops"
            :key="shop.id"
            :shop="shop"/>
    </div>
</template>

<script>
import WineShop from './WineShop.vue'
export default {
    name: 'WineCity',
    components: {
        WineShop,
    },
    props: {
        city: {
            type: Object,
            default: function() {}
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.wine-city {
    margin-bottom: $spacer * 2;
}
</style>
