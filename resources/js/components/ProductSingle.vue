<template lang="html">
    <div :id="this.titleToLower" class="row">
        <div :id="this.titleToLower + '-trigger'"></div>
        <ui-block
            color="bg-light">
            <ui-title
                :title="product.title"
                tag="h2"
                :is-disabled="!product.is_active"/>
            <ui-subtitle
                :title="this.description"
                :is-disabled="!product.is_active"/>
            <ui-collapse
                :elements="this.wine_description"
                :is-disabled="!product.is_active"/>
            <ui-action
                target="_blank"
                :url="scheda_tecnica"
                :is-disabled="!product.is_active">
                {{ this.btn }}
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
    data: function() {
        return {
            description: null,
            btn: null,
            scheda_tecnica: null,
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
                    title_en: 'description',
                    content: this.product.description,
                    content_en: this.product.description_en,
                },
                {
                    title: 'vitigno',
                    title_en: 'grape variety',
                    content: this.product.vitigno,
                    content_en: this.product.vitigno_en,
                },
                {
                    title: 'zona',
                    title_en: 'zone',
                    content: this.product.zona,
                    content_en: this.product.zona_en,
                },
                {
                    title: 'vinificazione',
                    title_en: 'winemaking',
                    content: this.product.vinificazione,
                    content_en: this.product.vinificazione_en,
                },
                {
                    title: 'valori analitici',
                    title_en: 'analytical values',
                    content: this.product.valori_analitici,
                    content_en: this.product.valori_analitici_en,
                },
            ]
        }
    },
    watch: {
        '$root.locale': function(locale) {
            this.translate(locale)
        }
    },
    methods: {
        translate: function(locale = false) {
            this.description = this.$root.locale == 'it' ? this.product.short_description : this.product.short_description_en
            this.scheda_tecnica = this.$root.locale == 'it' ? this.product.scheda_tecnica : this.product.scheda_tecnica_en
            this.btn = this.$root.locale == 'it' ? 'Download Scheda Tecnica' : 'Download Technical Sheet'
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
    mounted: function() {
        this.translate()
    },
}
</script>

<style lang="css" scoped>
</style>
