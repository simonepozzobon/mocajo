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
                    <div class="product-menu bg-blue active">
                        S
                    </div>
                    <div class="product-menu bg-red">
                        S
                    </div>
                    <div class="product-menu bg-yellow">
                        S
                    </div>
                </div>
            </div>
            <div id="content" class="col">
                <div class="row">
                    <ui-block
                        color="bg-light">
                        <ui-title
                            title="Sette" />
                        <ui-collapse />
                        <ui-action
                            url="/i-nostri-vini">
                            Download Scheda Tecnica
                        </ui-action>
                    </ui-block>
                    <ui-block
                        class="custom-block">
                            <img src="/images/wine-placeholder.jpeg" class="img-fluid"/>
                    </ui-block>
                </div>
                <div class="row">
                    <ui-block
                        color="bg-light">
                        <ui-title
                            title="Soffio" />
                        <ui-collapse />
                        <ui-action
                            url="/i-nostri-vini">
                            Download Scheda Tecnica
                        </ui-action>
                    </ui-block>
                    <ui-block
                        class="custom-block">
                            <img src="/images/wine-placeholder.jpeg" class="img-fluid"/>
                    </ui-block>
                </div>
                <div class="row">
                    <ui-block
                        color="bg-light">
                        <ui-title
                            title="Saputo" />
                        <ui-collapse />
                        <ui-action
                            url="/i-nostri-vini">
                            Download Scheda Tecnica
                        </ui-action>
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
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.css'

import {TimelineMax} from 'gsap'
import { UiAction, UiBlock, UiCollapse, UiHeroBanner, UiImageBlock, UiTitle } from '../components/ui'
export default {
    name: 'Vini',
    components: {
        swiper,
        swiperSlide,
        UiAction,
        UiBlock,
        UiCollapse,
        UiHeroBanner,
        UiTitle,
    },
    data: function() {
        return {
            swiperOption: {
                direction: 'vertical',
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            }
        }
    },
    methods: {
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
            TweenMax.to(this.$refs.sidebar, .2, {
                y: position
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


        span {
            display: inline-block;
            opacity: 0;
            width: 0;
            visibility: hidden;
            transition: opacity .55s ease-in-out;
        }

        // &.active {
        //     z-index: 2;
        //     position: relative;
        //
        //     // &::after {
        //     //     content: '';
        //     //     position: absolute;
        //     //     background-color: $blue;
        //     //     right: - $spacer * 2.1213;
        //     //     width: $spacer * 4.2426;
        //     //     height: $spacer * 4.2426;
        //     //     z-index: -1;
        //     //     transform: rotate(45deg);
        //     // }
        // }
    }

    &:hover {
        max-width: $spacer * 8;
        cursor: pointer;

        .product-menu {
            width: $spacer * 8;
            height: $spacer * 8;

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
            min-height: 60vh;

            &.custom-block {
                display: flex;
                justify-content: center;
                align-items: center;

                img {
                    max-height: 60vh;
                }
            }
        }
    }
}

</style>
