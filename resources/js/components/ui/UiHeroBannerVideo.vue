<template lang="html">
    <div class="col-12 ui-hero-banner-video" :class="color" ref="block">
        <video-bg :sources="[this.videoSrc]" :img="this.imgSrc" ref="player">
            <video-controls
                v-if="this.hasControls"
                @mute="toggleMute(true)"
                @unmute="toggleMute(false)"/>
        </video-bg>
    </div>
</template>

<script>
import VideoBg from 'vue-videobg'
import VideoControls from '../VideoControls.vue'

export default {
    name: 'UiHeroBannerVideo',
    components: {
        VideoBg,
        VideoControls
    },
    props: {
        color: {
            type: String,
            default: null,
        },
        videoSrc: {
            type: String,
            default: null,
        },
        imgSrc: {
            type: String,
            default: null,
        },
        hasControls: {
            type: Boolean,
            default: false,
        }
    },
    methods: {
        toggleMute: function(status) {
            let player = this.$refs.player
            let video = player.$refs.video
            video.muted = status
        }
    },
    mounted: function() {
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-hero-banner-video {
    min-height: 50vh;
    max-height: 50vh;
    padding: 0;
    overflow: hidden;

    > .VideoBg {
        top: -50%;

        .VideoBg__content {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
}
</style>
