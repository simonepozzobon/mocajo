<template lang="html">
    <div class="ui-collapse">
        <div class="collapse-overlay" v-if="this.isDisabled"></div>
        <collapse-heading
            v-for="(item, i) in this.elements"
            :key="i"
            :title="item.title"
            :item="item"
            :is-disabled="isDisabled"/>
    </div>
</template>

<script>
import CollapseHeading from './subcomponents/CollapseHeading.vue'
export default {
    name: 'UiCollapse',
    components: {
        CollapseHeading,
    },
    props: {
        elements: {
            type: Array,
            default: function() {}
        },
        title: {
            type: String,
            default: 'titolo'
        },
        isDisabled: {
            type: Boolean,
            default: false,
        }
    },
    data: function() {
        return {
        }
    },
    methods: {
        openPanel: function(idx) {
            console.log(idx)
        }
    }
}
</script>

<style lang="scss" >
@import '~styles/shared';

.ui-collapse {
    position: relative;
    margin-bottom: $spacer * 2 * 1.618;


    .collapse-overlay {
        position: absolute;
        width: 110%;
        height: 110%;
        border-radius: 2%;
        padding: $spacer;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba($light-dark, .8);
    }
}

</style>
