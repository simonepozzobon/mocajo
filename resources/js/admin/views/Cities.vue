<template lang="html">
    <page-template title="Città">
        <city-panel
            ref="panel"
            :isEdit="this.isEdit"
            :idx="this.idx"
            :cityDefault="this.cityDefault"
            @destroy="destroy"
            @exit="exit"
            @update-cities="updateShops"/>

        <cities-table
            ref="table"
            :cities="this.cities"
            @new-city="newCity"
            @edit="edit"
            @destroy="destroy"/>
    </page-template>
</template>

<script>
import CityPanel from '../components/CityPanel.vue'
import CitiesTable from '../components/CitiesTable.vue'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'Cities',
    components: {
        CityPanel,
        CitiesTable,
        PageTemplate,
    },
    data: function() {
        return {
            cities: null,
            isEdit: false,
            idx: null,
            cityDefault: null,
            master: null,
        }
    },
    methods: {
        getCities: function() {
            this.$http.get('/api/admin/shops/get-cities').then(response => {
                this.cities = response.data
            })
        },
        updateShops: function(cities) {
            this.cities = cities
        },
        newCity: function() {
            this.isEdit = false
            this.idx = null
            this.$refs.panel.reset()
            this.showPanel()
        },
        edit: function(city) {
            this.isEdit = true
            this.idx = city.id
            this.cityDefault = city
            this.showPanel()
        },
        exit: function() {
            this.isEdit = false
            this.idx = null
            this.hidePanel()
        },
        destroy: function(city) {
            let data = new FormData()
            data.append('idx', city.id)

            this.$http.post('/api/admin/shops/city-destroy', data).then(response => {
                this.cities = response.data
            })
        },
        hidePanel: function() {
            if (!this.master) {
                this.master = new TimelineMax({
                    paused: true,
                    reversed: true,
                })

                this.master.fromTo(this.$refs.table.$el, .3, {
                    display: 'none',
                    height: 0
                }, {
                    display: 'block',
                    height: 'auto'
                }, 0)
                    .fromTo(this.$refs.table.$el, .3, {
                        autoAlpha: 0,
                    }, {
                        autoAlpha: 1,
                    })


                this.master.fromTo(this.$refs.panel.$el, .3, {
                    display: 'block',
                    height: 'auto'
                }, {
                    display: 'none',
                    height: 0
                }, 0)
                    .fromTo(this.$refs.panel.$el, .3, {
                        autoAlpha: 1,
                    }, {
                        autoAlpha: 0
                    })

            }
            this.master.progress(0).play()
        },
        showPanel: function() {
            this.master.progress(1).reverse()
        }
    },
    mounted: function() {
        this.getCities()
        this.hidePanel()
    }
}
</script>

<style lang="scss" scoped>
</style>
