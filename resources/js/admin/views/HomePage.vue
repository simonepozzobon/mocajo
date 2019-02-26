<template lang="html">
    <page-template title="Homepage">
        <div class="form">
            <div class="form-group row">
                <label for="video" class="col-md-3">Cambia video</label>
                <div class="input-group mb-3 col-md-9">
                    <div class="custom-file">
                        <input @change="filesChange($event.target.name, $event.target.files)" type="file" class="form-control-file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" ref="input">
                        <div class="valid-feedback">
                            File corretto, clicca salva
                        </div>
                        <div class="invalid-feedback">
                            {{ errorMessage }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row pb-5">
                <div class="col-md-9 offset-md-3">
                    <a href="#" class="btn btn-primary" @click="upload">
                        Salva
                    </a>
                </div>
            </div>
            <div class="form-group row">
                <label for="videoPreview" class="col-md-3">Video Attuale</label>
                <div class="col-md-9">
                    <video-player
                        class="video-player-box img-fluid"
                        ref="videoPlayer"
                        :options="playerOptions"
                        :playsinline="true"/>
                </div>
            </div>
        </div>
    </page-template>
</template>

<script>
import PageTemplate from '../containers/PageTemplate.vue'
import 'video.js/dist/video-js.css'
import { videoPlayer } from 'vue-video-player'

export default {
    name: 'HomePage',
    components: {
        PageTemplate,
        videoPlayer,
    },
    data: function() {
        return {
            errorMessage: 'Formato del file sbagliato, solo mp4',
            video: null,
            playerOptions: {
                sources: [],
            }
        }
    },
    methods: {
        filesChange: function(fieldName, filesList) {
            // resetto la variabile prima di riassegnare il file
            this.video = null

            let file = filesList[0]
            let name = file.name

            // prendo l'estensione dal nome del file
            let re = /(?:\.([^.]+))?$/
            let ext = re.exec(name)[1]

            if (ext == 'mp4') {

                // assegno il file alla variabile per il form
                this.video = file

                // segno il file come corretto
                this.setValid()
                return false
            }

            this.setInvalid('Formato del file sbagliato, solo mp4')
            return false
        },
        upload: function(event) {
            event.preventDefault()
            if (this.video) {
                let data = new FormData()
                data.append('video', this.video)
                this.$http.post('/api/admin/homepage/upload-video', data).then(response => {
                    let video = {
                        type: 'video/mp4',
                        src: 'storage/' + response.data.option.value
                    }
                    this.playerOptions.sources.push(video)
                })
            } else {
                this.setInvalid('Selezionare un file')
            }

        },
        setInvalid: function(message) {
            this.errorMessage = message

            let el = this.$refs.input
            el.classList.remove('is-valid')
            el.classList.add('is-invalid')
        },
        setValid: function() {
            let el = this.$refs.input
            el.classList.remove('is-invalid')
            el.classList.add('is-valid')
        },
        getVideo: function() {
            this.$http.get('/api/admin/homepage/get-video').then(response => {
                console.log(response);
                let video = {
                    type: 'video/mp4',
                    src: response.data
                }
                this.playerOptions.sources = [video]

            })
        }
    },
    mounted: function() {
        this.getVideo()
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
</style>
