<template lang="html">
    <div class="wrapper">
        <nav id="sidebar">
            <ul class="list-unstyled components">
                <li>
                    <a href="#">Vino 1</a>
                </li>
                <li>
                    <a href="#">Vino 2</a>
                </li>
                <li>
                    <a href="#">Vino 3</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid section vini-mocajo">
            <div class="row">
                <ui-hero-banner
                    color="bg-dark"
                    imgSrc="/images/vini.jpg"/>
            </div>
            <div class="row">
                <ui-block
                    color="bg-light">
                    <ui-title
                        title="Sette" />
                    <p>
                        La Scuola Mocajo è entrata a far parte della nostra famiglia e il progetto di produrre vino, parte integrante delle nostre vite. Siamo noi 6, 7 con il nostro cane Bubu, accomunati tra le tante cose, da uno spiccato amore per il buon vino. Siamo aperti all'innovazione, e con la nostra produzione biologica ci proponiamo di sperimentare nuovi trend nel mondo della vinificazione.
                    </p>
                    <ui-action
                        url="/i-nostri-vini">
                        Scopri i nostri vini
                    </ui-action>
                </ui-block>
                <ui-block
                    color="bg-light">
                    <ui-title
                        title="prodotto" />
                </ui-block>
            </div>
            <div class="row">
                <ui-block
                    color="bg-light">
                    <ui-title
                        title="Soffio" />
                    <p>
                        La Scuola Mocajo è entrata a far parte della nostra famiglia e il progetto di produrre vino, parte integrante delle nostre vite. Siamo noi 6, 7 con il nostro cane Bubu, accomunati tra le tante cose, da uno spiccato amore per il buon vino. Siamo aperti all'innovazione, e con la nostra produzione biologica ci proponiamo di sperimentare nuovi trend nel mondo della vinificazione.
                    </p>
                    <ui-action
                        url="/i-nostri-vini">
                        Scopri i nostri vini
                    </ui-action>
                </ui-block>
                <ui-block
                    color="bg-light">
                    <ui-title
                        title="prodotto" />
                </ui-block>
            </div>
            <div class="row">
                <ui-block
                    color="bg-light">
                    <ui-title
                        title="Saputo" />
                    <p>
                        La Scuola Mocajo è entrata a far parte della nostra famiglia e il progetto di produrre vino, parte integrante delle nostre vite. Siamo noi 6, 7 con il nostro cane Bubu, accomunati tra le tante cose, da uno spiccato amore per il buon vino. Siamo aperti all'innovazione, e con la nostra produzione biologica ci proponiamo di sperimentare nuovi trend nel mondo della vinificazione.
                    </p>
                    <ui-action
                        url="/i-nostri-vini">
                        Scopri i nostri vini
                    </ui-action>
                </ui-block>
                <ui-block
                    color="bg-light">
                    <ui-title
                        title="prodotto" />
                </ui-block>
            </div>
        </div>
    </div>
</template>

<script>
import {TimelineMax} from 'gsap'
import { UiAction, UiBlock, UiHeroBanner, UiTitle } from '../components/ui'
export default {
    name: 'Vini',
    components: {
        UiAction,
        UiBlock,
        UiHeroBanner,
        UiTitle,
    },
    methods: {
        animate: function() {
            let title = this.$refs.title,
            description = this.$refs.description,
            image = this.$refs.image

            let master = new TimelineMax({
                paused: true
            })

            master.from(title, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, .1)

            master.from(description, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, .2)

            master.from(image, .8, {
                autoAlpha: 0,
                x: 60,
                ease: Power2.easeOut
            }, .4)

            master.play()
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
        }
    },
    mounted: function() {
        // this.animate()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.wrapper {
    padding-top: 130px;
    display: flex;
    width: 100%;
    justify-content: flex-start;
    align-items: stretch;

    #sidebar {
        position: fixed;
        left: 0;
        min-width: $spacer * 4;
        max-width: $spacer * 4;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: $blue;
        z-index: 2;
        top: 50%;
        transform: translateY(-50%);
    }
}
.section {
    // display: flex;
}
.product-container {
    max-width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    .product-image {
        display: flex;
        justify-content: center;
        align-items: center;

        .image {
            max-width: 240px;
            height: auto;
            max-height: 80vh;
        }
    }
}
</style>
