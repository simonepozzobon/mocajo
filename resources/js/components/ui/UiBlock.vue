<template lang="html">
    <div :class="size + ' ui-block ' + color + ' ' + alignClass + ' ' + noPaddingClass + ' ' + isFullHeight" ref="block">
        <div class="ui-block-container" ref="container">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UIBlock',
    props: {
        color: {
            type: String,
            default: null
        },
        imgSrc: {
            type: String,
            default: null,
        },
        animated: {
            type: Boolean,
            default: false,
        },
        direction: {
            type: Boolean,
            default: null, // true -> anima da sinistra verso destra
        },
        flexAlign: {
            type: String,
            default: null,
        },
        disablePadding: {
            type: Boolean,
            default: false,
        },
        size: {
            type: String,
            default: 'col-md-6'
        },
        fullHeight: {
            type: Boolean,
            default: false,
        },
        minHeight: {
            type: Boolean,
            default: false,
        },
        minHeightSize: {
            type: String,
            default: null,
        },

    },
    data: function() {
        return {
            isAnimated: null,
        }
    },
    computed: {
        alignClass: function() {
            if (this.flexAlign == 'top') {
                return 'ui-block-align-top'
            }
            return null
        },
        noPaddingClass: function() {
            if (this.disablePadding) {
                return 'ui-block-no-padding'
            }
            return null
        },
        isFullHeight: function() {
            if (this.fullHeight) {
                return 'ui-block-full-height'
            }
            return null
        }
    },
    watch: {
        '$root.isMobile': function(isMobile) {
            this.setAnimationsMobile()
        }
    },
    methods: {
        setAnimationsMobile: function() {
            if (this.$root.isMobile) {
                this.isAnimated = false
                this.animateIn()
            }
        },
        setBackground: function() {
            if (this.imgSrc) {
                this.$refs.block.style.backgroundImage = 'url('+this.imgSrc+')'
            }
        },
        animateIn: function() {
            if (this.isAnimated) {
                let master = new TimelineMax({
                    paused: true
                })

                master.fromTo(this.$refs.container, 3, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                    ease: Circ.easeInOut
                }, 0)

                master.play()
            } else {
                TweenMax.set(this.$refs.container, {
                    autoAlpha: 1,
                })
            }
        }
    },
    mounted: function() {
        this.setBackground()
        this.isAnimated = this.animated
        this.setAnimationsMobile()
        if (!this.animated) {
            this.animateIn()
        }

        if (this.minHeight && this.minHeightSize) {
            this.$refs.block.style.minHeight = this.minHeightSize
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-block {
    min-height: 30vh;
    min-height: 400px;
    background-size: cover;
    background-position: center;
    padding: $spacer * 4;
    display: flex;
    justify-content: center;
    align-items: center;

    &.ui-block-no-padding {
        padding: 0;
    }

    @media (min-width: 64.0625em) {
        padding: 13.5vh 7.7vw 11.7vh;

        &.ui-block-no-padding {
            padding: 0;
        }
    }
    @media (min-width: 48em) {
        padding: 8.5vh 6.8vw;

        &.ui-block-no-padding {
            padding: 0;
        }
    }

    @include media-breakpoint-down('sm') {
        min-height: auto !important;
    };

    .ui-block-container {
        opacity: 0;
        padding-right: 9.4%;
        width: 100%;
    }

    &.ui-block-no-padding {
        .ui-block-container {
            padding-right: 0;
        }
    }

    &.ui-block-align-top {
        align-items: flex-start !important;
    }

    &.ui-block-full-height {
        min-height: calc(100vh - 130px) !important;

        @include media-breakpoint-down('sm') {
            min-height: calc(100vh - 90px) !important;
        }
    }
}
</style>
