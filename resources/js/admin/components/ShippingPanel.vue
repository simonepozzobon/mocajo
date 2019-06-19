<template>
<div>
    <form-group
        name="description"
        title="Descrizione"
    >
        <input
            type="text"
            name="description"
            v-model="shipping.description"
            class="form-control"
        >
    </form-group>
    <form-group
        name="default"
        title="Default"
    >
        <input
            type="text"
            name="default"
            v-model="shipping.default"
            class="form-control"
        >
    </form-group>
    <form-group
        name="image"
        title="Logo"
    >
        <file-input
            ref="logo"
            format="svg"
            @file-loaded="logoLoad"
        />
    </form-group>
    <form-group
        name="logoPreview"
        title="Anteprima Logo"
    >
        <img
            v-if="preview"
            :src="preview"
            class="img-fluid"
        >
        <span
            class="text-danger"
            v-else
        >
            Nessun Logo Caricato!
        </span>
    </form-group>
    <form-group
        name="price"
        title="Prezzo"
    >
        <input
            type="text"
            name="price"
            v-model="shipping.price"
            class="form-control"
        >
    </form-group>
    <shipping-variation :variations.sync="shipping.variations" />
    <form-group
        name="timing"
        title="Tempistiche"
    >
        <input
            type="text"
            name="timing"
            v-model="shipping.timing"
            class="form-control"
        >
    </form-group>
    <form-group
        name="save"
        title="Salva"
    >
        <button
            class="btn btn-outline-primary"
            @click="upload"
        >
            Salva
        </button>
    </form-group>
    <form-group
        name="delete"
        title="Elimina Prodotto"
    >
        <button
            class="btn btn-outline-danger"
            @click="destroy"
        >
            Elimina
        </button>
    </form-group>
    <form-group
        name="undo"
        title="Esci"
    >
        <button
            class="btn btn-outline-secondary"
            @click="exit"
        >
            Esci
        </button>
    </form-group>
</div>
</template>

<script>
import {
    FileInput,
    FormGroup
}
from './ui'
import Multiselect from 'vue-multiselect'
import ShippingVariation from './ShippingVariation.vue'
import 'vue-multiselect/dist/vue-multiselect.min.css'

export default {
    name: 'Shipping',
    components: {
        FileInput,
        FormGroup,
        Multiselect,
        ShippingVariation,
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
        shippingDefault: {
            type: Object,
            default: function () {}
        }
    },
    data: function () {
        return {
            shipping: {
                description: null,
                default: 0,
                price: null,
                increment: null,
                logo: null,
                timing: null,
                variations: [],
            },
            preview: null,
        }
    },
    watch: {
        shippingDefault: function (shipping) {
            this.shipping = shipping
            this.preview = shipping.logo ? shipping.logo : null
        },
    },
    methods: {
        logoLoad: function (logo) {
            this.shipping.logo = logo

            let reader = new FileReader()
            reader.addEventListener('load', () => {
                this.preview = reader.result
            })
            reader.readAsDataURL(logo)
        },
        upload: function () {
            let data = new FormData();

            if (this.isEdit) {
                data.append('is_edit', true)
                data.append('idx', this.idx)
            }

            if (this.shipping.logo && this.shipping.logo != '/storage/') {
                let isFile = typeof this.shipping.logo.name == 'string'
                if (isFile) {
                    data.append('logo', this.shipping.logo)
                }
            }
            else {
                this.$refs.logo.setInvalid('Selezionare un file')
            }

            data = this.setData(data, 'description', this.shipping.description)
            data = this.setData(data, 'variations', JSON.stringify(this.shipping.variations))
            data = this.setData(data, 'default', this.shipping.default)
            data = this.setData(data, 'price', this.shipping.price)
            data = this.setData(data, 'increment', this.shipping.increment)
            data = this.setData(data, 'timing', this.shipping.timing)

            this.$http.post('/api/admin/shippings/save-shipping', data).then(response => {
                this.updateShipping(response.data)
            })
        },
        updateShipping: function (cities) {
            this.$emit('update-cities', cities)
            this.exit()
        },
        destroy: function () {
            if (this.idx && this.isEdit) {
                this.$emit('destroy', this.idx)
            }
            else {
                this.exit()
            }
        },
        exit: function () {
            this.$emit('exit')
            this.reset()
        },
        reset: function () {
            this.shipping = {
                description: null,
                default: 0,
                price: null,
                increment: null,
                logo: null,
                timing: null,
            }
        },
        setData: function (data, field, value) {
            if (value || value == 0) {
                data.append(field, value)
                return data
            }
            return data
        },
        updateVariations: function (variations) {
            this.shipping.variations = variations
        }
    },
    mounted: function () {}
}
</script>

<style lang="css" scoped>
</style>
