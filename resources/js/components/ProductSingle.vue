<template lang="html">
    <div :id="this.titleToLower" class="row" v-view="handler">
        <div :id="this.titleToLower + '-trigger'"></div>
        <ui-block
            color="bg-light">
            <ui-title
                :title="product.title"
                tag="h1"
                :is-disabled="!product.is_active"/>
            <ui-subtitle
                :title="product.short_description"
                :is-disabled="!product.is_active"/>
            <ui-collapse
                :elements="this.wine_description"
                :is-disabled="!product.is_active"/>
            <ui-action
                target="_blank"
                :url="product.scheda_tecnica"
                :is-disabled="!product.is_active">
                Download Scheda Tecnica
            </ui-action>
            <button class="btn btn-outline-black add-to-cart" @click="addToCart" v-if="shop.active">Acquista</button>
            <button class="btn btn-outline-black add-to-cart d-none" @click="addToCart" v-else>Acquista</button>
        </ui-block>
        <ui-block
            class="custom-block"
            flex-align="top"
            :disable-padding="true">
                <img :src="product.img" class="img-fluid"/>
        </ui-block>
    </div>
</template>

<script>
import { UiAction, UiBlock, UiCollapse, UiHeroBanner, UiImageBlock, UiSubtitle, UiTitle } from './ui'

export default {
    name: 'ProductSingle',
    components: {
        UiAction,
        UiBlock,
        UiCollapse,
        UiHeroBanner,
        UiImageBlock,
        UiSubtitle,
        UiTitle
    },
    props: {
        product: {
            type: Object,
            default: function() {}
        },
        shop: {
            type: Object,
            default: function() {}
        }
    },
    computed: {
        titleToLower: function() {
            if (this.product.title) {
                return this.product.title.toLowerCase()
            }
            return null
        },
        wine_description: function() {
            return [
                {
                    title: 'descrizione',
                    content: this.product.description
                },
                {
                    title: 'vitigno',
                    content: this.product.vitigno
                },
                {
                    title: 'zona',
                    content: this.product.zona
                },
                {
                    title: 'vinificazione',
                    content: this.product.vinificazione
                },
                {
                    title: 'valori_analitici',
                    content: this.product.valori_analitici
                },
            ]
        }
    },
    methods: {
        handler: function(e) {
        },
        addToCart: function() {
            let shortenProduct = {
                id: this.product.id,
                title: this.product.title,
                img: this.product.img,
                icon: this.product.icon,
                price: this.product.price,
                quantity: 1 * this.shop.multiplier
            }
            this.$root.addToCart(shortenProduct)
        },
    },
}
</script>

<style lang="css" scoped>
</style>
