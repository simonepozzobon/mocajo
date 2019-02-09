<template lang="html">
    <div class="col-md-6 ui-image-block" ref="block">
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
        isAnyPartOfElementInViewport: function() {
            const rect = this.$refs.block.getBoundingClientRect()
            // DOMRect { x: 8, y: 8, width: 100, height: 100, top: 8, right: 108, bottom: 108, left: 8 }
            const windowHeight = (window.innerHeight || document.documentElement.clientHeight)
            const windowWidth = (window.innerWidth || document.documentElement.clientWidth)


            // http://stackoverflow.com/questions/325933/determine-whether-two-date-ranges-overlap
            const vertInView = (rect.top <= windowHeight) && ((rect.top + rect.height) >= 0)
            const horInView = (rect.left <= windowWidth) && ((rect.left + rect.width) >= 0)


            return (vertInView && horInView)
        },
        isOnViewPort: function() {
            let rect = this.$refs.block.getBoundingClientRect()
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document. documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document. documentElement.clientWidth)
            )
        },
        setBackground: function() {
            this.$refs.img.style.backgroundImage = 'url('+this.imgSrc+')'
        },
        animateIn: function() {
            if (!this.initialized) {
                let master = new TimelineMax({
                    paused: true
                })

                master.fromTo(this.$refs.img, 3, {
                    scale: 1.1,
                }, {
                    scale: 1,
                    clearProps: 'scale',
                })

                this.initialized = true
                master.play()
            }
        },
    },
    mounted: function() {
        this.setBackground()
        let isOnViewPort = this.isAnyPartOfElementInViewport()
        if (isOnViewPort) {
            this.animateIn()
        }
        if (this.viewportTracking) {
            window.addEventListener('scroll', () => {
                let isOnViewPort = this.isAnyPartOfElementInViewport()
                if (isOnViewPort) {
                    this.animateIn()
                }
            })
        }

    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-image-block {
    min-height: 30vh;
    position: relative;
    padding: 0;
    overflow: hidden;

    .image-container {
        width: calc(100% + 60px);
        height: 100%;
        background-size: cover;
        background-position: center;

        &.from-left-to-right-animation {
            transform: translate3d(-50px,0,0);
            transition: $transition-base;

            &:hover {
                transform: translate3d(0px,0,0);
            	transition: $transition-base;
                opacity: 0.7;
            }

        }

        &.from-right-to-left-animation {
            transform: translate3d(0px,0,0);
            transition: $transition-base;

            &:hover {
                transform: translate3d(-50px,0,0);
                transition: $transition-base;
                opacity: 0.7;
            }
        }


    }

}
</style>
