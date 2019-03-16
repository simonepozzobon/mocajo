<template lang="html">
    <div
        id="menu-anim"
        ref="container"
        :style="'width: '+this.size+'; height: '+this.size+';'">
    </div>
</template>

<script>
import axios from 'axios'
import lottie from 'lottie-web'
import * as MenuData from '../animations/Menu.json'


export default {
    name: 'Menu',
    props: {
        size: {
            type: String,
            default: '32px'
        },
        speed: {
            type: Number,
            default: 1,
        }
    },
    data: function() {
        return {
            anim: null,
            height: 0,
            loaded: false,
            duration: 0,
            split: 0,
            opened: false,
            data: null,
            hovering: false,
        }
    },
    watch: {
        opened: function(value) {
            this.$root.menuStatus = value
            this.$emit('changeStatus', value)
        }
    },
    methods: {
        hoverAnim: function() {
            if (!this.hovering && !this.opened) {
                this.hovering = true
                this.anim.playSegments([0, 76], true)
                this.anim.addEventListener('complete', () => {
                    this.hovering = false
                })
            }
        },
        open: function() {
            this.anim.playSegments([76, 124], true)
            this.anim.addEventListener('complete', () => {
                this.opened = true
            })
        },
        close: function() {
            this.anim.playSegments([125, 175], true)
            this.anim.addEventListener('complete', () => {
                this.opened = false
            })
        },
        getData: function() {
            axios.get('/js/animations/Menu.json').then(response => {
                this.data = response.data
                this.init()
            })
        },
        init: function() {
            this.anim = lottie.loadAnimation({
                container: this.$refs.container,
                renderer: 'svg',
                loop: false,
                autoplay: true,
                animationData: MenuData,
                prerender: true,
                name: 'MenuAnim',
                rendererSettings: {
                    progressiveLoad:false,
                    preserveAspectRatio:'xMidYMid meet'
                    // clearCanvas: true,
                }
            })
            this.anim.setSubframe(false);
            this.duration = this.anim.getDuration(true)
            this.split = this.duration / 2
            this.anim.setSpeed(this.speed)
            this.anim.pause()
            this.loaded = true
        }
    },
    mounted: function() {
        this.init()
    }
}
</script>

<style lang="scss">
</style>
