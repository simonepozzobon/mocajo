<template lang="html">
    <page-template title="Homepage">
        <seo-group
            :page-id="1" />

        <page-section
            title="Video Principale"
            idx="video"
            :disable-title="true"
            :disable-txt="true"
            :is-video="true"
            :default-value="this.video"
            @changed-value="setOpts($event, 'video')"
            @upload="upload($event, 'video')"/>
    </page-template>
</template>

<script>
import PageTemplate from '../containers/PageTemplate.vue'
import { PageSection } from '../components/ui'
import { SeoGroup } from '../components/ui'
import 'video.js/dist/video-js.css'
import { videoPlayer } from 'vue-video-player'

export default {
    name: 'HomePage',
    components: {
        PageTemplate,
        PageSection,
        SeoGroup,
        videoPlayer,
    },
    data: function() {
        return {
            video: {
                img: null
            },
        }
    },
    methods: {
        upload: function(obj, value) {
            if (obj.img && obj.img != '/storage/') {
                let data = new FormData()
                let isFile = typeof obj.img.name == 'string'
                if (isFile) {
                    data.append('video', obj.img)
                }
                this.$http.post('/api/admin/homepage/upload-video', data).then(response => {
                    this.video = {
                        img: response.data
                    }
                })
            } else {
                this.$emit(value + '-error', 'Selezionare un file')
            }
        },
        setOpts: function(obj, value) {
            this.video = obj
        },
        getVideo: function() {
            this.$http.get('/api/admin/homepage/get-video').then(response => {
                this.video = {
                    img: response.data
                }
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
