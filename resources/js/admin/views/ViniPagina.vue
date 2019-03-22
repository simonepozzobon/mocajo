<template lang="html">
    <page-template title="Vini">
        <seo-group
            :page-id="5" />
        <page-section
            title="Header"
            idx="header"
            :disable-txt="false"
            :default-value="this.header"
            @changed-value="setOpts($event, 'header')"
            @upload="upload($event, 'header')"/>
    </page-template>
</template>

<script>
import { PageSection, SeoGroup } from '../components/ui'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'ScuolaMocajo',
    components: {
        PageSection,
        PageTemplate,
        SeoGroup,
    },
    data: function() {
        return {
            errorMessage: 'Formato del file sbagliato, solo mp4',
            header: {
                title: null,
                title_en: null,
                txt: null,
                txt_en: null,
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
                data.append('title', obj.title)
                data.append('title_en', obj.title_en)
                data.append('txt', obj.txt)
                data.append('txt_en', obj.txt_en)
                data.append('alt', obj.alt)
                data.append('alt_en', obj.alt_en)
                data.append('image_title', obj.image_title)
                data.append('image_title_en', obj.image_title_en)

                let isFile = typeof obj.img.name == 'string'
                if (isFile) {
                    data.append('img', obj.img)
                }


                this.$http.post('/api/admin/vini/save-section', data).then(response => {
                    this.formatResponse(response.data)
                })
            } else {
                this.$emit(value + '-error', 'Selezionare un file')
            }

        },
        setOpts: function(obj, value) {
            this.header = obj
        },
        getOpts: function() {
            this.$http.get('/api/admin/vini/get-options').then(response => {
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            this.header = data.header
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
