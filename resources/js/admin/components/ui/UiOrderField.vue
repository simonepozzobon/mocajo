<template lang="html">
    <div :class="colSizeClass">
        <div class="order-field row">
            <div class="col-md-3 order-field__label">
                {{ label }}
            </div>
            <div class="col-md-9 order-field__value">
                {{ value }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UiOrderField',
    props: {
        label: {
            type: String,
            default: 'label'
        },
        value: {
            type: String,
            default: 'value'
        },
        size: {
            type: [String, Number],
            default: null,
        }
    },
    computed: {
        colSizeClass: function() {
            if (this.size) {
                return 'col-md-'+this.size
            }
            return 'col-md-6'
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';

.order-field {
    padding-left: $spacer * 1.5;
    padding-right: $spacer * 1.5;
    padding-top: $input-padding-y;
    padding-bottom: $input-padding-y;
    margin-bottom: $form-group-margin-bottom;

    &__label {
        font-weight: $font-weight-bold;
        color: $gray-700;
    }

    &__value {
        text-align: right;
    }
}
</style>
