<template lang="html">
    <div :class="size + ' ui-block ' + color + ' ' + alignClass + ' ' + noPaddingClass" ref="block">
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
        }
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
        }
    },
    watch: {
        '$root.isMobile': function(isMobile) {
            if (isMobile) {
                this.isAnimated = false
                this.animateIn()
            }
        }
    },
    methods: {
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
        if (!this.animated) {
            this.animateIn()
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
}
</style>
