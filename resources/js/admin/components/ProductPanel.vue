<template lang="html">
    <div>
        <form-group name="icon" title="Icona">
            <file-input
                ref="icon"
                format="svg"
                @file-loaded="iconLoad"/>
        </form-group>
        <form-group name="iconPreview" title="Anteprima">
            <img :src="product.icon" class="img-fluid" v-if="product.icon">
            <span class="text-danger" v-else>Nessuna Icona Caricata!</span>
        </form-group>
        <form-group name="title" title="Nome">
            <input type="text" name="title" v-model="product.title" class="form-control">
        </form-group>
        <form-group name="short_description" title="Descrizione Breve">
            <textarea name="short_description" rows="2" cols="80" v-model="product.short_description" class="form-control"></textarea>
        </form-group>
        <form-group name="description" title="Descrizione">
            <textarea name="description" rows="5" cols="80" v-model="product.description" class="form-control"></textarea>
        </form-group>
        <form-group name="vitigno" title="Vitigno">
            <textarea name="vitigno" rows="2" cols="80" v-model="product.vitigno" class="form-control"></textarea>
        </form-group>
        <form-group name="zona" title="Zona">
            <textarea name="zona" rows="2" cols="80" v-model="product.zona" class="form-control"></textarea>
        </form-group>
        <form-group name="vinificazione" title="Vinificazione">
            <textarea name="vinificazione" rows="2" cols="80" v-model="product.vinificazione" class="form-control"></textarea>
        </form-group>
        <form-group name="valori_analitici" title="Valori Analitici">
            <textarea name="valori_analitici" rows="2" cols="80" v-model="product.valori_analitici" class="form-control"></textarea>
        </form-group>
        <form-group name="scheda_tecnica" title="Scheda Tecnica">
            <file-input
                ref="scheda"
                format="pdf"
                @file-loaded="schedaLoad"/>
        </form-group>
        <form-group name="scheda_tecnicaPreview" title="Anteprima">
            <a :href="this.product.scheda_tecnica" target="_blank" v-if="this.product.scheda_tecnica">Anteprima scheda</a>
            <span class="text-danger" v-else>Nessuna Scheda Caricata!</span>
        </form-group>
        <form-group name="price" title="Prezzo">
            <input type="text" name="price" v-model="product.price" class="form-control">
        </form-group>
        <form-group name="is_active" title="Attivo?">
            <span class="switch">
                <input type="checkbox" class="switch" id="is_active" :checked="this.product.is_active" v-model="product.is_active">
                <label for="is_active">Attivo?</label>
            </span>
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
import { FileInput, FormGroup } from './ui'

export default {
    name: 'ProductPanel',
    components: {
        FileInput,
        FormGroup,
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
        productDefault: {
            type: Object,
            default: function() {}
        }
    },
    watch: {
        productDefault: function(product) {
            this.product = product
        }
    },
    data: function() {
        return {
            product: {
                icon: null,
                title: null,
                short_description: null,
                description: null,
                vitigno: null,
                zona: null,
                vinificazione: null,
                valori_analitici: null,
                scheda_tecnica: null,
                price: null,
                is_active: true,
            }
        }
    },
    methods: {
        iconLoad: function(icon) {
            this.product.icon = icon
        },
        schedaLoad: function(scheda) {
            this.product.scheda_tecnica = scheda
        },
        upload: function() {
            let data = new FormData()

            if (this.isEdit) {
                data.append('is_edit', true)
                data.append('idx', this.idx)
            }

            if (this.product.icon && this.product.icon != '/storage/') {
                let isFile = typeof this.product.icon.name == 'string'
                if (isFile) {
                    data.append('icon', this.product.icon)
                }
            } else {
                this.$refs.icon.setInvalid('Selezionare un file')
            }

            if (this.product.scheda_tecnica && this.product.scheda_tecnica != '/storage/') {
                let isFile = typeof this.product.scheda_tecnica.name == 'string'
                if (isFile) {
                    data.append('scheda_tecnica', this.product.scheda_tecnica)
                }
            } else {
                this.$refs.scheda.setInvalid('Selezionare un file')
            }

            data = this.setData(data, 'title', this.product.title)
            data = this.setData(data, 'short_description', this.product.short_description)
            data = this.setData(data, 'description', this.product.description)
            data = this.setData(data, 'vitigno', this.product.vitigno)
            data = this.setData(data, 'zona', this.product.zona)
            data = this.setData(data, 'vinificazione', this.product.vinificazione)
            data = this.setData(data, 'valori_analitici', this.product.valori_analitici)
            data = this.setData(data, 'price', this.product.price)

            if (this.product.is_active) {
                data.append('is_active', 1)
            } else {
                data.append('is_active', 0)
            }

            this.$http.post('/api/admin/products/save-product', data).then(response => {
                this.exit()
            })
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
        setData: function(data, field, value) {
            if (value) {
                data.append(field, value)
                return data
            }
            return data
        },
        reset: function() {
            this.product = {
                icon: null,
                title: null,
                short_description: null,
                description: null,
                vitigno: null,
                zona: null,
                vinificazione: null,
                valori_analitici: null,
                scheda_tecnica: null,
                price: null,
                is_active: true,
            }
        }
    }
}
</script>

<style lang="scss">
</style>
