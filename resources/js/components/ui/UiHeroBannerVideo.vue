<template lang="html">
    <div class="col-12 ui-hero-banner" :class="color" ref="block">
        <video-bg :sources="[this.videoSrc]" :img="this.imgSrc" ref="player">
        </video-bg>
    </div>
</template>

<script>
import VideoBg from 'vue-videobg'

export default {
    name: 'UiHeroBannerVideo',
    components: {
        VideoBg
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
        }
    },
    methods: {
    },
    mounted: function() {
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-hero-banner {
    min-height: 50vh;
    max-height: 50vh;
    padding: 0;
    overflow: hidden;

    > .VideoBg {
        top: -50%;
    }
}
</style>
