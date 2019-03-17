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
                    <vl-geom-point :coordinates="[parseFloat(shop.lng), parseFloat(shop.lat)]"></vl-geom-point>
                    <vl-style-box>
                        <vl-style-icon src="/svg/pin.svg" :scale="0.2" :anchor="[1, 1]"></vl-style-icon>
                    </vl-style-box>
                </vl-feature>

            </vl-map>
        </form-group>
        <form-group name="city_id" title="Città">
            <multiselect
                v-model="city"
                :options="options"
                :searchable="true"
                :close-on-select="true"
                :show-labels="false"
                placeholder="Seleziona una città..."/>
        </form-group>
        <form-group name="lat" title="Latitudine">
            <input type="text" name="lat" v-model="shop.lat" class="form-control">
        </form-group>
        <form-group name="lng" title="Longitudine">
            <input type="text" name="lng" v-model="shop.lng" class="form-control">
        </form-group>
        <form-group name="naem" title="Nome">
            <input type="text" name="naem" v-model="shop.name" class="form-control">
        </form-group>
        <form-group name="address" title="Indirizzo">
            <input type="text" name="address" v-model="shop.address" class="form-control">
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
    name: 'ShopPanel',
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
        shopDefault: {
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
            shop: {
                city_id: null,
                name: null,
                address: null,
                lat: 0,
                lng: 0,
            },
            cities: null,
            options: [],
            city: null,
        }
    },
    watch: {
        shopDefault: function(shop) {
            this.shop = shop
            this.findCityById(shop.city_id)
        },
        city: function(value) {
            let idx = this.cities.findIndex(item => item.name == value)
            if (idx > -1) {
                let result = this.cities[idx]
                this.center = [ parseFloat(result.lng), parseFloat(result.lat) ]
                this.shop.city_id = result.id
            }
        }
    },
    methods: {
        getCities: function() {
            this.$http.get('/api/admin/shops/get-cities').then(response => {
                this.cities = response.data
                this.formatCities()
            })
        },
        formatCities: function() {
            for (var i = 0; i < this.cities.length; i++) {
                let city = this.cities[i]
                this.options.push(city.name)
            }
        },
        findCityById: function(id) {
            let idx = this.cities.findIndex(item => item.id == id)
            if (idx > -1) {
                let result = this.cities[idx]
                this.city = result.name
            }
        },
        upload: function() {
            let data = new FormData();

            if (this.isEdit) {
                data.append('is_edit', true)
                data.append('idx', this.idx)
            }

            data = this.setData(data, 'city_id', this.shop.city_id)
            data = this.setData(data, 'name', this.shop.name)
            data = this.setData(data, 'address', this.shop.address)
            data = this.setData(data, 'lat', this.shop.lat)
            data = this.setData(data, 'lng', this.shop.lng)

            this.$http.post('/api/admin/shops/save-shop', data).then(response => {
                this.updateShops(response.data)
            })
        },
        updateShops: function(shops) {
            this.$emit('update-shops', shops)
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
            this.shop = {
                city_id: null,
                name: null,
                address: null,
                lat: 0,
                lng: 0,
            }
        },
        onMapClick: function(event) {
            let coordinate = event.coordinate
            this.shop.lat = coordinate[1]
            this.shop.lng = coordinate[0]
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
        this.getCities()
    }
}
</script>

<style lang="css" scoped>
</style>
