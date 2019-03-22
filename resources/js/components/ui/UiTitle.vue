<template lang="html">
    <div>
        <component
            :is="tag"
            class="ui-title"
            :class="[sizeClass, alignClass]"
            v-if="!this.isDisabled">
                {{ title }}
        </component>
        <component
            :is="tag"
            class="ui-title ui-title-disabled"
            :class="sizeClass"
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
        size: {
            type: String,
            default: 'h2',
        },
        align: {
            type: String,
            default: null,
        }
    },
    computed: {
        sizeClass: function() {
            return 'ui-title--'+this.size
        },
        alignClass: function() {
            if (this.align == 'center') {
                return 'ui-title--align-center'
            }

            return null
        }
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-title {
    $self: &;
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

    &#{$self}--h1 { font-size: $h1-font-size; }
    &#{$self}--h2 { font-size: $h2-font-size; }
    &#{$self}--h3 { font-size: $h3-font-size; }
    &#{$self}--h4 { font-size: $h4-font-size; }
    &#{$self}--h5 { font-size: $h5-font-size; }
    &#{$self}--h6 { font-size: $h6-font-size; }

    &#{$self}--align-center { text-align: center; }
}
</style>
