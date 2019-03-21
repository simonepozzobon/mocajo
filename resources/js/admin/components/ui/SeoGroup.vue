<template lang="html">
    <div>
        <panel-block title="Seo">
            <form-group name="seo_title" title="Titolo">
                <input type="text" name="seo_title" v-model="seo.title" class="form-control">
            </form-group>
            <form-group name="seo_title_en" title="Titolo [eng]">
                <input type="text" name="seo_title_en" v-model="seo.title_en" class="form-control">
            </form-group>
            <form-group name="seo_description" title="Descrizione">
                <textarea name="seo_description" rows="4" cols="80" v-model="seo.description" class="form-control"></textarea>
            </form-group>
            <form-group name="seo_description_en" title="Descrizione [eng]">
                <textarea name="seo_description_en" rows="4" cols="80" v-model="seo.description_en" class="form-control"></textarea>
            </form-group>
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

export default {
    name: 'SeoGroup',
    components: {
        FormGroup,
        PanelBlock,
    },
    props: {
        pageId: {
            type: Number,
            default: 0,
        }
    },
    data: function() {
        return {
            seo: {
                title: null,
                description: null,
                isEdit: null,
            }
        }
    },
    methods: {
        getSeo: function() {
            this.$http.get('/api/admin/seo/page/'+ this.pageId).then(response => {
                this.formatResponse(response.data)
            })
        },
        upload: function() {
            let data = new FormData()
            data.append('page_id', this.pageId)
            if (this.seo.isEdit) {
                data.append('idx', this.seo.isEdit)
            }
            data.append('title', this.seo.title)
            data.append('title_en', this.seo.title_en)
            data.append('description', this.seo.description)
            data.append('description_en', this.seo.description_en)

            this.$http.post('/api/admin/seo/save', data).then(response => {
                console.log(response);
                this.formatResponse(response.data)
            })
        },
        formatResponse: function(data) {
            if (data) {
                this.seo = {
                    title: data.title,
                    title_en: data.title_en,
                    description: data.description,
                    description_en: data.description_en,
                    isEdit: data.id
                }
            }

        }
    },
    mounted: function() {
        this.getSeo()
    }
}
</script>

<style lang="css" scoped>
</style>
