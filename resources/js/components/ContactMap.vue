<template lang="html">
    <ui-block
        ref="mapContainer"
        :full-height="true"
        :disable-padding="true">
        <div class="contact-map-multiselect">
            <multiselect
                v-model="value"
                :options="options"
                :searchable="true"
                :close-on-select="true"
                :show-labels="false"
                placeholder="Seleziona una città..."/>
        </div>
        <vl-map
            :load-tiles-while-animating="true"
            :load-tiles-while-interacting="true"
            data-projection="EPSG:4326"
            :style="'height: '+this.mapHeight+'px'">
            <vl-view
                :zoom.sync="zoom"
                :center.sync="center"
                :rotation.sync="rotation"/>

            <vl-layer-tile id="osm">
                <vl-source-osm/>
            </vl-layer-tile>

            <vl-feature
                v-for="(shop, i) in shops"
                :key="shop.id">
                <vl-geom-point :coordinates="[parseFloat(shop.lng), parseFloat(shop.lat)]"></vl-geom-point>
                <vl-style-box @click.native="showShopDetail">
                    <vl-style-icon src="/svg/pin.svg" :scale="0.2" :anchor="[1, 1]"></vl-style-icon>
                </vl-style-box>
            </vl-feature>

        </vl-map>
    </ui-block>
</template>

<script>
import Multiselect from 'vue-multiselect'
import { UiBlock } from '../components/ui'
import 'vue-multiselect/dist/vue-multiselect.min.css'

export default {
    name: 'ContactMap',
    components: {
        Multiselect,
        UiBlock,
    },
    data: function() {
        return {
            zoom: 13,
            center: [ 9.19131164549529, 45.461118675626096 ],
            rotation: 0,
            mapHeight: 0,
            value: '',
            options: [],
            shops: [],
        }
    },
    watch: {
        '$root.window': function(value) {
            this.setMapHeight()
        },
        '$root.cities': function(cities) {
            this.formatCities(cities)
        },
        value: function(value) {
            let idx = this.$root.cities.findIndex(item => item.name == value)
            if (idx > -1) {
                let city = this.$root.cities[idx]
                this.center = [parseFloat(city.lng), parseFloat(city.lat)]
            }
        }
    },
    methods: {
        formatCities: function(cities) {
            for (let i = 0; i < cities.length; i++) {
                this.options.push(cities[i].name)
                for (let j = 0; j < cities[i].shops.length; j++) {
                    let item = cities[i].shops[j]
                    let shop = {
                        ...item,
                        coordinates: [parseFloat(item.lng).toFixed(15), parseFloat(item.lat).toFixed(15)]
                    }
                    this.shops.push(shop)
                }
            }
            this.setMapHeight()
        },
        setMapHeight: function() {
            let map = this.$refs.mapContainer.$el.getBoundingClientRect()
            this.mapHeight = map.height
        },
        showShopDetail: function() {
            alert('ciao')
        }
    },
    mounted: function() {
        this.setMapHeight()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.contact-map-multiselect {
    position: absolute;
    top: $spacer;
    left: 50%;
    width: 80%;
    min-height: $spacer;
    transform: translateX(-50%);
    background-color: $white;
    z-index: 1;
}

.contact-map-select {
    position: absolute;
    bottom: $spacer;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
}
</style>
