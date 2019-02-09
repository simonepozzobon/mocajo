<template lang="html">
    <div class="ui-collapse">
        <collapse-heading
            v-for="(item, i) in this.elements"
            :key="i"
            :title="item.title"/>

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
    margin-bottom: $spacer * 2 * 1.618;
}

</style>
