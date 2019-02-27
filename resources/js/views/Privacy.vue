<template lang="html">
    <div class="container-fluid privacy-section section" ref="section">
        <div class="row" v-if="privacy.img">
            <ui-hero-banner
                :title="privacy.title"
                color="bg-dark"
                :imgSrc="privacy.img" />
        </div>
        <div class="row" v-if="privacy.txt">
            <ui-block
                size="col"
                color="bg-light"
                v-html="privacy.txt">
            </ui-block>
        </div>
    </div>
</template>

<script>
import { UiBlock, UiHeroBanner } from '../components/ui'

export default {
    name: 'Privacy',
    components: {
        UiBlock,
        UiHeroBanner,
    },
    data: function() {
        return {
            privacy: {
                title: null,
                txt: null,
                img: null,
            }
        }
    },
    watch: {
        '$root.options': function(options) {
            this.setContent(options.privacy)
        }
    },
    methods: {
        setContent: function(section) {
            this.privacy = section
            console.log(section);
        },
    },
    mounted: function() {
        if (this.$root.options) {
            this.setContent(this.$root.options.privacy)
        }
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

.ui-title {
    margin-bottom: $spacer * 2;
    text-transform: capitalize;
    letter-spacing: 2px;

    &.ui-title-disabled {
        color: $gray-400;

        > span {
            color: $primary;
            font-size: 0.65rem;
            text-transform: uppercase;
        }
    }
}

.ui-subtitle {
    margin-bottom: $spacer * 2;
    letter-spacing: 2px;
    font-weight: 200;
    font-size: $font-size-base;

    &.ui-subtitle-disabled {
        color: $gray-400;
    }

    &.ui-subtitle-m0 {
        margin-bottom: 0;
    }
}

</style>
