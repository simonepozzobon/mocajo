<template lang="html">
    <page-template title="Scuola Mocajo">
        <seo-group
            :page-id="2" />
        <page-section
            title="Header"
            idx="header"
            :disable-txt="true"
            :default-value="this.header"
            @changed-value="setOpts($event, 'header')"
            @upload="upload($event, 'header')"/>
        <page-section
            title="Progetto"
            idx="project"
            :default-value="this.project"
            @changed-value="setOpts($event, 'project')"
            @upload="upload($event, 'project')"/>
        <page-section
            title="Famiglia"
            idx="family"
            :default-value="this.family"
            @changed-value="setOpts($event, 'family')"
            @upload="upload($event, 'family')"/>
        <page-section
            title="Agriturismo"
            idx="agriturismo"
            :default-value="this.agriturismo"
            @changed-value="setOpts($event, 'agriturismo')"
            @upload="upload($event, 'agriturismo')"/>
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
                title_en: null,
                txt_en: null,
                img: null,
            },
            project: {
                title: null,
                txt: null,
                title_en: null,
                txt_en: null,
                img: null,
            },
            family: {
                title: null,
                txt: null,
                title_en: null,
                txt_en: null,
                img: null,
            },
            agriturismo: {
                title: null,
                txt: null,
                title_en: null,
                txt_en: null,
                img: null,
            },
        }
    },
    methods: {
        upload: function(obj, value) {
            if (obj.img && obj.img != '/storage/') {
                let data = new FormData()
                data.append('type', value)
                data.append('title', obj.title)
                data.append('txt', obj.txt)
                data.append('title_en', obj.title_en)
                data.append('txt_en', obj.txt_en)

                let isFile = typeof obj.img.name == 'string'
                if (isFile) {
                    data.append('img', obj.img)
                }


                this.$http.post('/api/admin/scuolamocajo/save-section', data).then(response => {
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
                case 'project':
                    this.project = obj
                    break;
                case 'family':
                    this.family = obj
                    break;
                case 'agriturismo':
                    this.agriturismo = obj
                    break;
            }
        },
        getOpts: function() {
            this.$http.get('/api/admin/scuolamocajo/get-options').then(response => {
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            this.header = data.header
            this.project = data.project
            this.family = data.family
            this.agriturismo = data.agriturismo
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
