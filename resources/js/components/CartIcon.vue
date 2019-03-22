<template lang="html">
    <svg :width="width" viewBox="0 0 128 128" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="cart" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <path d="M49.4615385,107.923077 C49.4615385,113.223558 45.0697115,117.615385 39.7692308,117.615385 C34.46875,117.615385 30.0769231,113.223558 30.0769231,107.923077 C30.0769231,102.622596 34.46875,98.2307692 39.7692308,98.2307692 C45.0697115,98.2307692 49.4615385,102.622596 49.4615385,107.923077 Z M117.307692,107.923077 C117.307692,113.223558 112.915865,117.615385 107.615385,117.615385 C102.314904,117.615385 97.9230769,113.223558 97.9230769,107.923077 C97.9230769,102.622596 102.314904,98.2307692 107.615385,98.2307692 C112.915865,98.2307692 117.307692,102.622596 117.307692,107.923077 Z M127,25.5384615 L127,64.3076923 C127,66.7307692 125.106971,68.8509615 122.683894,69.1538462 L43.6310096,78.3918269 C44.0096154,80.1334135 44.6153846,81.875 44.6153846,83.6923077 C44.6153846,85.4338942 43.5552885,87.0240385 42.7980769,88.5384615 L112.461538,88.5384615 C115.111779,88.5384615 117.307692,90.734375 117.307692,93.3846154 C117.307692,96.0348558 115.111779,98.2307692 112.461538,98.2307692 L34.9230769,98.2307692 C32.2728365,98.2307692 30.0769231,96.0348558 30.0769231,93.3846154 C30.0769231,91.0372596 33.484375,85.3581731 34.6959135,83.0108173 L21.2932692,20.6923077 L5.84615385,20.6923077 C3.19591346,20.6923077 1,18.4963942 1,15.8461538 C1,13.1959135 3.19591346,11 5.84615385,11 L25.2307692,11 C30.3040865,11 30.4555288,17.0576923 31.2127404,20.6923077 L122.153846,20.6923077 C124.804087,20.6923077 127,22.8882212 127,25.5384615 Z" :fill="color" ref="item"></path>
        </g>
    </svg>
</template>

<script>
import {TimelineMax} from 'gsap'
require('gsap/ScrollToPlugin')
export default {
    name: 'CartIcon',
    props: {
        width: {
            type: String,
            default: '32px'
        },
        color: {
            type: String,
            default: '#000000'
        }
    },
    methods: {
        play: function() {
            let master = new TimelineMax({
                paused: true
            })

            master.set(this.$refs.item, {
                trasformOrigin: 'center center',
                autoAlpha: 1,
            })

            master.to(window, .2, {
                scrollTo: {
                    y:0,
                    autokill: false,
                },
            })

            master.fromTo(this.$refs.item, .2, {
                fill: '#666',
                scale: 1,
            },{
                fill: 'rgb(250, 200, 35)',
                scale: 0.7,
                ease: Power2.easeInOut,
            })

            master.to(this.$refs.item, .3, {
                scale: 1,
                ease: Back.easeInOut,
            })

            master.to(this.$refs.item, .6, {
                fill: this.color,
                ease: Power2.easeInOut,
            }, .6)

            master.play()
        },
        hide: function() {
            let master = new TimelineMax({
                paused: true
            })

            master.to(this.$refs.item, .5, {
                autoAlpha: 0,
            })

            master.play()
        }

    }
}
</script>

<style lang="scss">
</style>
