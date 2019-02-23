<template lang="html">
    <div>
        <h6 class="ui-subtitle" :class="noMarginClass" v-if="!this.isDisabled">{{ title }}</h6>
        <h6 class="ui-subtitle ui-subtitle-disabled" :class="noMarginClass" v-else>{{ title }}</h6>
    </div>
</template>

<script>
export default {
    name: 'UiTitle',
    props: {
        title: {
            type: String,
            default: null
        },
        isDisabled: {
            type: Boolean,
            default: false,
        },
        noMargin: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        noMarginClass: function() {
            if (this.noMargin) {
                return 'ui-subtitle-m0'
            }
            return null
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

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
