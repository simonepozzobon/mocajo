<template lang="html">
    <div class="col-12 ui-hero-banner" :class="color" ref="block">
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
        }
    },
    methods: {
        setBackground: function() {
            if (this.imgSrc) {
                this.$refs.block.style.backgroundImage = 'url('+this.imgSrc+')'
            }
        }
    },
    mounted: function() {
        this.setBackground()
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

    @media (min-width: 64.0625em){
        height: 36vw;
    }

    @media (min-width: 48em){
        height: 31.5vw;
    }
}
</style>
