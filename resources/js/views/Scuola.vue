<template lang="html">
    <div class="container-fluid scuola-mocajo section">
        <div class="row">
            <ui-hero-banner
                title="Scuola Mocajo"
                color="bg-dark"
                imgSrc="/images/la-scuola-mocajo.jpg" />
        </div>
        <div class="row">
            <ui-block
                color="bg-light"
                :animated="true"
                ref="progetto">
                <ui-title
                    title="Il Nostro Progetto" />
                <p>
                    Questo avventuroso progetto è iniziato nel 2014, con l’obiettivo di produrre un ottimo vino biologico toscano. Abbiamo selezionato e impiantato tre vitigni a bacca bianca: Vermentino, Viognier e Petit Manseng. Produrre vino bianco in una zona famosa specialmente per quello rosso, potrebbe sembrare una scelta contro corrente, in realtà, la nostra decisione è frutto di un’attenta valutazione legata alle specifiche del terreno e del clima della zona, con la precisa volontà di proseguire l’eredità lasciata degli etruschi prima, e dai romani poi.<br>
                    Effettuiamo periodicamente esami chimico-fisici dell’uva, al fine di determinare il momento migliore per la vendemmia. Solo quando le condizioni risultano ottimali, procediamo come un tempo, alla raccolta manuale dell’uva, al fine di selezionare i migliori grappoli per il nostro vino.<br>
                    Siamo aperti all’innovazione e con la nostra produzione biologica utilizziamo criteri di massima selettività, senza dimenticare di sperimentare nuovi trend nel mondo della vinificazione.<br>
                    I vitigni si estendono lungo la vecchia Scuola della Tenuta, che è anch’essa parte caratterizzante del progetto. Mentre le piccole barbatelle crescevano, ci siamo dedicati alla ristrutturazione della Scuola, ridonandole il suo antico splendore e mantenendo gli elementi storici dell’edificio, quali la struttura originaria, la vecchia scala di pietra che portava gli alunni in classe, le finestre e l’albero che vi sorge accanto.<br>
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
                imgSrc="/images/il-nostro-progetto.jpg" />
        </div>
        <div class="row">
            <ui-image-block
                :isImage="true"
                :animated="true"
                @animate-parent="animateFamiglia"
                imgSrc="/images/storia.jpg" />
            <ui-block
                ref="famiglia"
                :animated="true"
                color="bg-light">
                <ui-title
                    title="La Nostra Famiglia" />
                <p>
                    Scuola Mocajo è entrata a far parte della nostra famiglia e il progetto di produrre vino, parte integrante delle nostre vite. Siamo noi 6, 7 con il nostro cane, accomunati tra le tante cose, da uno spiccato amore per il buon vino. Ci siamo innamorati sin da subito di Scuola Mocajo e la magia e il magnetismo di questo posto sono così forti da coinvolgerci totalmente nel progetto, tanto da non farlo più uscire dai nostri pensieri.
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
                imgSrc="/images/agriturismo-mocajo.jpg"
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
    max-width: 100vw;
    overflow-x: hidden;
}
</style>
