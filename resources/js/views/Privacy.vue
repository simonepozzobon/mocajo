<template lang="html">
    <div class="container-fluid privacy-section section" ref="section">
        <div class="row" v-if="privacy.img">
            <ui-hero-banner
                :title="this.locale.title"
                color="bg-dark"
                :imgSrc="privacy.img"
                :alt="this.locale.alt"
                :image_title="this.locale.image_title"/>
        </div>
        <div class="row" v-if="privacy.txt">
            <ui-block
                size="col"
                color="bg-light"
                v-html="this.locale.txt">
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
                alt: null,
                image_title: null,
            },
            locale: {
                title: null,
                txt: null,
                img: null,
                alt: null,
                image_title: null,
            }
        }
    },
    watch: {
        '$root.options': function(options) {
            this.setContent(options.privacy)
        },
        '$root.locale': function(locale) {
            this.translate(locale)
        },
    },
    methods: {
        setContent: function(section) {
            this.privacy = section
            this.translate()
        },
        getTranslation: function(obj, key) {
            if (obj.hasOwnProperty(key) || obj.hasOwnProperty(key + '_en')) {
                if (this.$root.locale == 'it') {
                    return obj[key]
                }
                return obj[key + '_en']
            }
            return null
        },
        translate: function(locale = false) {
            locale = locale ? locale : this.$root.locale

            this.locale = {
                title: this.getTranslation(this.privacy, 'title'),
                txt: this.getTranslation(this.privacy, 'txt'),
                alt: this.getTranslation(this.privacy, 'alt'),
                image_title: this.getTranslation(this.privacy, 'image_title')
            }
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
