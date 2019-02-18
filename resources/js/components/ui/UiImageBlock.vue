<template lang="html">
    <div class="col-md-6 ui-image-block" ref="block" v-view.once="handler">
        <div class="overlay" ref="overlay"></div>
        <div class="image-container" :class="animateDirection" ref="img">
        </div>
    </div>
</template>
<script>
export default {
	name: 'UiImageBlock',
	props: {
		color: {
			type: String,
			default: null
		},
		imgSrc: {
			type: String,
			default: null,
		},
		direction: {
			type: Boolean,
			default: true, // true -> anima da sinistra verso destra
		},
        animated: {
			type: Boolean,
			default: false, // true -> anima da sinistra verso destra
		},
        viewportTracking: {
			type: Boolean,
			default: true, // true -> anima da sinistra verso destra
		},
	},
    data: function() {
        return {
            initialized: false,
        }
    },
    computed: {
        animateDirection: function() {
            if (this.direction) {
                return 'from-left-to-right-animation'
            }
            return 'from-right-to-left-animation'
        }
    },
    methods: {
        handler: function(e) {
            if (e.percentInView > 0) {
                this.animateIn()
            }
        },
        setBackground: function() {
            this.$refs.img.style.backgroundImage = 'url('+this.imgSrc+')'
        },
        animateIn: function() {
            if (!this.initialized) {
                let master = new TimelineMax({
                    paused: true,
                    id: "reveal"
                })

                master.fromTo(this.$refs.img, 1.25, {
                    autoAlpha: 0
                }, {
                    autoAlpha: 1,
                    clearProps: 'opacity',
                    ease: Cubic.easeInOut,
                }, 0.1)

                if (!this.direction) {
                    master.fromTo(this.$refs.overlay, 1.7, {
                        width: '100%',
                    }, {
                        onStart: () => {
                            this.$emit('animate-parent')
                        },
                        width: 0,
                        ease: Circ.easeInOut,
                    }, 0)
                } else {
                    master.fromTo(this.$refs.overlay, 1.7, {
                        xPercent: 0,
                    }, {
                        onStart: () => {
                            this.$emit('animate-parent')
                        },
                        xPercent: 100,
                        ease: Circ.easeInOut,
                    }, 0)
                }


                master.fromTo(this.$refs.img, 3, {
                    scale: 1.1,
                }, {
                    scale: 1,
                    clearProps: 'scale',
                }, 2.1)

                this.initialized = true
                master.play()
            }
        },
    },
    mounted: function() {
        this.setBackground()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-image-block {
    min-height: 30vh;
    min-height: 400px;
    position: relative;
    padding: 0;
    overflow: hidden;


    .overlay {
        position: absolute;
        content: '';
        background-color: $light;
        width: 100%;
        height: 100%;
        z-index: 2;
    }

    .image-container {
        width: calc(100% + 60px);
        height: 100%;
        background-size: cover;
        background-position: center;



        &.from-left-to-right-animation {
            transform: translate3d(-50px,0,0);
            transition: all 2s ease-in-out;

            &:hover {
                transform: translate3d(0px,0,0);
            	transition:  all 1.2s ease-in-out;
                opacity: 0.7;
            }

        }

        &.from-right-to-left-animation {
            transform: translate3d(0px,0,0);
            transition:  all 2s ease-in-out;

            &:hover {
                transform: translate3d(-50px,0,0);
                transition:  all 1.2s ease-in-out;
                opacity: 0.7;
            }
        }


    }

}
</style>
