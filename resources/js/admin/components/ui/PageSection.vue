<template lang="html">
    <div>
        <panel-block :title="title">
            <form-group :name="this.titleLower + '-title'" title="Titolo" v-if="!this.disableTitle">
                <input type="text" :name="this.titleLower + '-title'" v-model="section.title" class="form-control">
            </form-group>
            <form-group :name="this.titleLower + '-title-en'" title="Titolo [eng]" v-if="!this.disableTitle">
                <input type="text" :name="this.titleLower + '-title-en'" v-model="section.title_en" class="form-control">
            </form-group>
            <form-group :name="this.titleLower + '-text'" title="Testo" v-if="!this.disableTxt">
                <textarea :name="this.titleLower + '-text'" rows="8" cols="80" v-model="section.txt" class="form-control"></textarea>
            </form-group>
            <form-group :name="this.titleLower + '-text-en'" title="Testo [eng]" v-if="!this.disableTxt">
                <textarea :name="this.titleLower + '-text-en'" rows="8" cols="80" v-model="section.txt_en" class="form-control"></textarea>
            </form-group>
            <form-group name="headerImg" title="Cambia immagine" v-if="!this.isVideo">
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
            <form-group name="headerImg" title="Cambia Video" v-else>
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
            <form-group name="headerImgPreview" title="Immagine" v-if="!this.isVideo">
                <img :src="section.img" class="img-fluid" />
            </form-group>
            <form-group name="headerImgPreview" title="Video" v-else>
                <video-player
                    class="video-player-box img-fluid"
                    ref="videoPlayer"
                    :options="playerOptions"
                    :playsinline="true"/>
            </form-group>
            <div class="sep"></div>
            <form-group :name="this.titleLower + '-link-txt'" title="Testo Link" v-if="!this.disableLink">
                <input type="text" :name="this.titleLower + '-link-txt'" v-model="section.linktxt" class="form-control">
            </form-group>
            <form-group :name="this.titleLower + '-link-txt-en'" title="Testo Link [eng]" v-if="!this.disableLink">
                <input type="text" :name="this.titleLower + '-link-txt-en'" v-model="section.linktxt_en" class="form-control">
            </form-group>
            <form-group :name="this.titleLower + '-link-href'" title="Testo Href" v-if="!this.disableLink">
                <input type="text" :name="this.titleLower + '-link-href'" v-model="section.linkhref" class="form-control">
            </form-group>
            <form-group :name="this.titleLower + '-link-href-en'" title="Testo Href [eng]" v-if="!this.disableLink">
                <input type="text" :name="this.titleLower + '-link-href-en'" v-model="section.linkhref_en" class="form-control">
            </form-group>
            <div class="sep"></div>
            <form-group name="save" title="Salva">
                <button class="btn btn-outline-primary" @click="upload">Salva Sezione</button>
            </form-group>
        </panel-block>
        <hr>
    </div>
</template>

<script>
import FormGroup from './FormGroup.vue'
import PanelBlock from './PanelBlock.vue'
import 'video.js/dist/video-js.css'
import { videoPlayer } from 'vue-video-player'

export default {
    name: 'PageSection',
    components: {
        FormGroup,
        PanelBlock,
        videoPlayer,
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
        disableLink: {
            type: Boolean,
            default: true,
        },
        disableTitle: {
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
        },
        isVideo: {
            type: Boolean,
            default: false,
        },
    },
    data: function() {
        return {
            errorMessage: null,
            successMessage: null,
            section: {
                title: null,
                txt: null,
                title_en: null,
                txt_en: null,
                img: null,
                linktxt: null,
                linktxt_en: null,
                linkhref: null,
                linkhref_en: null,
            },
            playerOptions: {
                sources: [],
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

            if (this.isVideo && section.img) {
                this.playerOptions.sources = [section.img]
            }
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

            if (this.isVideo) {
                if (ext == 'mp4') {
                    // assegno il file alla variabile per il form
                    this.section.img = file

                    // segno il file come corretto
                    this.setValid('Formato file corretto, ora puoi salvare')
                    return false
                }

                this.setInvalid('Formato del file sbagliato, solo mp4')
                return false
            } else {
                if (ext == 'jpg' || ext == 'jpeg') {

                    // assegno il file alla variabile per il form
                    this.section.img = file

                    // segno il file come corretto
                    this.setValid('Formato file corretto, ora puoi salvare')
                    return false
                }

                this.setInvalid('Formato del file sbagliato, solo jpg o jpeg')
                return false
            }
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

<style lang="scss">
@import '~styles/adminshared';


.video-player-box {
    > div {
        max-width: 100%;
    }
}

.sep {
    margin-bottom: $spacer * 3;
}
</style>
