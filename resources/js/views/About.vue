<template lang="html">
    <div class="container">
        <div id="section-one" class="trigger"></div>
        <div class="row section">
            <div class="col-md-6">
                <h1 ref="title">La Scuola di Mocajo</h1>
                <p ref="description">
                    Mauris tempus, augue gravida lacinia hendrerit, orci sem pretium augue, nec tempor mi turpis in tortor. Sed porta lectus in quam sodales, venenatis fermentum magna convallis. Morbi vel laoreet est, vitae euismod magna. Nulla facilisi. Nunc ornare, erat ut iaculis sagittis, lectus tellus tincidunt dolor, tristique pulvinar felis nisl finibus neque. Nunc maximus risus at felis ultrices bibendum sit amet nec velit. Fusce sit amet purus velit. Pellentesque blandit turpis eu lacus ullamcorper pharetra. Phasellus tincidunt leo in lectus congue facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed a risus accumsan, ullamcorper urna et, scelerisque nulla.
                </p>
            </div>
            <div class="col-md-6">
                <img src="/images/about.jpg" alt="" class="img-fluid" ref="image">
            </div>
        </div>
    </div>
</template>

<script>
import {TimelineMax} from 'gsap'
import ScrollMagic from 'scrollmagic'
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'

export default {
    name: 'LaScuola',
    data: function() {
        return {
            controller: null
        }
    },
    methods: {
        init: function() {
            // this.controller = new ScrollMagic.Controller()
            // let scuola = new ScrollMagic.Scene({
            //     triggerElement: '#section-one',
            //     offset: 0,
            //     duration: 200,
            //     triggerHook: 'onEnter'
            // })
            //     .addIndicators({ name: 'about'})
            //     // .setTween(master)
            //     .addTo(this.controller)
        },
        animate: function() {
            let title = this.$refs.title,
            description = this.$refs.description,
            image = this.$refs.image

            let master = new TimelineMax({
                paused: true
            })

            master.from(title, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, .1)

            master.from(description, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, .2)

            master.from(image, .8, {
                autoAlpha: 0,
                x: 60,
                ease: Power2.easeOut
            }, .4)

            master.play()
        }
    },
    mounted: function() {
        // this.$root.navbar = 1
        this.init()
        this.animate()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.section {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
