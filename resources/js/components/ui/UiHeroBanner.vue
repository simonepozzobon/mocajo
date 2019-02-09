<template lang="html">
    <div class="col-12 ui-hero-banner" :class="color" ref="block">
        <div class="overlay" ref="overlay"></div>
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

            master.fromTo(this.$refs.overlay, 1.7, {
                width: '30%',
                autoAlpha: 1,
            }, {
                width: 0,
                autoAlpha: 0,
                ease: Sine.easeInOut,
            })

            master.progress(1).progress(0)
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

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background-color: $black;
    }

    @media (min-width: 64.0625em){
        height: 36vw;
    }

    @media (min-width: 48em){
        height: 31.5vw;
    }
}
</style>
