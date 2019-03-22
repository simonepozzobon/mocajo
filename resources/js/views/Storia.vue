<template lang="html">
    <div class="container-fluid storia-mocajo section" ref="section">
        <div class="row" v-if="this.header">
            <ui-hero-banner-video
                :videoSrc="this.header.video"
                :hasControls="true"
                />
        </div>
        <div class="row" v-if="this.scuolaSec">
            <ui-image-block
                :isImage="true"
                :animated="animated"
                :imgSrc="this.scuolaSec.img"
                @animate-parent="animateStoria"
                :alt="this.locale.scuolaSec.alt"
                :image_title="this.locale.scuolaSec.image_title"/>
            <ui-block
                ref="storia"
                :animated="animated"
                color="bg-light">
                <ui-title
                    tag="h1"
                    size="h2"
                    :title="this.locale.scuolaSec.title" />
                <p v-html="this.locale.scuolaSec.txt"></p>
            </ui-block>
        </div>
        <div class="row" v-if="this.image1 && this.image2">
            <ui-image-block
                :isImage="true"
                :animated="false"
                :direction="false"
                :imgSrc="this.image1.img"
                :alt="this.locale.image1.alt"
                :image_title="this.locale.image1.image_title"/>
            <ui-image-block
                :isImage="true"
                :animated="false"
                :imgSrc="this.image2.img"
                :alt="this.locale.image2.alt"
                :image_title="this.locale.image2.image_title"/>
        </div>
        <div class="row" v-if="this.image3">
            <ui-hero-banner
                :no-overlay="true"
                min-height-mobile="300px"
                :imgSrc="this.image3.img"
                :alt="this.locale.image3.alt"
                :image_title="this.locale.image3.image_title"/>
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
            header: null,
            scuolaSec: null,
            images: null,
            animated: true,
            title: null,
            text: null,
            image1: null,
            image2: null,
            image3: null,
            locale: {
                title: null,
                text: null,
                alt: null,
                image_title: null,
                scuolaSec: {
                    title: null,
                    txt: null,
                    alt: null,
                    image_title: null,
                },
                image1: {
                    alt: null,
                    image_title: null,
                },
                image2: {
                    alt: null,
                    image_title: null,
                },
                image3: {
                    alt: null,
                    image_title: null,
                },
            },
        }
    },
    watch: {
        '$root.window': function() {
            this.setPadding()
        },
        '$root.options': function(options) {
            this.setContent(options.storia)
            this.translate()
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
                text: this.getTranslation(this.header, 'txt'),
                alt: this.getTranslation(this.header, 'alt'),
                image_title: this.getTranslation(this.header, 'image_title'),
                scuolaSec: {
                    title: this.getTranslation(this.scuolaSec, 'title'),
                    txt: this.getTranslation(this.scuolaSec, 'txt'),
                    alt: this.getTranslation(this.scuolaSec, 'alt'),
                    image_title: this.getTranslation(this.scuolaSec, 'image_title'),
                },
                image1: {
                    alt: this.getTranslation(this.image1, 'alt'),
                    image_title: this.getTranslation(this.image1, 'image_title'),
                },
                image2: {
                    alt: this.getTranslation(this.image2, 'alt'),
                    image_title: this.getTranslation(this.image2, 'image_title'),
                },
                image3: {
                    alt: this.getTranslation(this.image3, 'alt'),
                    image_title: this.getTranslation(this.image3, 'image_title'),
                },
            }
        },
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
        setContent: function(section) {
            this.header = section.header
            this.scuolaSec = section.scuola
            this.image1 = section.image1
            this.image2 = section.image2
            this.image3 = section.image3
            this.translate()
        }
    },
    mounted: function() {
        this.setPadding()
        if (this.$root.options) {
            this.setContent(this.$root.options.storia)
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
