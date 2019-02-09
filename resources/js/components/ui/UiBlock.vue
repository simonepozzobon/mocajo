<template lang="html">
    <div class="col-md-6 ui-block" :class="color" ref="block">
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
            default: false, // true -> anima da sinistra verso destra
        },
        direction: {
            type: Boolean,
            default: null, // true -> anima da sinistra verso destra
        }
    },
    methods: {
        setBackground: function() {
            if (this.imgSrc) {
                this.$refs.block.style.backgroundImage = 'url('+this.imgSrc+')'
            }
        },
        animateIn: function() {
            if (this.animated) {
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

    background-size: cover;
    background-position: center;
    padding: $spacer * 4;
    
    @media (min-width: 64.0625em) {
        padding: 13.5vh 7.7vw 11.7vh;
    }
    @media (min-width: 48em) {
        padding: 8.5vh 6.8vw;
    }

    .ui-block-container {
        opacity: 0;
        padding-right: 9.4%;
    }


}
</style>
