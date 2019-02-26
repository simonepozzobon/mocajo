<template lang="html">
    <div :id="this.titleToLower" class="row" v-view="handler">
        <div :id="this.titleToLower + '-trigger'"></div>
        <ui-block
            color="bg-light">
            <ui-title
                :title="product.title"
                :is-disabled="!product.is_active"/>
            <ui-subtitle
                :title="product.short_description"
                :is-disabled="!product.is_active"/>
            <ui-collapse
                :elements="this.wine_description"
                :is-disabled="!product.is_active"/>
            <ui-action
                :url="product.scheda_tecnica"
                :is-disabled="!product.is_active">
                Download Scheda Tecnica
            </ui-action>
            <button class="btn btn-outline-black add-to-cart d-none" @click="addToCart">Acquista</button>
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
            this.$root.addToCart(this.product)
        },
    },
    mounted: function() {
        console.log(this.product)
    }
}
</script>

<style lang="css" scoped>
</style>
