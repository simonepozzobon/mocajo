<template lang="html">
    <div>
        <h6 class="ui-subtitle" v-if="!this.isDisabled">{{ title }}</h6>
        <h6 class="ui-subtitle ui-subtitle-disabled" v-else>{{ title }}</h6>
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
        }
    },
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
}
</style>
