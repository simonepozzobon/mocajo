<template lang="html">
    <div class="container-fluid storia-mocajo section" ref="section">
        <div class="row">
            <ui-hero-banner-video
                videoSrc="/video/home.mp4"
                imgSrc="/images/tenuta.jpg"
                />
        </div>
        <div class="row">
            <ui-block
                ref="storia"
                :animated="true"
                color="bg-light">
                <ui-title
                    title="La Vecchia Scuola Di Mocajo" />
                <p>
                    Adagiata su morbide colline toscane, a ridosso della costa degli Etruschi, nasceva nel 1942 Scuola Mocajo, intitolata a Riccardo Perucchetti e fondata per accudire i figli dei mezzadri che lavoravano nella Tenuta. Abbandonata a sé stessa per molti anni e ormai diroccata, oggi, grazie a un progetto di profondo restauro, riprende vita ed è pronta a scrivere una nuova storia.
                </p>
            </ui-block>
            <ui-image-block
                :isImage="true"
                :animated="true"
                :direction="false"
                imgSrc="/images/tenuta.jpg"
                @animate-parent="animateStoria"/>
        </div>
    </div>
</template>

<script>
import { UiBlock, UiHeroBannerVideo, UiImageBlock, UiTitle } from '../components/ui'
import { TimelineMax } from 'gsap'
import ScrollMagic from 'scrollmagic'
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'

export default {
    name: 'LaStoria',
    components: {
        UiBlock,
        UiHeroBannerVideo,
        UiImageBlock,
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
        animateStoria: function() {
            this.$refs.storia.animateIn()
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
    padding-top: 130px;
}
</style>
