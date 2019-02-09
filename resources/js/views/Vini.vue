<template lang="html">
    <div class="container-fluid vini-mocajo">
        <div class="row">
            <ui-hero-banner
                color="bg-dark"
                imgSrc="/images/vini.jpg"/>
        </div>
        <div class="row no-gutters">
            <div id="sidebar" class="col">
                <nav class="sidebar">
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
            </div>
            <div id="content" class="col">
                <div class="row">
                    <ui-block>
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
                    <ui-block>
                        <ui-title
                            title="prodotto" />
                    </ui-block>
                </div>
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

.container-fluid {
    &.vini-mocajo {
        padding: 0;
    }
}

#sidebar {
    min-width: $spacer * 4;
    max-width: $spacer * 4;
    background-color: $blue;
}

#content {
    background-color: $primary;
}

</style>
