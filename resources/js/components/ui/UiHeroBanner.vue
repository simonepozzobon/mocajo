<template lang="html">
    <div class="col-12 ui-hero-banner" :class="color" ref="block">
        <div class="ui-hero-banner-overlay" ref="overlay"></div>
        <h1 class="ui-hero-banner-title text-white text-center" ref="title" v-html="title"></h1>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'UiHeroBanner',
    props: {
        color: {
            type: String,
            default: null,
        },
        title: {
            type: String,
            default: null,
        },
        imgSrc: {
            type: String,
            default: null,
        },
        animated: {
            type: Boolean,
            default: true,
        }
    },
    methods: {
        setBackground: function() {
            if (this.imgSrc) {
                this.$refs.block.style.backgroundImage = 'url('+this.imgSrc+')'
            }
        },
        animateIn: function() {
            let master = new TimelineMax({
                paused: true,
            })
            let overlay = this.$refs.overlay
            let title = this.$refs.title

            master.fromTo(overlay, 1.7, {
                autoAlpha: 1,
                xPercent: 0,
            }, {
                xPercent: 100,
                autoAlpha: 0,
                ease: Sine.easeInOut,
            }, 0)

            master.fromTo(title, 2.7, {
                opacity: 0,
            }, {
                opacity: 1,
                ease: Sine.easeInOut,
            }, 0)

            // master.progress(1).progress(0)
            master.play()
        }
    },
    mounted: function() {
        this.setBackground()
        this.animateIn()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-hero-banner {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    padding: $spacer * 4;
    display: flex;
    align-items: center;
    justify-content: center;

    .ui-hero-banner-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background-color: $black;
    }

    .ui-hero-banner-title {
        letter-spacing: 2px;
        opacity: 0;
        z-index: 1;
        font-weight: 400;

        &::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            top: 0;
            left: 0;
            background-color: rgba($black, 0.2);
            box-shadow: inset 0 0 80vw 0 rgba($black, 0.5);
        }
    }

    @media (min-width: 64.0625em){
        height: 36vw;
    }

    @media (min-width: 48em){
        height: 31.5vw;
    }
}
</style>
