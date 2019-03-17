<template lang="html">
    <div class="mb-5">
        <ui-title
            title="Wine Shop"/>
        <wine-city
            v-for="city in this.cities"
            :key="city.id"
            :city="city"/>
    </div>
</template>

<script>
import { UiTitle } from './ui'
import WineCity from './WineCity.vue'
export default {
    name: 'WineShops',
    components: {
        UiTitle,
        WineCity,
    },
    data: function() {
        return {
            cities: [],
        }
    },
    watch: {
        '$root.cities': function(cities) {
            this.cities = cities
        }
    },
    methods: {
    }
}
</script>

<style lang="css" scoped>
</style>
