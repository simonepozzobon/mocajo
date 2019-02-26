<template lang="html">
    <div class="">
        <h1 class="pt-3">Contatti</h1>
        <hr>
        <panel-block title="Informazioni">
            <form-group name="name" title="Nome">
                <input type="text" name="name" v-model="name" class="form-control">
            </form-group>
            <form-group name="address" title="Indirizzo">
                <input type="text" name="address" v-model="address" class="form-control">
            </form-group>
            <form-group name="phone" title="Telefono">
                <input type="text" name="phone" v-model="phone" class="form-control">
            </form-group>
            <form-group name="mail" title="E-mail">
                <input type="text" name="mail" v-model="mail" class="form-control">
            </form-group>
            <form-group name="button" title="Salva">
                <button class="btn btn-outline-primary" @click="upload">Salva</button>
            </form-group>
        </panel-block>
    </div>
</template>

<script>
import { FormGroup, PanelBlock } from '../components/ui'

export default {
    name: 'HomePage',
    components: {
        FormGroup,
        PanelBlock,
    },
    data: function() {
        return {
            errorMessage: 'Formato del file sbagliato, solo mp4',
            name: null,
            address: null,
            phone: null,
            mail: null,
        }
    },
    methods: {
        upload: function() {
            let data = new FormData()
            data = this.setData(data, 'name', this.name)
            data = this.setData(data, 'address', this.address)
            data = this.setData(data, 'phone', this.phone)
            data = this.setData(data, 'mail', this.mail)

            this.$http.post('/api/admin/contact/save-section', data).then(response => {
                this.formatResponse(response.data)
            })
        },
        setData: function(data, field, value) {
            if (value) {
                data.append(field, value)
                return data
            }
            return data
        },
        getOpts: function() {
            this.$http.get('/api/admin/contact/get-options').then(response => {
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            this.name = data.name
            this.address = data.address
            this.phone = data.phone
            this.mail = data.mail
            this.$emit('clear-feedback')
        }
    },
    mounted: function() {
        this.getOpts()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.video-player-box {
    > div {
        max-width: 100%;
    }
}
</style>
