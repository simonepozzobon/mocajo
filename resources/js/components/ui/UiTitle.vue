<template lang="html">
    <div>
        <h2 class="ui-title" v-if="!this.isDisabled">{{ title }}</h2>
        <h2 class="ui-title ui-title-disabled" v-else>{{ title }} <span>- Coming soon</span></h2>
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
</style>
