<template>
    <div class="bg-video">
        <video playsinline autoplay muted loop :poster="poster" class="background-vid">
            <source :src="videoSrcWebm" type="video/webm">
            <source :src="videoSrcMp4" type="video/mp4">
        </video>
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        videoSrcWebm: {
            default: '',
            type: String
        },
        videoSrcMp4: {
            default: '',
            type: String
        },
        poster: {
            default: '',
            default: String
        },
        textOverlay: {
            default: false,
            type: Boolean
        },
        textHeadline: {
            default: '',
            type: String
        },
        textSubtitle: {
            default: '',
            type: String
        },
        textBody: {
            default: '',
            type: String
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';

.bg-video {
    height: 100%;

    &::after {
        content: '';
        position: absolute;
        width: 100vw;
        height: 100vh;
        z-index: -99;
        top: 0;
        left: 0;
        background-color: rgba($black, 0.5);
        box-shadow: inset 0 0 80vw 0 rgba($black, 1);
    }
}

.background-vid {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100vw;
    min-height: 100vh;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
    background-size: cover;
}
</style>
