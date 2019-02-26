<template lang="html">
    <page-template title="La Nostra Storia">
        <page-section
            title="Header"
            idx="header"
            :disable-title="true"
            :disable-txt="true"
            :is-video="true"
            :default-value="this.header"
            @changed-value="setOpts($event, 'header')"
            @upload="upload($event, 'header')"/>
        <page-section
            title="La Scuola"
            idx="scuola"
            :default-value="this.scuola"
            @changed-value="setOpts($event, 'scuola')"
            @upload="upload($event, 'scuola')"/>
        <page-section
            title="Immagine Sx"
            idx="image-sx"
            :disable-title="true"
            :disable-txt="true"
            :default-value="this.image1"
            @changed-value="setOpts($event, 'image-1')"
            @upload="upload($event, 'image-1')" />
        <page-section
            title="Immagine Dx"
            idx="image-dx"
            :disable-title="true"
            :disable-txt="true"
            :default-value="this.image2"
            @changed-value="setOpts($event, 'image-2')"
            @upload="upload($event, 'image-2')" />
        <page-section
            title="Immagine Centrale"
            idx="image-cx"
            :disable-title="true"
            :disable-txt="true"
            :default-value="this.image3"
            @changed-value="setOpts($event, 'image-3')"
            @upload="upload($event, 'image-3')" />
    </page-template>
</template>

<script>
import { PageSection } from '../components/ui'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'HomePage',
    components: {
        PageSection,
        PageTemplate,
    },
    data: function() {
        return {
            errorMessage: 'Formato del file sbagliato, solo mp4',
            header: {
                img: null,
            },
            scuola: {
                title: null,
                txt: null,
                img: null,
            },
            image1: {
                img: null,
            },
            image2: {
                img: null,
            },
            image3: {
                img: null,
            },
            images: {
                img1: null,
                img2: null,
                img3: null,
            },
        }
    },
    methods: {
        upload: function(obj, value) {
            if (obj.img && obj.img != '/storage/') {
                let data = new FormData()
                data.append('type', value)

                if (obj.title) {
                    data.append('title', obj.title)
                }

                if (obj.txt) {
                    data.append('txt', obj.txt)
                }

                let isFile = typeof obj.img.name == 'string'
                if (isFile) {
                    data.append('img', obj.img)
                }


                this.$http.post('/api/admin/storia/save-section', data).then(response => {
                    this.formatResponse(response.data)
                })
            } else {
                this.$emit(value + '-error', 'Selezionare un file')
            }

        },
        setOpts: function(obj, value) {
            switch (value) {
                case 'header':
                    this.header = obj
                    break;
                case 'scuola':
                    this.scuola = obj
                    break;
                case 'images':
                    this.image1 = { img: obj.img1 }
                    this.image2 = { img: obj.img2 }
                    this.image3 = { img: obj.img3 }
                    break;
            }
        },
        getOpts: function() {
            this.$http.get('/api/admin/storia/get-options').then(response => {
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            this.header = data.header
            this.scuola = data.scuola
            this.images = data.images
            this.image1 = { img: data.images.img1 }
            this.image2 = { img: data.images.img2 }
            this.image3 = { img: data.images.img3 }
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
