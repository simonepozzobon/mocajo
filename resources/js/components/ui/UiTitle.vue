<template lang="html">
    <div>
        <component
            :is="tag"
            class="ui-title"
            v-if="!this.isDisabled">
                {{ title }}
        </component>
        <component
            :is="tag"
            class="ui-title ui-title-disabled"
            v-else>
                {{ title }} <span>- Coming soon</span>
        </component>
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
        tag: {
            type: String,
            default: 'h2',
        },
    },
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-title {
    margin-bottom: $spacer * 2;
    text-transform: capitalize;
    letter-spacing: 2px;
    font-size: $h2-font-size;

    &.ui-title-disabled {
        color: $gray-400;

        > span {
            color: $primary;
            font-size: 0.65rem;
            text-transform: uppercase;
        }
    }
}
</style>
