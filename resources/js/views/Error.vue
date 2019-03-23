<template lang="html">
    <div class="error-page container-fluid section" ref="section">
        <div class="row">
            <ui-block
                color="bg-light"
                size="col-12"
                :disable-padding="true"
                :full-height="true"
                :animated="false"
                ref="progetto">
                <p class="error-page__title">
                    {{ this.title }}
                </p>
                <p class="error-page__paragraph">
                    {{ this.text }}
                </p>
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
    data: function() {
        return {
            error: true,
            title: null,
            text: null,
        }
    },
    watch: {
        '$root.window': function() {
            this.setPadding()
        },
        '$root.options': function(options) {
            this.setContent(options.error)
            this.translateStatic()
        },
        '$root.locale': function(locale) {
            this.translateStatic(locale)
        },
    },
    methods: {
        translateStatic: function(locale = false) {
            locale = locale ? locale : this.$root.locale
            switch (locale) {
                case 'en':
                    this.text = this.error ? this.error.txt_en : null
                    this.title = this.error ? this.error.title_en : null
                    break;
                case 'it':
                    this.text = this.error ? this.error.txt : null
                    this.title = this.error ? this.error.title : null
                    break;
            }
        },
        setContent: function(section) {
            this.error = section
            this.translateStatic()
        },
        setPadding: function() {
            if (this.$root.window.w <= 576) {
                this.$refs.section.style.paddingTop = '90px';
            } else {
                this.$refs.section.style.paddingTop = '130px';
            }
        },
    },
    mounted: function() {
        this.setPadding()
        if (this.$root.options) {
            this.setContent(this.$root.options.error)
        }
    }
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

.error-page {
    p {
        text-align: center;
    }

    &__title {
        font-weight: bold;
        font-size: 5rem;
    }

    &__paragraph {
        font-size: 1.5rem;
    }
}
</style>
