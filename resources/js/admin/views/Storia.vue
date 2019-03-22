<template lang="html">
    <page-template title="La Nostra Storia">
        <seo-group
            :page-id="3" />
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
            title="La Storia"
            idx="scuola"
            :disable-link="true"
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
import { PageSection, SeoGroup } from '../components/ui'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'HomePage',
    components: {
        PageSection,
        PageTemplate,
        SeoGroup,
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
                linktxt: null,
                linktxt_en: null,
                linkhref: null,
                linkhref_en: null,
                alt: null,
                alt_en: null,
                image_title: null,
                image_title_en: null,
            },
            image1: {
                img: null,
                alt: null,
                alt_en: null,
                image_title: null,
                image_title_en: null,
            },
            image2: {
                img: null,
                alt: null,
                alt_en: null,
                image_title: null,
                image_title_en: null,
            },
            image3: {
                img: null,
                alt: null,
                alt_en: null,
                image_title: null,
                image_title_en: null,
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

                data = this.setData(data, 'alt', obj)
                data = this.setData(data, 'alt_en', obj)
                data = this.setData(data, 'image_title', obj)
                data = this.setData(data, 'image_title_en', obj)

                this.$http.post('/api/admin/storia/save-section', data).then(response => {
                    this.formatResponse(response.data)
                })
            } else {
                this.$emit(value + '-error', 'Selezionare un file')
            }

        },
        setData: function(data, key, obj) {
            if (obj.hasOwnProperty(key)) {
                data.append(key, obj[key])
            }
            return data
        },
        setOpts: function(obj, value) {
            switch (value) {
                case 'header':
                    this.header = obj
                    break;
                case 'scuola':
                    this.scuola = obj
                    break;
                case 'image-1':
                    this.image1 = obj
                    break;
                case 'image-2':
                    this.image2 = obj
                    break;
                case 'image-3':
                    this.image3 = obj
                    break;
            }
        },
        getOpts: function() {
            this.$http.get('/api/admin/storia/get-options').then(response => {
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            console.log(data);
            this.header = data.header
            this.scuola = data.scuola
            this.image1 = data.image1
            this.image2 = data.image2
            this.image3 = data.image3
            this.$emit('clear-feedback')
        }
    },
    mounted: function() {
        this.getOpts()
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
