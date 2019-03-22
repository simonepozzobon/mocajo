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
                @animate-parent="animateStoria"/>
            <ui-block
                ref="storia"
                :animated="animated"
                color="bg-light">
                <ui-title
                    tag="h1"
                    size="h2"
                    :title="this.title" />
                <p v-html="this.text"></p>
            </ui-block>
        </div>
        <div class="row" v-if="this.images">
            <ui-image-block
                :isImage="true"
                :animated="false"
                :direction="false"
                :imgSrc="this.images.img1" />
            <ui-image-block
                :isImage="true"
                :animated="false"
                :imgSrc="this.images.img2" />
        </div>
        <div class="row" v-if="this.images">
            <ui-hero-banner
                :no-overlay="true"
                min-height-mobile="300px"
                :imgSrc="this.images.img3" />
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
        }
    },
    watch: {
        '$root.window': function() {
            this.setPadding()
        },
        '$root.options': function(options) {
            this.setContent(options.storia)
            this.translateStatic()
        },
        '$root.isMobile': function(value) {
            if (value) {
                return this.animated = false
            }
            return this.animated = true
        },
        '$root.locale': function(locale) {
            this.translateStatic(locale)
        },
    },
    methods: {
        translateStatic: function(locale = false) {
            locale = locale ? locale : this.$root.locale
            switch (locale) {
                case 'en':
                    this.text = this.scuolaSec ? this.scuolaSec.txt_en : null
                    this.title = this.scuolaSec ? this.scuolaSec.title_en : null
                    break;
                case 'it':
                    this.text = this.scuolaSec ? this.scuolaSec.txt : null
                    this.title = this.scuolaSec ? this.scuolaSec.title : null
                    break;
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
            this.images = section.images
            this.translateStatic()
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
