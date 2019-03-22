<template lang="html">
    <div
        ref="block"
        class="col-12 ui-hero-banner"
        :class="color +' '+ overlayClass"
        :title="image_title">

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
        },
        noOverlay: {
            type: Boolean,
            default: false,
        },
        minHeight: {
            type: String,
            default: null,
        },
        minHeightMobile: {
            type: String,
            default: null,
        },
        alt: {
            type: String,
            default: null,
        },
        image_title: {
            type: String,
            default: null,
        },
    },
    computed: {
        overlayClass: function() {
            if (this.noOverlay) {
                return 'no-overlay'
            }
            return null
        }
    },
    watch: {
        '$root.window': function(w) {
            this.setHeight()
        }
    },
    methods: {
        setHeight: function() {
            if (this.minHeightMobile && this.$root.isMobile) {
                this.$refs.block.style.minHeight = this.minHeightMobile
            }
        },
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
        this.setHeight()
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

    &.no-overlay {

        .ui-hero-banner-overlay {
            display: none;
        }

        .ui-hero-banner-title {
            display: none;
        }
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
