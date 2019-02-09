<template lang="html">
    <div class="col-md-6 ui-image-block" :class="color" ref="block">
        <figure class="effect-roxy" :class="animateDirection">
            <img :src="imgSrc" alt="img01"/>
        </figure>
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
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-image-block {
    min-height: 30vh;
    position: relative;
	list-style: none;
	text-align: center;
    padding: 0;
    object-fit: fill;

    figure {
        position: relative;
    	float: left;
    	overflow: hidden;
    	text-align: center;
        cursor: pointer;
        margin: 0;

        img {
            position: relative;
            display: block;
            opacity: 0.8;
            width: 100%;
            height: auto;
        }

        &.effect-roxy {

            img {
            	max-width: none;
            	width: 120%;
            	transition: opacity 0.35s, transform 0.35s;
            }

            &.from-left-to-right-animation {
                img {
                    transform: translate3d(-50px,0,0);
                }
            }
            &.from-right-to-left-animation {
                img {
                    transform: translate3d(0,0,0);
                }
            }

            &:hover {
                img {
                    opacity: 0.7;
                    transform: translate3d(0,0,0);

                }

                &.from-right-to-left-animation {
                    img {
                        transform: translate3d(-50px,0,0);
                    }
                }
            }


        }
    }

}
</style>
