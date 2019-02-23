<template lang="html">
    <div class="container-fluid storia-mocajo section" ref="section">
        <div class="row">
            <ui-hero-banner-video
                videoSrc="/video/home.mp4"
                imgSrc="/images/tenuta.jpg"
                />
        </div>
        <div class="row">
            <ui-image-block
                :isImage="true"
                :animated="true"
                imgSrc="/images/tenuta.jpg"
                @animate-parent="animateStoria"/>
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
        </div>
        <div class="row">
            <ui-image-block
                :isImage="true"
                :animated="false"
                :direction="false"
                imgSrc="/images/storia-agriturismo-mocajo.jpg"
                />
            <ui-image-block
                :isImage="true"
                :animated="false"
                imgSrc="/images/storia-agriturismo-mocajo-2.jpg"
                />
        </div>
        <div class="row">
            <ui-hero-banner
                imgSrc="/images/storia-big.jpg"
                />
        </div>
    </div>
</template>

<script>
import { UiBlock, UiHeroBannerVideo, UiHeroBanner, UiImageBlock, UiTitle } from '../components/ui'
import { TimelineMax } from 'gsap'
import ScrollMagic from 'scrollmagic'
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'

export default {
    name: 'LaStoria',
    components: {
        UiBlock,
        UiHeroBanner,
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
    watch: {
        '$root.window': function() {
            this.setPadding()
        }
    },
    methods: {
        animateStoria: function() {
            this.$refs.storia.animateIn()
        },
        setPadding: function() {
            if (this.$root.window.w <= 576) {
                this.$refs.section.style.paddingTop = '90px';
            } else {
                this.$refs.section.style.paddingTop = '130px';
            }
        },
    },
    mounted: function() {
        this.setPadding()
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
    padding-top: $section-padding;
    max-width: 100vw;
    overflow-x: hidden;


    @include media-breakpoint-down('sm') {
        padding-top: $section-sm-padding;
    }
}
</style>
