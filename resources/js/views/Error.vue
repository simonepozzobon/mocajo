<template lang="html">
    <div class="error-page container-fluid section">
        <div class="row">
            <ui-block
                color="bg-light"
                size="col-12"
                :full-height="true"
                :animated="false"
                ref="progetto">
                <ui-title title="404" align="center"/>
                <ui-paragraph align="center">
                    Siamo spiacenti, la pagina che stai cercando non esiste
                </ui-paragraph>
            </ui-block>
        </div>
    </div>
</template>

<script>
import { UiAction, UiBlock, UiHeroBanner, UiImageBlock, UiParagraph, UiTitle } from '../components/ui'

export default {
    name: 'Error',
    components: {
        UiAction,
        UiBlock,
        UiHeroBanner,
        UiImageBlock,
        UiParagraph,
        UiTitle,
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';

.section {
    padding-top: $section-padding;
    max-width: 100vw;
    overflow-x: hidden;
    background-color: $blue;

    @include media-breakpoint-down('sm') {
        padding-top: $section-sm-padding;
    }
}
</style>
