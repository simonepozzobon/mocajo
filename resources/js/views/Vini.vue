<template lang="html">
    <div class="container">
        <div class="row section">
            <div class="col-md-6">
                <h1 ref="title">Vini</h1>
                <p ref="description">
                    Mauris tempus, augue gravida lacinia hendrerit, orci sem pretium augue, nec tempor mi turpis in tortor. Sed porta lectus in quam sodales, venenatis fermentum magna convallis. Morbi vel laoreet est, vitae euismod magna. Nulla facilisi. Nunc ornare, erat ut iaculis sagittis, lectus tellus tincidunt dolor, tristique pulvinar felis nisl finibus neque. Nunc maximus risus at felis ultrices bibendum sit amet nec velit. Fusce sit amet purus velit. Pellentesque blandit turpis eu lacus ullamcorper pharetra. Phasellus tincidunt leo in lectus congue facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed a risus accumsan, ullamcorper urna et, scelerisque nulla.
                </p>
            </div>
            <div class="col-md-6">
                <img src="/images/vini.jpg" alt="" class="img-fluid" ref="image">
            </div>
        </div>
        <div class="row mt-5 product-container">
            <div class="col-md-6">
                <h2>Mocajo</h2>
                <p>
                    Il Mocajo, antico borgo incastonato nelle colline toscane, dà vita a questo vino di gran classe, corposo dal sapore intenso è vellutato. Il suo complesso bouquet lo rende il vino perfetto da accostare a grandi brasati, selvaggina e formaggi stagionati.
                </p>
                <h6>€ 19,00</h6>
                <button class="btn btn-primary" @click="addToCart(19.00)">Acquista</button>
            </div>
            <div class="col-md-6 product-image">
                <img src="/images/wine-placeholder.jpeg" alt="" class="image">
            </div>
        </div>
        <div class="row mt-5 product-container">
            <div class="col-md-6 product-image">
                <img src="/images/wine-placeholder.jpeg" alt="" class="image">
            </div>
            <div class="col-md-6">
                <h2>Ligia</h2>
                <p>
                    Dalla splendida unione dei nobili vitigni San Giovese, Cabernet Franc e Syrah, nasce il Ligia vino delicato ma dal carattere forte e intraprendente. I suoi tannini equilibrati accompagnano a tavola ragù di lepre, bistecca alla fiorentina e secondi di selvaggina.
                </p>
                <h6>€ 12,00</h6>
                <button class="btn btn-primary" @click="addToCart(12.00)">Acquista</button>
            </div>
        </div>
        <div class="row mt-5 product-container">
            <div class="col-md-6">
                <h2>Ignis</h2>
                <p>
                    Ignis è vino robusto, intenso nei profumi di frutti rossi e spezie, con una morbida nota di vaniglia e dal sapore pieno e rotondo. La sua complessità lo rende armonico sia con la selvaggina che con formaggi stagionati, caprini ed erborinati.
                </p>
                <h6>€ 14,00</h6>
                <button class="btn btn-primary" @click="addToCart(14.00)">Acquista</button>
            </div>
            <div class="col-md-6 product-image">
                <img src="/images/wine-placeholder.jpeg" alt="" class="image">
            </div>
        </div>
      </div>
</template>

<script>
import {TimelineMax} from 'gsap'
export default {
    name: 'Vini',
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
        this.animate()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';
.section {
    max-width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
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
