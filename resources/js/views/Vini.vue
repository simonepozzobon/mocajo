<template lang="html">
    <div class="container-fluid vini-mocajo">
        <div class="row">
            <ui-hero-banner
                color="bg-dark"
                imgSrc="/images/vini.jpg"/>
        </div>
        <div class="row no-gutters">
            <div id="sidebar" class="col">
                <div class="sidebar-container" ref="sidebar">
                    <div id="sette-menu" class="product-menu bg-blue active" @click="goTo(1)">
                        S
                    </div>
                    <div id="soffio-menu" class="product-menu bg-red" @click="goTo(2)">
                        S
                    </div>
                    <div id="saputo-menu" class="product-menu bg-yellow" @click="goTo(3)">
                        S
                    </div>
                </div>
            </div>
            <div id="content" class="col">
                <div id="sette" class="row" v-view="handler">
                    <div id="sette-trigger"></div>
                    <ui-block
                        color="bg-light">
                        <ui-title
                            title="Sette" />
                        <ui-collapse />
                        <ui-action
                            url="/i-nostri-vini">
                            Download Scheda Tecnica
                        </ui-action>
                        <button class="btn btn-outline-black add-to-cart" @click="addToCart(19.00)">Acquista</button>
                    </ui-block>
                    <ui-block
                        class="custom-block">
                            <img src="/images/wine-placeholder.jpeg" class="img-fluid"/>
                    </ui-block>
                </div>
                <div id="soffio" class="row" v-view="handler">
                    <div id="soffio-trigger"></div>
                    <ui-block
                        color="bg-light">
                        <ui-title
                            title="Soffio" />
                        <ui-collapse />
                        <ui-action
                            url="/i-nostri-vini">
                            Download Scheda Tecnica
                        </ui-action>
                        <button class="btn btn-outline-black add-to-cart" @click="addToCart(14.00)">Acquista</button>
                    </ui-block>
                    <ui-block
                        class="custom-block">
                            <img src="/images/wine-placeholder.jpeg" class="img-fluid"/>
                    </ui-block>
                </div>
                <div id="saputo" class="row" v-view="handler">
                    <div id="saputo-trigger"></div>
                    <ui-block
                        color="bg-light">
                        <ui-title
                            title="Saputo" />
                        <ui-collapse />
                        <ui-action
                            url="/i-nostri-vini">
                            Download Scheda Tecnica
                        </ui-action>
                        <button class="btn btn-outline-black add-to-cart" @click="addToCart(12.00)">Acquista</button>
                    </ui-block>
                    <ui-block
                        class="custom-block">
                            <img src="/images/wine-placeholder.jpeg" class="img-fluid"/>
                    </ui-block>
                </div>
            </div>
        </div>


    </div>
</template>

<script>

import {TimelineMax} from 'gsap'
import ScrollToPlugin from 'gsap/ScrollToPlugin'
import { UiAction, UiBlock, UiCollapse, UiHeroBanner, UiImageBlock, UiTitle } from '../components/ui'
export default {
    name: 'Vini',
    components: {
        UiAction,
        UiBlock,
        UiCollapse,
        UiHeroBanner,
        UiTitle,
    },
    data: function() {
        return {
            cache: {
                sette: true,
                soffio: null,
                saputo: null,
            }
        }
    },
    methods: {
        handler: function(e) {
            let name = e.target.element.id
            if (e.percentCenter > 0.5 && e.percentCenter < 0.7) {
                if (!this.cache[name]) {
                    TweenMax.to('#'+name+'-menu', .6, {
                        className: '+=active',
                        onComplete: () => {
                            this.cache[name] = true
                        }
                    })
                }
            } else if (e.type == 'exit') {
                TweenMax.to('#'+name+'-menu', .2, {
                    className: '-=active',
                    onComplete: () => {
                        this.cache[name] = false
                    }
                })
            }
        },
        addToCart: function(price) {
            price = price.toFixed(2)
            let product = null
            if (price == 12.00 || price == 12 || price == '12.00') {
                product = {
                    id: 2,
                    title: 'Ligia',
                    quantity: 1,
                    price: 12.00
                }
            } else if (price == 19.00 || price == 19 || price == '19.00') {
                product = {
                    id: 1,
                    title: 'Mocajo',
                    quantity: 1,
                    price: 19.00
                }
            } else if (price == 14.00 || price == 14 || price == '14.00') {
                product = {
                    id: 3,
                    title: 'Ignis',
                    quantity: 1,
                    price: 14.00
                }
            }
            this.$root.addToCart(product)
        },
        setMenuOnCenter: function(e) {
            let position = document.documentElement.scrollTop
            if (this.$refs.sidebar) {
                TweenMax.to(this.$refs.sidebar, .2, {
                    y: position
                })
            }
        },
        getScrollX: function() {
            return (window.pageXOffset != null) ? window.pageXOffset : (document.documentElement.scrollLeft != null) ? document.documentElement.scrollLeft : document.body.scrollLeft;
        },
        getScrollY: function() {
            const w = window

            // This works for all browsers except IE versions 8 and before
            if (w.pageXOffset != null) return {x: w.pageXOffset, y:w.pageYOffset}
            // For IE (or any browser) in Standards mode
            var d = w.document
            if (document.compatMode == "CSS1Compat")
            return {x:d.documentElement.scrollLeft, y:d.documentElement.scrollTop}
            // For browsers in Quirks mode
            return { x: d.body.scrollLeft, y: d.body.scrollTop }
        },
        resetClass: function() {
            return new Promise(resolve => {
                TweenMax.to(['#sette-menu', '#soffio-menu', '#saputo-menu'], .2, {
                    className: '-=active',
                    onComplete: () => {
                        resolve()
                    }
                })
            })
        },
        goTo: function(id) {
            let name = '',
            el,
            scrollYPos = 0,
            topPosition = 0,
            scrollOffset = this.getScrollY()

            this.resetClass().then( () => {
                switch (id) {
                    case 1:
                        name = 'sette'
                        el = document.getElementById('sette')
                        break;
                    case 2:
                        name = 'soffio'
                        el = document.getElementById('soffio')
                        topPosition = el.getBoundingClientRect().top
                        scrollYPos = topPosition + scrollOffset.y﻿
                        break;
                    case 3:
                        name = 'saputo'
                        el = document.getElementById('saputo')
                        topPosition = el.getBoundingClientRect().top
                        scrollYPos = topPosition + scrollOffset.y﻿
                        break;
                }

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
                    },
                    ease: Sine.easeOut
                }, 0)

                master.play()
            })

        }
    },
    mounted: function() {
        window.addEventListener('scroll', (e) => {
            this.setMenuOnCenter(e)
        })
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.container-fluid {
    &.vini-mocajo {
        padding: 0;
    }
}

#sidebar {
    max-width: $spacer * 6;
    background-color: $white;

    .product-menu {
        width: $spacer * 6;
        height: $spacer * 6;
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
    }

    &:hover {
        max-width: $spacer * 6.5;
        cursor: pointer;

        .product-menu {
            width: $spacer * 6.5;
            height: $spacer * 6.5;

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
            min-height: calc(100vh - 130px);

            &.custom-block {
                display: flex;
                justify-content: center;
                align-items: center;

                img {
                    max-height: calc(100vh - 130px);
                }
            }
        }
    }

    .add-to-cart {
        margin-top: $spacer * 1.618;
        display: block;
    }
}

</style>
