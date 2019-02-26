<template lang="html">
    <div>
        <form-group name="map" title="Mappa">
            <vl-map
                ref="map"
                @click="onMapClick"
                :load-tiles-while-animating="true"
                :load-tiles-while-interacting="true"
                data-projection="EPSG:4326">
                <vl-view
                    :zoom.sync="zoom"
                    :center.sync="center"
                    :rotation.sync="rotation"/>

                <vl-layer-tile id="osm">
                    <vl-source-osm/>
                </vl-layer-tile>

                <vl-feature>
                    <vl-geom-point :coordinates="[parseFloat(city.lng), parseFloat(city.lat)]"></vl-geom-point>
                    <vl-style-box>
                        <vl-style-icon src="/svg/pin.svg" :scale="0.2" :anchor="[1, 1]"></vl-style-icon>
                    </vl-style-box>
                </vl-feature>

            </vl-map>
        </form-group>
        <form-group name="lat" title="Latitudine">
            <input type="text" name="lat" v-model="city.lat" class="form-control">
        </form-group>
        <form-group name="lng" title="Longitudine">
            <input type="text" name="lng" v-model="city.lng" class="form-control">
        </form-group>
        <form-group name="name" title="Nome">
            <input type="text" name="name" v-model="city.name" class="form-control">
        </form-group>
        <form-group name="save" title="Salva">
            <button class="btn btn-outline-primary" @click="upload">Salva</button>
        </form-group>
        <form-group name="delete" title="Elimina Prodotto">
            <button class="btn btn-outline-danger" @click="destroy">Elimina</button>
        </form-group>
        <form-group name="undo" title="Esci">
            <button class="btn btn-outline-secondary" @click="exit">Esci</button>
        </form-group>
    </div>
</template>

<script>
import { FormGroup } from './ui'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'

export default {
    name: 'CityPanel',
    components: {
        FormGroup,
        Multiselect,
    },
    props: {
        isEdit: {
            type: Boolean,
            default: false,
        },
        idx: {
            type: Number,
            default: null,
        },
        cityDefault: {
            type: Object,
            default: function() {}
        }
    },
    data: function() {
        return {
            zoom: 13,
            center: [ 9.19131164549529, 45.461118675626096 ],
            selection: null,
            rotation: 0,
            city: {
                name: null,
                lat: 0,
                lng: 0,
            },
        }
    },
    watch: {
        cityDefault: function(city) {
            this.city = city
        },
    },
    methods: {
        upload: function() {
            let data = new FormData();

            if (this.isEdit) {
                data.append('is_edit', true)
                data.append('idx', this.idx)
            }

            data = this.setData(data, 'name', this.city.name)
            data = this.setData(data, 'lat', this.city.lat)
            data = this.setData(data, 'lng', this.city.lng)

            this.$http.post('/api/admin/shops/save-city', data).then(response => {
                this.updateCities(response.data)
            })
        },
        updateCities: function(cities) {
            this.$emit('update-cities', cities)
            this.exit()
        },
        destroy: function() {
            if (this.idx && this.isEdit) {
                this.$emit('destroy', this.idx)
            } else {
                this.exit()
            }
        },
        exit: function() {
            this.$emit('exit')
            this.reset()
        },
        reset: function() {
            this.city = {
                name: null,
                lat: 0,
                lng: 0,
            }
        },
        onMapClick: function(event) {
            let coordinate = event.coordinate
            this.city.lat = coordinate[1]
            this.city.lng = coordinate[0]
        },
        setData: function(data, field, value) {
            if (value) {
                data.append(field, value)
                return data
            }
            return data
        },
    },
    mounted: function() {
    }
}
</script>

<style lang="css" scoped>
</style>
