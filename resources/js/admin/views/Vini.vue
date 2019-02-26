<template lang="html">
    <page-template title="Vini">
        <product-panel
            ref="panel"
            :isEdit="this.isEdit"
            :idx="this.idx"
            :productDefault="this.productDefault"
            @destroy="destroy"
            @exit="exit"/>

        <products-table
            ref="table"
            :products="this.products"
            @new-product="newProduct"
            @edit="edit"
            @destroy="destroy"/>
    </page-template>
</template>

<script>
import PageTemplate from '../containers/PageTemplate.vue'
import ProductPanel from '../components/ProductPanel.vue'
import ProductsTable from '../components/ProductsTable.vue'

import { TweenMax } from 'gsap'

export default {
    name: 'Vini',
    components: {
        PageTemplate,
        ProductPanel,
        ProductsTable,
    },
    data: function() {
        return {
            products: null,
            isEdit: false,
            idx: null,
            productDefault: null,
            master: null,
        }
    },
    methods: {
        getContents: function() {
            this.$http.get('/api/admin/products/get-products').then(response => {
                this.products = response.data
            })
        },
        newProduct: function() {
            this.isEdit = false
            this.idx = null
            this.$refs.panel.reset()
            this.showPanel()
        },
        edit: function(product) {
            this.isEdit = true
            this.idx = product.id
            this.productDefault = product
            this.showPanel()
        },
        exit: function() {
            this.isEdit = false
            this.idx = null
            this.hidePanel()
        },
        destroy: function(product) {
            let data = new FormData()
            data.append('idx', product.id)

            this.$http.post('/api/admin/products/destroy', data).then(response => {
                this.products = response.data
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
    mounted: function() {
        this.getContents()
        this.hidePanel()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';


</style>
