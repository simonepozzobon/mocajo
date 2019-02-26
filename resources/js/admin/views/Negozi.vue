<template lang="html">
    <page-template title="Negozi">
        <shop-panel
            ref="panel"
            :isEdit="this.isEdit"
            :idx="this.idx"
            :shopDefault="this.shopDefault"
            @destroy="destroy"
            @exit="exit"
            @update-shops="updateShops"
            @add-city="addCity"/>

        <shops-table
            ref="table"
            :shops="this.shops"
            @new-shop="newShop"
            @edit="edit"
            @destroy="destroy"
            @add-city="addCity"/>
    </page-template>
</template>

<script>
import { FormGroup } from '../components/ui'
import PageTemplate from '../containers/PageTemplate.vue'
import ShopPanel from '../components/ShopPanel.vue'
import ShopsTable from '../components/ShopsTable.vue'

export default {
    name: 'Negozi',
    components: {
        FormGroup,
        PageTemplate,
        ShopPanel,
        ShopsTable,
    },
    data: function() {
        return {
            shops: null,
            isEdit: false,
            idx: null,
            shopDefault: null,
            master: null,
        }
    },
    methods: {
        addCity: function() {
            this.$router.push('/cities')
        },
        getShops: function() {
            this.$http.get('/api/admin/shops/get-shops').then(response => {
                this.shops = response.data
            })
        },
        updateShops: function(shops) {
            this.shops = shops
        },
        newShop: function() {
            this.isEdit = false
            this.idx = null
            this.$refs.panel.reset()
            this.showPanel()
        },
        edit: function(shop) {
            this.isEdit = true
            this.idx = shop.id
            this.shopDefault = shop
            this.showPanel()
        },
        exit: function() {
            this.isEdit = false
            this.idx = null
            this.hidePanel()
        },
        destroy: function(shop) {
            let data = new FormData()
            data.append('idx', shop.id)

            this.$http.post('/api/admin/shops/destroy', data).then(response => {
                this.shops = response.data
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
        this.getShops()
        this.hidePanel()
    }
}
</script>

<style lang="scss">
</style>
