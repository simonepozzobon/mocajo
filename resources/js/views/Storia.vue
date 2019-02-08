<template lang="html">
    <div class="container-fluid storia-mocajo" ref="section">
        <div class="row">
            <ui-hero-banner-video
                videoSrc="/video/home.mp4"
                imgSrc="/images/tenuta.jpg"
                />
        </div>
        <div class="row">
            <ui-block
                color="bg-light">
                <ui-title
                    title="La Vecchia Scuola Di Mocajo" />
                <p>
                    Adagiata su morbide colline toscane, a ridosso della costa degli Etruschi, nasceva nel 1942 Scuola Mocajo, intitolata a Riccardo Perucchetti e fondata per accudire i figli dei mezzadri che lavoravano nella Tenuta. Abbandonata a sé stessa per molti anni e ormai diroccata, oggi, grazie a un progetto di profondo restauro, riprende vita ed è pronta a scrivere una nuova storia.
                </p>
            </ui-block>
            <ui-block
                :isImage="true"
                imgSrc="/images/tenuta.jpg" />
        </div>
    </div>
</template>

<script>
import { UiBlock, UiHeroBannerVideo, UiTitle } from '../components/ui'
import { TimelineMax } from 'gsap'
import ScrollMagic from 'scrollmagic'
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'

export default {
    name: 'LaScuola',
    components: {
        UiBlock,
        UiHeroBannerVideo,
        UiTitle,
    },
    data: function() {
        return {
            controller: null,
            about: false,
            tenuta: false,
            scuola: false,
        }
    },
    methods: {
        init: function() {
            this.controller = new ScrollMagic.Controller()
            let scuola = new ScrollMagic.Scene({
                triggerElement: '#section-one',
                offset: 0,
                duration: 200,
                triggerHook: 'onEnter'
            })
                // .addIndicators({ name: 'about'})
                // .setTween(master)
                .addTo(this.controller)
            let tenuta = new ScrollMagic.Scene({
                triggerElement: '#section-two',
                offset: 0,
                duration: 200,
                triggerHook: 'onEnter'
            })
                // .addIndicators({ name: 'tenuta'})
                .on('enter', () => {
                    if (!this.tenuta) {
                        let objs = {
                            title: '#about-tenuta',
                            description: '#about-tenuta-description',
                            image: '#about-tenuta-image'
                        }
                        this.animate(objs)
                        this.tenuta = true
                    }
                })
                .addTo(this.controller)
            let storia = new ScrollMagic.Scene({
                triggerElement: '#section-three',
                offset: 0,
                duration: 200,
                triggerHook: 'onEnter'
            })
                // .addIndicators({ name: 'storia'})
                .on('enter', () => {
                    if (!this.storia) {
                        let objs = {
                            title: '#about-storia',
                            description: '#about-storia-description',
                            image: '#about-storia-image'
                        }
                        this.animate(objs)
                        this.storia = true
                    }
                })
                .addTo(this.controller)
        },
        animate: function(objs = null) {
            let title, description, image
            if (objs) {
                title = objs.title
                description = objs.description
                image = objs.image
            } else {
                title = this.$refs.title
                description = this.$refs.description
                image = this.$refs.image
            }


            let master = new TimelineMax({
                paused: true
            })

            master.fromTo(title, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeInOut
            }, .1)

            master.fromTo(description, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeInOut
            }, .2)

            master.fromTo(image, .8, {
                autoAlpha: 0,
                x: 60,
                ease: Power2.easeOut
            }, {
                autoAlpha: 1,
                x: 0,
                ease: Power2.easeOut
            }, .4)

            master.play()
        }
    },
    mounted: function() {
        this.$refs.section.style.paddingTop = '130px';
        // this.$root.navbar = 1
        // this.init()
        // this.animate()
        // TweenMax.set(['#about-tenuta','#about-tenuta-description','#about-tenuta-image', '#about-storia', '#about-storia-description', '#about-storia-image'], {
        //     autoAlpha: 0,
        // })
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
