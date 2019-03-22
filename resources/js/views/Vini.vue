<template lang="html">
    <div class="container-fluid vini-mocajo vini">
        <div class="row" v-if="this.vini.img">
            <ui-hero-banner
                color="bg-dark"
                :title="this.title"
                :imgSrc="this.vini.img"/>
        </div>
        <div class="row">
            <div id="sidebar" class="col" v-if="!this.$root.isMobile && this.products">
                <div class="sidebar-container" ref="sidebar">
                    <product-menu-icon
                        v-for="(item, i) in this.products"
                        :key="item.id"
                        :idx="item.id"
                        :title="item.title"
                        :svg-src="item.icon"
                        @go-to="goTo"/>
                </div>
            </div>
            <div id="content" class="col vini__products">
                <div id="vini-description" class="row">
                    <div id="vini-description-trigger"></div>
                    <ui-block
                        :min-height="true"
                        minHeightSize="100px"
                        color="bg-light"
                        :disablePadding="false">
                        <p class="vini-description-paragraph">{{ this.text }}</p>
                    </ui-block>
                    <ui-block
                        class="d-none d-md-block"
                        :min-height="true"
                        minHeightSize="0">
                    </ui-block>
                </div>
                <product-single
                    v-for="(item, i) in this.products"
                    :key="item.id"
                    :product="item"
                    :shop="shop"/>
            </div>
        </div>
        <div id="mobile-sidebar" ref="sidebarMobile" v-if="this.$root.isMobile">
            <product-menu-icon
                v-for="(item, i) in this.products"
                :key="item.id"
                :idx="item.id"
                :title="item.title"
                :svg-src="item.icon"
                @go-to="goTo"/>
        </div>
    </div>
</template>

<script>
import Wines from '../dummies/wines'
import {TimelineMax} from 'gsap'
import ProductMenuIcon from '../components/ProductMenuIcon.vue'
import ProductSingle from '../components/ProductSingle.vue'
import { UiAction, UiBlock, UiCollapse, UiHeroBanner, UiImageBlock, UiSubtitle, UiTitle } from '../components/ui'
require('gsap/ScrollToPlugin')

export default {
    name: 'Vini',
    components: {
        ProductMenuIcon,
        ProductSingle,
        UiAction,
        UiBlock,
        UiCollapse,
        UiHeroBanner,
        UiSubtitle,
        UiTitle,
    },
    data: function() {
        return {
            cache: {
                sette: true,
                soffio: null,
                saputo: null,
            },
            wines: Wines,
            isMobile: false,
            products: null,
            vini: {
                title: null,
                img: null,
                txt: null,
            },
            title: null,
            text: null,
            shop: {
                active: false,
                multiplier: 1,
            },
            isActive: null,
            initialized: null,
        }
    },
    watch: {
        '$root.isMobile': function(value) {
            if (value && this.$refs.sidebar) {
                TweenMax.set(this.$refs.sidebar, {
                    display: 'none',
                })
            }
        },
        '$root.products': function(products) {
            this.products = products
        },
        '$root.options': function(options) {
            this.setContent(options.vini, options.shop)
        },
        '$root.locale': function(locale) {
            this.translate(locale)
        }
    },
    methods: {
        getTranslations: function(obj, key) {
            if (obj.hasOwnProperty(key) && obj.hasOwnProperty(key + '_en')) {
                if (this.$root.locale == 'it') {
                    return obj[key]
                }
                return obj[key + '_en']
            }
            return null
        },
        translate: function(locale = false) {
            this.title = this.getTranslations(this.vini, 'title')
            this.text = this.getTranslations(this.vini, 'txt')
            if (!this.initialized) {
                this.$nextTick(() => {
                    this.scrollToTop()
                })
            }
        },
        setContent: function(section, shop) {
            this.vini = section
            this.shop = shop
            this.isActive = shop.active
            this.translate()

        },
        setMenuOnCenter: function(e) {
            let position = document.documentElement.scrollTop
            if (this.$refs.sidebar) {
                TweenMax.to(this.$refs.sidebar, .2, {
                    y: position
                })
            }
        },
        getScrollY: function() {
            const w = window
            // This works for all browsers except IE versions 8 and before
            if (w.pageXOffset != null) return {x: w.pageXOffset, y:w.pageYOffset}
            // For IE (or any browser) in Standards mode
            let d = w.document
            if (document.compatMode == "CSS1Compat")
            return { x: d.documentElement.scrollLeft, y: d.documentElement.scrollTop }
            // For browsers in Quirks mode
            return { x: d.body.scrollLeft, y: d.body.scrollTop }
        },
        resetClass: function() {
            return new Promise(resolve => {
                TweenMax.to(['#sette-menu', '#soffio-menu', '#saputo-menu', '#stello-menu'], .2, {
                    className: '-=active',
                    onComplete: () => {
                        resolve()
                    }
                })
            })
        },
        goTo: function(name) {
            let el,
            scrollYPos = 0,
            topPosition = 0,
            scrollOffset = this.getScrollY()

            this.resetClass().then( () => {
                el = document.getElementById(name)
                topPosition = el.getBoundingClientRect().top
                scrollYPos = topPosition + scrollOffset.y﻿

                let master = new TimelineMax({
                    paused: true,
                })

                master.to('#'+name+'-menu', .6, {
                    className: '+=active'
                }, 0)

                master.to(window﻿, .6, {
                    scrollTo:{
                        offsetY: 130,
                        y: scrollYPos,
                        x: 0,
                        autokill: false,
                    },
                    ease: Sine.easeOut
                }, 0)

                master.play()
            })

        },
        scrollToTop: function() {
            TweenMax.to(window, .2, {
                scrollTo: {
                    y: 0,
                    autokill: false,
                },
                onComplete: () => {
                    this.initialized = true
                }
            })
        }
    },
    mounted: function() {
        if (this.$root.products) {
            this.products = this.$root.products
        }
        if (this.$root.options) {
            this.setContent(this.$root.options.vini, this.$root.options.shop)
        }

    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.container-fluid {
    &.vini-mocajo {
        padding-top: $section-padding;
        padding-left: 0;
        padding-right: 0;
        max-width: 100vw;
        overflow-x: hidden;


        @include media-breakpoint-down('sm') {
            padding-top: $section-sm-padding;
        }
    }
}
#mobile-sidebar {
    position: fixed;
    bottom: 0;
    min-height: 50px;
    width: 100%;
    z-index: 2;
    display: flex;
    flex-direction: row;

    .product-menu {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;

        &.active {
            background-color: $white !important;

            &.bg-blue {
                color: $blue;
            }

            &.bg-yellow {
                color: $yellow;
            }

            &.bg-red {
                color: $red;
            }
        }

        .product-img {
            width: 100%;
        }
    }
}

#sidebar {
    max-width: $spacer * 4;
    position: fixed;
    top: 50%;
    left: 0;
    z-index: 1;
    padding: 0;
    transform: translateY(-50%);

    .product-menu {
        width: $spacer * 4;
        height: $spacer * 4;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: $h5-font-size;
        transition: $transition-base;
        cursor: pointer;



        &.active {
            background-color: $white !important;

            &.bg-blue {
                color: $blue;
            }

            &.bg-yellow {
                color: $yellow;
            }

            &.bg-red {
                color: $red;
            }
        }


        .product-img {
            width: 100%;
        }
    }

    &:hover {
        cursor: pointer;

        .product-menu {
            span {
                display: inline-block;
                visibility: visible;
                width: auto;
                opacity: 0.6;
                transition: opacity .55s ease-in-out;
            }

        }

        transition: $transition-base;
    }
    transition: $transition-base;
}

#content {
    .row {
        border-left: 1px solid $black;
        margin-left: 0;

        .ui-block {
            min-height: calc(100vh - $section-padding);

            @include media-breakpoint-down('sm') {
                min-height: calc(100vh - $section-sm-padding);
            }

            &.custom-block {
                display: flex;
                justify-content: center;
                align-items: center;

                img {
                    max-height: calc(100vh - $section-padding);

                    @include media-breakpoint-down('sm') {
                        max-height: calc(100vh - $section-sm-padding);
                    }

                }
            }
        }
    }

    .add-to-cart {
        margin-top: $spacer * 1.618;
        display: block;
    }
}

.vini {
    .vini-description-paragraph {
        margin-bottom: $spacer * 2;
        letter-spacing: 2px;
        font-weight: 200;
        font-size: $font-size-base;
    }

    &__products {
        @include media-breakpoint-down('sm') {
            padding-bottom: $spacer * 7;
        }
    }
}
</style>
