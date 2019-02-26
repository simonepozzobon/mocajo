<template lang="html">
    <div>
        <hr>
        <panel-block :title="title">
            <form-group :name="this.titleLower + '-title'" title="Titolo">
                <input type="text" :name="this.titleLower + '-title'" v-model="section.title" class="form-control">
            </form-group>
            <form-group :name="this.titleLower + '-text'" title="Testo" v-if="!this.disableTxt">
                <textarea :name="this.titleLower + '-text'" rows="8" cols="80" v-model="section.txt" class="form-control"></textarea>
            </form-group>
            <form-group name="headerImg" title="Cambia immagine">
                <div class="custom-file">
                    <input @change="filesChange($event.target.name, $event.target.files)" type="file" class="form-control-file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" ref="input">
                    <div class="valid-feedback">
                        {{ successMessage }}
                    </div>
                    <div class="invalid-feedback">
                        {{ errorMessage }}
                    </div>
                </div>
            </form-group>
            <form-group name="headerImgPreview" title="Immagine">
                <img :src="section.img" class="img-fluid" />
            </form-group>
            <form-group name="save" title="Salva">
                <button class="btn btn-outline-primary" @click="upload">Salva Sezione</button>
            </form-group>
        </panel-block>
    </div>
</template>

<script>
import FormGroup from './FormGroup.vue'
import PanelBlock from './PanelBlock.vue'

export default {
    name: 'PageSection',
    components: {
        FormGroup,
        PanelBlock,
    },
    props: {
        title: {
            type: String,
            default: 'titolo',
        },
        disableTxt: {
            type: Boolean,
            default: false,
        },
        defaultValue: {
            type: Object,
            default: function() {},
        },
        idx: {
            type: String,
            default: null
        }
    },
    data: function() {
        return {
            errorMessage: null,
            successMessage: null,
            section: {
                title: null,
                txt: null,
                img: null,
            }
        }
    },
    computed: {
        titleLower: function() {
            return this.title.toLowerCase()
        },
        computedIdx: function() {
            if (this.idx) {
                return this.idx
            }
            return this.titleLower
        }
    },
    watch: {
        'defaultValue': function(section) {
            this.section = section
        },
        'section': function(section) {
            this.$emit('changed-value', section)
        }
    },
    methods: {
        filesChange: function(fieldName, filesList) {
            // resetto la variabile prima di riassegnare il file
            this.section.img = null

            let file = filesList[0]
            let name = file.name

            // prendo l'estensione dal nome del file
            let re = /(?:\.([^.]+))?$/
            let ext = re.exec(name)[1]

            if (ext == 'jpg' || ext == 'jpeg') {

                // assegno il file alla variabile per il form
                this.section.img = file

                // segno il file come corretto
                this.setValid('Formato file corretto, ora puoi salvare')
                return false
            }

            this.setInvalid('Formato del file sbagliato, solo jpg o jpeg')
            return false
        },
        setInvalid: function(message) {
            this.errorMessage = message

            let el = this.$refs.input
            el.classList.remove('is-valid')
            el.classList.add('is-invalid')
        },
        setValid: function(message) {
            this.successMessage = message

            let el = this.$refs.input
            el.classList.remove('is-invalid')
            el.classList.add('is-valid')
        },
        clearFeeback: function() {
            let el = this.$refs.input
            el.classList.remove('is-invalid')
            el.classList.remove('is-valid')

            this.errorMessage = null
            this.successMessage = null
        },
        upload: function() {
            this.$emit('upload', this.section)
        }
    },
    mounted: function() {
        this.$parent.$on(this.computedIdx + '-error', msg => {
            this.setInvalid(msg)
        })

        this.$parent.$on('clear-feedback', () => {
            this.clearFeeback()
        })
    }
}
</script>

<style lang="css" scoped>
</style>
