<template lang="html">
    <div class="container-fluid scuola-mocajo section">
        <div class="row">
            <ui-hero-banner
                color="bg-dark"
                imgSrc="/images/tenuta.jpg"/>
        </div>
        <div class="row">
            <ui-block
                color="bg-light"
                :animated="true"
                ref="progetto">
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
            <ui-image-block
                :isImage="true"
                :animated="true"
                :direction="false"
                @animate-parent="animateProgetto"
                imgSrc="/images/storia.jpg" />
        </div>
        <div class="row">
            <ui-image-block
                :isImage="true"
                :animated="true"
                @animate-parent="animateFamiglia"
                imgSrc="/images/tenuta.jpg" />
            <ui-block
                ref="famiglia"
                :animated="true"
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
                ref="agriturismo"
                :animated="true"
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
            <ui-image-block
                :isImage="true"
                :animated="true"
                @animate-parent="animateAgriturismo"
                imgSrc="/images/about.jpg"
                :direction="false"/>
        </div>
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
        }
    },
    methods: {
        animateFamiglia: function() {
            this.$refs.famiglia.animateIn()
        },
        animateProgetto: function() {
            this.$refs.progetto.animateIn()
        },
        animateAgriturismo: function() {
            this.$refs.agriturismo.animateIn()
        },
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
    padding-top: 130px;
}
</style>
