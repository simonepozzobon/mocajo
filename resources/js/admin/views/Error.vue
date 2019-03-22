<template lang="html">
    <page-template title="404">
        <page-section
            title="Pagina di errore"
            idx="error"
            :default-value="this.error"
            :disable-image="true"
            @changed-value="setOpts($event, 'error')"
            @upload="upload($event, 'error')"/>
    </page-template>
</template>

<script>
import { PageSection, SeoGroup } from '../components/ui'
import PageTemplate from '../containers/PageTemplate.vue'

export default {
    name: 'Privacy',
    components: {
        PageSection,
        PageTemplate,
        SeoGroup,
    },
    data: function() {
        return {
            error: {
                title: null,
                title_en: null,
                txt: null,
                txt_en: null,
            },
        }
    },
    methods: {
        upload: function(obj, value) {
            let data = new FormData()
            data.append('title', obj.title)
            data.append('title_en', obj.title_en)
            data.append('txt', obj.txt)
            data.append('txt_en', obj.txt_en)

            this.$http.post('/api/admin/error/save-section', data).then(response => {
                this.formatResponse(response.data)
            })
        },
        setOpts: function(obj, value) {
            this.error = obj
        },
        getOpts: function() {
            this.$http.get('/api/admin/error/get-options').then(response => {
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            this.error = data.error
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
