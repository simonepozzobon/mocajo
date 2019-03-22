<template lang="html">
    <div class="container-fluid scuola-mocajo section">
        <div class="row" v-if="this.header">
            <ui-hero-banner
                :title="this.locale.title"
                color="bg-dark"
                :imgSrc="this.header.img"/>
        </div>
        <div v-else>NO BANNER</div>
        <div class="row" v-if="this.project">
            <ui-block
                color="bg-light"
                :animated="animated"
                ref="progetto">
                <ui-title :title="this.locale.project.title"/>
                <p v-html="this.locale.project.txt"></p>
                <ui-action
                    :is-path="true"
                    :url="this.locale.project.linkhref">
                    {{ this.locale.project.linktxt }}
                </ui-action>
            </ui-block>
            <ui-image-block
                :isImage="true"
                :animated="animated"
                :direction="false"
                @animate-parent="animateProgetto"
                imgSrc="/images/il-nostro-progetto.jpg" />
        </div>
        <div v-else>NO PROGETTO</div>
        <div class="row" v-if="this.family">
            <ui-image-block
                :isImage="true"
                :animated="animated"
                @animate-parent="animateFamiglia"
                :imgSrc="this.family.img" />
            <ui-block
                ref="famiglia"
                :animated="animated"
                color="bg-light">
                <ui-title
                    :title="this.locale.family.title" />
                <p v-html="this.locale.family.txt"></p>
                <ui-action
                    :is-path="true"
                    :url="this.locale.family.linkhref">
                    {{ this.locale.family.linktxt }}
                </ui-action>
            </ui-block>
        </div>
        <div v-else>NO FAMIGLIA</div>
        <div class="row" v-if="this.agriturismo">
            <ui-block
                ref="agriturismo"
                :animated="animated"
                color="bg-light">
                <ui-title
                    :title="this.locale.agriturismo.title" />
                <p v-html="this.locale.agriturismo.txt"></p>
                <ui-action
                    :is-path="true"
                    :url="this.locale.agriturismo.linkhref">
                    {{ this.locale.agriturismo.linktxt }}
                </ui-action>
            </ui-block>
            <ui-image-block
                :isImage="true"
                :animated="animated"
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
            animated: true,
            locale: {
                title: null,
                project: {
                    title: null,
                    txt: null,
                    linktxt: null,
                    linkhref: null,
                },
                family: {
                    title: null,
                    txt: null,
                    linktxt: null,
                    linkhref: null,
                },
                agriturismo: {
                    title: null,
                    txt: null,
                    linktxt: null,
                    linkhref: null,
                }
            }
        }
    },
    watch: {
        '$root.options': function(options) {
            this.setContent(options.scuola)
        },
        '$root.isMobile': function(value) {
            if (value) {
                return this.animated = false
            }
            return this.animated = true
        },
        '$root.locale': function(locale) {
            this.translate(locale)
        },
    },
    methods: {
        getTranslation: function(obj, key) {
            if (obj.hasOwnProperty(key) || obj.hasOwnProperty(key + '_en')) {
                if (this.$root.locale == 'it') {
                    return obj[key]
                }
                return obj[key + '_en']
            }
            return null
        },
        translate: function(locale = false) {
            locale = locale ? locale : this.$root.locale

            this.locale = {
                title: this.getTranslation(this.header, 'title'),
                project: {
                    title: this.getTranslation(this.project, 'title'),
                    txt: this.getTranslation(this.project, 'txt'),
                    linktxt: this.getTranslation(this.project, 'linktxt'),
                    linkhref: this.getTranslation(this.project, 'linkhref'),
                },
                family: {
                    title: this.getTranslation(this.family, 'title'),
                    txt: this.getTranslation(this.family, 'txt'),
                    linktxt: this.getTranslation(this.family, 'linktxt'),
                    linkhref: this.getTranslation(this.family, 'linkhref'),
                },
                agriturismo: {
                    title: this.getTranslation(this.agriturismo, 'title'),
                    txt: this.getTranslation(this.agriturismo, 'txt'),
                    linktxt: this.getTranslation(this.agriturismo, 'linktxt'),
                    linkhref: this.getTranslation(this.agriturismo, 'linkhref'),
                }
            }
        },
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
            this.translate()
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
