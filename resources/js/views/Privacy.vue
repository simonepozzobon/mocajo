<template lang="html">
    <div class="container-fluid privacy-section section" ref="section">
        <div class="row">
            <ui-hero-banner
                title="Privacy"
                color="bg-dark"
                imgSrc="/images/privacy.jpg" />
        </div>
        <div class="row">
            <ui-block
                size="col"
                color="bg-light">
                <ui-title title="Cookie Policy"/>
                <ui-subtitle title="Informativa sull'utilizzo dei Cookies"/>
                <p class="pb-5">
                    Gentile Utente,
                    La Scuola di Mocajo Società Agricola di Giuseppe Perucchetti & C. SS, sul proprio sito
                    web www.scuolamocajo.it utilizza esclusivamente cookies tecnici in forma totalmente
                    anonima. Per qualunque dubbio relativo all’utilizzo dei cookies e alla loro qualificazione,
                    potrà prendere visione del provvedimento adottato dall'Autorità Garante per la protezione
                    dei dati personali <a href="http://www.garanteprivacy.it/web/guest/home/docweb/-/docweb-display/docweb/3118884" target="_blank">http://www.garanteprivacy.it/web/guest/home/docweb/-/docweb-display/docweb/3118884</a><br>
                    In tale provvedimento viene evidenziato come per i “cookie tecnici”, non sia necessario
                    richiedere un consenso preventivo, ma sia sufficiente e necessaria un’informativa estesa e
                    dettagliata su come gestirli e disabilitarli.
                </p>
                <ui-subtitle title="Qualificazione di “cookie tecnici” e ragioni dell'utilizzo"/>
                <p>
                    I cookie tecnici sono quelli utilizzati al solo fine di &quot;effettuare la trasmissione di una
                    comunicazione su una rete di comunicazione elettronica, o nella misura strettamente
                    necessaria al fornitore di un servizio della società dell&#39;informazione esplicitamente
                    richiesto dall&#39;abbonato o dall&#39;utente a erogare tale servizio&quot; (cfr. art. 122, comma 1, del
                    Codice). Essi non vengono utilizzati per scopi ulteriori e sono normalmente installati
                    direttamente dal titolare o gestore del sito web. Possono essere suddivisi in cookie di
                    navigazione o di sessione, che garantiscono la normale navigazione e fruizione del sito
                    web (permettendo, ad esempio, di realizzare un acquisto o autenticarsi per accedere ad
                    aree riservate); cookie analytics, assimilati ai cookie tecnici laddove utilizzati direttamente
                    dal gestore del sito per raccogliere informazioni, in forma aggregata, sul numero degli
                    utenti e su come questi visitano il sito stesso; cookie di funzionalità, che permettono
                    all&#39;utente la navigazione in funzione di una serie di criteri selezionati (ad esempio, la
                    lingua, i prodotti selezionati per l&#39;acquisto) al fine di migliorare il servizio reso allo stesso.
                </p>
                <p>
                    In particolari potranno essere utilizzati per:
                </p>
                <ul class="pb-5">
                    <li>memorizzare i prodotti che vengono inseriti nel carrello;</li>
                    <li>tenere attiva la sessione di navigazione;</li>
                    <li>generare statistiche di accesso al sito;</li>
                    <li>altre funzioni specifiche (es. gestire i prodotti preferiti dell&#39;utente, comparare prodotti,ecc.).</li>
                </ul>
                <ui-subtitle title="Cookie utilizzati nel sito www.scuolamocajo.it sono"/>
                <p>
                    Cookie di scuolamocajo.it:
                </p>
                <ul>
                    <li>XSRF-TOKEN (Session Cookie)</li>
                    <li>laravel_session (Session Cookie)</li>
                    <li>mocajo-cookie-policy (Privacy Accepted)</li>
                </ul>
                <p>
                    Cookie Google Analytics:
                </p>
                <ul class="pb-5">
                    <li>__utma (Persistent Cookie)</li>
                    <li>__utmb (Persistent Cookie)</li>
                    <li>__utmc (Session Cookie)</li>
                    <li>__utmz (Persistent Cookie)</li>
                </ul>
                <ui-subtitle title="Google Analytics"/>
                <p>
                    Il sito www.scuolamocajo.it utilizza Google Analytics, un servizio di analisi del web fornito
                    da Google Inc. Google. Analytics utilizza dei &quot;cookies&quot; che vengono registrati sul computer
                    dell’utente per analizzare come gli utenti utilizzano il sito. Le informazioni generate dal
                    cookie sull&#39;utilizzo del sito web da parte dell&#39;utente sono trasmesse e registrate sui server
                    di Google e saranno gestite nel rispetto della privacy di Google. La Scuola di Mocajo
                    Società Agricola di Giuseppe Perucchetti &amp; C. SS., proprietaria del sito
                    www.scuolamocajo.it, utilizza queste informazioni allo scopo di comprendere l&#39;utilizzo del
                    sito web da parte dei propri utenti. Qualunque informazione sarà comunque sempre in
                    forma anonima e aggregata. Per ulteriori informazioni si rimanda all&#39;<a href="https://policies.google.com/?hl=it" target="_blank">informativa</a> sulla
                    Privacy di Google Analytics.
                </p>
            </ui-block>
        </div>
    </div>
</template>

<script>
import { UiBlock, UiHeroBanner, UiSubtitle, UiTitle } from '../components/ui'

export default {
    name: 'Privacy',
    components: {
        UiBlock,
        UiHeroBanner,
        UiSubtitle,
        UiTitle
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
