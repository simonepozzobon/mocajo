<template lang="html">
    <page-template title="Impostazioni Generali">
        <general-section title="Negozio">
            <form-group name="shop_status" title="Stato del Negozio">
                <span class="switch">
                    <input type="checkbox" class="switch" id="is_active" :checked="this.shop.active" v-model="shop.active">
                    <label for="is_active">{{ this.shopStatus }}</label>
                </span>
            </form-group>
            <form-group name="multiplier" title="Moltiplicatore">
                <input type="text" name="multiplier" v-model="shop.multiplier" class="form-control" aria-describedby="menu_scuola_help">
                 <small id="menu_scuola_help" class="form-text text-muted">Esempio: se il valore è 6, quando il cliente clicca su acquista effettua un ordine di 6 bottiglie</small>
            </form-group>
            <form-group name="save" title="Salva">
                <button class="btn btn-outline-primary" @click="upload('shop')">Salva Sezione</button>
            </form-group>
        </general-section>
        <general-section title="Menu">
            <form-group name="menu_scuola" title="Scuola">
                <input type="text" name="menu_scuola" v-model="menu.scuola" class="form-control">
            </form-group>
            <form-group name="menu_scuola_en" title="Scuola [eng]">
                <input type="text" name="menu_scuola_en" v-model="menu.scuola_en" class="form-control">
            </form-group>
            <form-group name="menu_storia" title="Storia">
                <input type="text" name="menu_storia" v-model="menu.storia" class="form-control">
            </form-group>
            <form-group name="menu_storia_en" title="Storia [eng]">
                <input type="text" name="menu_storia_en" v-model="menu.storia_en" class="form-control">
            </form-group>
            <form-group name="menu_vini" title="Vini">
                <input type="text" name="menu_vini" v-model="menu.vini" class="form-control">
            </form-group>
            <form-group name="menu_vini_en" title="Vini [eng]">
                <input type="text" name="menu_vini_en" v-model="menu.vini_en" class="form-control">
            </form-group>
            <form-group name="menu_contatti" title="Contatti">
                <input type="text" name="menu_contatti" v-model="menu.contatti" class="form-control">
            </form-group>
            <form-group name="menu_contatti_en" title="Contatti [eng]">
                <input type="text" name="menu_contatti_en" v-model="menu.contatti_en" class="form-control">
            </form-group>
            <form-group name="save" title="Salva">
                <button class="btn btn-outline-primary" @click="upload('menu')">Salva Sezione</button>
            </form-group>
        </general-section>
        <general-section title="Testo Cookies">
            <form-group name="cookies" title="Testo">
                <textarea name="cookies" rows="8" cols="80" v-model="cookies.text" class="form-control"></textarea>
            </form-group>
            <form-group name="cookies_en" title="Testo [eng]">
                <textarea name="cookies_en" rows="8" cols="80" v-model="cookies.text_en" class="form-control"></textarea>
            </form-group>
            <form-group name="save" title="Salva">
                <button class="btn btn-outline-primary" @click="upload('cookies')">Salva Sezione</button>
            </form-group>
        </general-section>
    </page-template>
</template>

<script>
import { FormGroup, GeneralSection  } from '../components/ui'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'Settings',
    components: {
        FormGroup,
        GeneralSection,
        PageTemplate,
    },
    data: function() {
        return {
            shop: {
                active: false,
                multiplier: null
            },
            menu: {
                scuola: null,
                storia: null,
                vini: null,
                contatti: null,
            },
            cookies: {
                text: null,
                text_en: null,
            }
        }
    },
    computed: {
        shopStatus: function() {
            if (this.shop.active) {
                return 'Attivo'
            }
            return 'Disattivato'
        }
    },
    methods: {
        getOpts: function() {
            this.$http.get('/api/admin/settings/get-options').then(response => {
                this.formatOptions(response.data)
            })
        },
        formatOptions: function(options) {
            this.shop = {
                ...options.shop,
                active: options.shop.active == 'true' ? true : false
            }
            this.cookies = options.cookies
            this.menu = {
                scuola: options.menu.scuola.txt,
                storia: options.menu.storia.txt,
                vini: options.menu.vini.txt,
                contatti: options.menu.contatti.txt,
                scuola_en: options.menu.scuola.txt_en,
                storia_en: options.menu.storia.txt_en,
                vini_en: options.menu.vini.txt_en,
                contatti_en: options.menu.contatti.txt_en,
            }
        },
        upload: function(value) {
            let data = new FormData()

            switch (value) {
                case 'shop':
                    data.append('type', 'shop')
                    data = this.setData(data, 'active', this.shop.active)
                    data = this.setData(data, 'multiplier', this.shop.multiplier)
                    break;
                case 'menu':
                    data.append('type', 'menu')
                    data = this.setData(data, 'scuola', this.menu.scuola)
                    data = this.setData(data, 'storia', this.menu.storia)
                    data = this.setData(data, 'vini', this.menu.vini)
                    data = this.setData(data, 'contatti', this.menu.contatti)
                    data = this.setData(data, 'scuola_en', this.menu.scuola_en)
                    data = this.setData(data, 'storia_en', this.menu.storia_en)
                    data = this.setData(data, 'vini_en', this.menu.vini_en)
                    data = this.setData(data, 'contatti_en', this.menu.contatti_en)
                    break;
                case 'cookies':
                    data.append('type', 'cookies')
                    data = this.setData(data, 'text', this.cookies.text)
                    data = this.setData(data, 'text_en', this.cookies.text_en)
                    break;
            }

            this.$http.post('/api/admin/settings/save-section', data).then(response => {
                console.log(response);
                this.formatOptions(response.data)
            })
        },
        setData: function(data, field, value) {
            if (value) {
                data.append(field, value)
                return data
            }
            return data
        }
    },
    mounted: function() {
        this.getOpts()
    }
}
</script>

<style lang="css" scoped>
</style>
