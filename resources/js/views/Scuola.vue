<template lang="html">
    <div class="container-fluid scuola-mocajo">
        <div class="row">
            <div class="col bg-dark" style="min-height: 40vh">Banner</div>
        </div>
        <div class="row">
            <ui-block
                color="bg-light">
                <ui-title
                    title="Il Nostro Progetto" />
                <p>
                    Questo avventuroso progetto è iniziato nel 2014, con un solo obiettivo, quello di produrre un ottimo vino biologico. Abbiamo impiantato tre vitigni a bacca bianca in una terra di rosso: Vermentino, Viognier e Petit Manseng. Produrre vino bianco in una zona famosa specialmente per quello rosso, potrebbe sembrare una scelta contro corrente, in realtà la nostra decisione è frutto di un'attenta valutazione legata alle specifiche del terreno e del clima della zona, con la precisa volontà di proseguire l'eredità lasciata degli etruschi prima e dai romani dopo.<br><br>
                    Mentre le piccole barbatelle crescevano, ci siamo dedicati alla ristrutturazione della vecchia Scuola della Tenuta, ridonandole il suo antico splendore e mantenendo gli elementi storici dell'edificio, quali la struttura originaria, la vecchia scala di pietra che portava gli alunni in classe, le finestre e l'albero che vi sorge accanto.
                </p>
                <ui-action
                    url="/la-nostra-storia">
                    Scopri la storia
                </ui-action>
            </ui-block>
            <ui-block
                :isImage="true"
                imgSrc="/images/storia.jpg" />
        </div>
        <div class="row">
            <ui-block
                :isImage="true"
                imgSrc="/images/tenuta.jpg" />
            <ui-block
                color="bg-light">
                <ui-title
                    title="La Nostra Famiglia" />
                <p>
                    La Scuola Mocajo è entrata a far parte della nostra famiglia e il progetto di produrre vino, parte integrante delle nostre vite. Siamo noi 6, 7 con il nostro cane Bubu, accomunati tra le tante cose, da uno spiccato amore per il buon vino. Siamo aperti all'innovazione, e con la nostra produzione biologica ci proponiamo di sperimentare nuovi trend nel mondo della vinificazione.
                </p>
                <ui-action
                    url="/i-nostri-vini">
                    Scopri i nostri vini
                </ui-action>
            </ui-block>
        </div>
        <div class="row">
            <ui-block
                color="bg-light">
                <ui-title
                    title="L'Agriturismo" />
                <p>
                    Tra morbide colline, vitigni e uliveti, sorge Scuola Mocajo, un elegante agriturismo accarezzato dal vento e immerso nel verde. Un luogo di pace dove si possono trascorrere piacevoli pomeriggi in piscina, visitare le città limitrofe o recarsi al mare che rimane a pochi km di distanza. Se siete interessati a trascorre del tempo nel nostro agriturismo, contattateci.
                </p>
                <ui-action
                    url="/contatti">
                    Vai a contatti
                </ui-action>
            </ui-block>
            <ui-block
                :isImage="true"
                imgSrc="/images/about.jpg" />
        </div>
    </div>
</template>

<script>
import { UiAction, UiBlock, UiTitle } from '../components/ui'
import {TimelineMax} from 'gsap'
import ScrollMagic from 'scrollmagic'
import 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators'

export default {
    name: 'LaScuola',
    components: {
        UiAction,
        UiBlock,
        UiTitle,
    },
    data: function() {
        return {
            controller: null,
            about: false,
            tenuta: false,
            scuola: false,
        }
    },
    methods: {
        init: function() {
            this.controller = new ScrollMagic.Controller()
            let scuola = new ScrollMagic.Scene({
                triggerElement: '#section-one',
                offset: 0,
                duration: 200,
                triggerHook: 'onEnter'
            })
                // .addIndicators({ name: 'about'})
                // .setTween(master)
                .addTo(this.controller)
            let tenuta = new ScrollMagic.Scene({
                triggerElement: '#section-two',
                offset: 0,
                duration: 200,
                triggerHook: 'onEnter'
            })
                // .addIndicators({ name: 'tenuta'})
                .on('enter', () => {
                    if (!this.tenuta) {
                        let objs = {
                            title: '#about-tenuta',
                            description: '#about-tenuta-description',
                            image: '#about-tenuta-image'
                        }
                        this.animate(objs)
                        this.tenuta = true
                    }
                })
                .addTo(this.controller)
            let storia = new ScrollMagic.Scene({
                triggerElement: '#section-three',
                offset: 0,
                duration: 200,
                triggerHook: 'onEnter'
            })
                // .addIndicators({ name: 'storia'})
                .on('enter', () => {
                    if (!this.storia) {
                        let objs = {
                            title: '#about-storia',
                            description: '#about-storia-description',
                            image: '#about-storia-image'
                        }
                        this.animate(objs)
                        this.storia = true
                    }
                })
                .addTo(this.controller)
        },
        animate: function(objs = null) {
            let title, description, image
            if (objs) {
                title = objs.title
                description = objs.description
                image = objs.image
            } else {
                title = this.$refs.title
                description = this.$refs.description
                image = this.$refs.image
            }


            let master = new TimelineMax({
                paused: true
            })

            master.fromTo(title, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeInOut
            }, .1)

            master.fromTo(description, .6, {
                autoAlpha: 0,
                y: 20,
                ease: Power2.easeInOut
            }, {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeInOut
            }, .2)

            master.fromTo(image, .8, {
                autoAlpha: 0,
                x: 60,
                ease: Power2.easeOut
            }, {
                autoAlpha: 1,
                x: 0,
                ease: Power2.easeOut
            }, .4)

            master.play()
        }
    },
    mounted: function() {
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
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
