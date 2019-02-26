<template lang="html">
    <div class="container-fluid scuola-mocajo section">
        <div class="row" v-if="this.header">
            <ui-hero-banner
                :title="this.header.title"
                color="bg-dark"
                :imgSrc="this.header.img"/>
        </div>
        <div v-else>NO BANNER</div>
        <div class="row" v-if="this.project">
            <ui-block
                color="bg-light"
                :animated="true"
                ref="progetto">
                <ui-title :title="this.project.title"/>
                <p v-html="this.project.txt"></p>
                <ui-action
                    url="/storia">
                    Scopri la storia
                </ui-action>
            </ui-block>
            <ui-image-block
                :isImage="true"
                :animated="true"
                :direction="false"
                @animate-parent="animateProgetto"
                imgSrc="/images/il-nostro-progetto.jpg" />
        </div>
        <div v-else>NO PROGETTO</div>
        <div class="row" v-if="this.family">
            <ui-image-block
                :isImage="true"
                :animated="true"
                @animate-parent="animateFamiglia"
                :imgSrc="this.family.img" />
            <ui-block
                ref="famiglia"
                :animated="true"
                color="bg-light">
                <ui-title
                    :title="this.family.title" />
                <p v-html="this.family.txt"></p>
                <ui-action
                    url="/i-nostri-vini">
                    Scopri i nostri vini
                </ui-action>
            </ui-block>
        </div>
        <div v-else>NO FAMIGLIA</div>
        <div class="row" v-if="this.agriturismo">
            <ui-block
                ref="agriturismo"
                :animated="true"
                color="bg-light">
                <ui-title
                    :title="this.agriturismo.title" />
                <p v-html="this.agriturismo.txt"></p>
                <ui-action
                    url="/contatti">
                    Vai a contatti
                </ui-action>
            </ui-block>
            <ui-image-block
                :isImage="true"
                :animated="true"
                @animate-parent="animateAgriturismo"
                :imgSrc="this.agriturismo.img"
                :direction="false"/>
        </div>
        <div v-else>NO AGRITURISMO</div>
    </div>
</template>

<script>
import { UiAction, UiBlock, UiHeroBanner, UiImageBlock, UiTitle } from '../components/ui'
import {TimelineMax} from 'gsap'
import ScrollMagic from 'scrollmagic'
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'

export default {
    name: 'LaScuola',
    components: {
        UiAction,
        UiBlock,
        UiHeroBanner,
        UiImageBlock,
        UiTitle,
    },
    data: function() {
        return {
            controller: null,
            about: false,
            tenuta: false,
            scuola: false,
            header: null,
            project: null,
            family: null,
            agriturismo: null,
        }
    },
    watch: {
        '$root.options': function(options) {
            this.setContent(options.scuola)
        }
    },
    methods: {
        animateFamiglia: function() {
            this.$refs.famiglia.animateIn()
        },
        animateProgetto: function() {
            this.$refs.progetto.animateIn()
        },
        animateAgriturismo: function() {
            this.$refs.agriturismo.animateIn()
        },
        setContent: function(section) {
            this.header = section.header
            this.project = section.project
            this.family = section.family
            this.agriturismo = section.agriturismo
        },
    },
    mounted: function() {
        if (this.$root.options) {
            this.setContent(this.$root.options.scuola)
        }
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
