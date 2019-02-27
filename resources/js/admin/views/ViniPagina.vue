<template lang="html">
    <page-template title="Vini">
        <seo-group
            :page-id="5" />
        <page-section
            title="Header"
            idx="header"
            :disable-txt="true"
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
                txt: null,
                img: null,
            },
        }
    },
    methods: {
        upload: function(obj, value) {
            if (obj.img && obj.img != '/storage/') {
                let data = new FormData()
                data.append('title', obj.title)
                data.append('txt', obj.txt)

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
