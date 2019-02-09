<template lang="html">
    <div class="ui-collapse">
        <collapse-heading
            title="descrizione" />
        <collapse-heading
            title="vitigno" />
        <collapse-heading
            title="zona" />
        <collapse-heading
            title="vitigno" />
        <collapse-heading
            title="vinificazione" />
        <collapse-heading
            title="valori analitici" />
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
        }
    }
}
</script>

<style lang="scss" >
@import '~styles/shared';

.ui-collapse {
    margin-bottom: $spacer * 2;

    .collapse-header {
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        border-bottom: 1px solid $black;
        padding: ($spacer / 2) * 1.618;
    }

}

</style>
