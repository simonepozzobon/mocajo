<template>
<page-template title="Corrieri">
    <shipping-panel
        ref="panel"
        :isEdit="this.isEdit"
        :idx="this.idx"
        :shippingDefault="this.shippingDefault"
        @destroy="destroy"
        @exit="exit"
        @update-cities="updateShipping"
    />

    <shippings-table
        ref="table"
        :shippings="this.shippings"
        @new-shipping="newShipping"
        @edit="edit"
        @destroy="destroy"
    />
</page-template>
</template>

<script>
import ShippingPanel from '../components/ShippingPanel.vue'
import ShippingsTable from '../components/ShippingsTable.vue'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'Cities',
    components: {
        ShippingPanel,
        ShippingsTable,
        PageTemplate,
    },
    data: function () {
        return {
            shippings: null,
            isEdit: false,
            idx: null,
            shippingDefault: null,
            master: null,
        }
    },
    methods: {
        getCities: function () {
            this.$http.get('/api/admin/shippings/get-shippings').then(response => {
                this.shippings = response.data
                this.debug()
            })
        },
        debug: function () {
            this.edit(this.shippings[0])
        },
        updateShipping: function (shippings) {
            this.shippings = shippings
        },
        newShipping: function () {
            this.isEdit = false
            this.idx = null
            this.$refs.panel.reset()
            this.showPanel()
        },
        edit: function (shipping) {
            this.isEdit = true
            this.idx = shipping.id
            this.shippingDefault = shipping
            this.showPanel()
        },
        exit: function () {
            this.isEdit = false
            this.idx = null
            this.hidePanel()
        },
        destroy: function (shipping) {
            let data = new FormData()
            data.append('idx', shipping.id)

            this.$http.post('/api/admin/shippings/destroy', data).then(response => {
                this.shippings = response.data
            })
        },
        hidePanel: function () {
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
        showPanel: function () {
            this.master.progress(1).reverse()
        }
    },
    mounted: function () {
        this.getCities()
        this.hidePanel()
    }
}
</script>

<style lang="scss" scoped>
</style>
