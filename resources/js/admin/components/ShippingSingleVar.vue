<template lang="html">
    <div class="single-var row">
        <div class="col-md-2">{{ variation.left }}</div>
        <div class="col-md-2">{{ variation.operator }}</div>
        <div class="col-md-2">{{ variation.right }}</div>
        <div class="offset-md-1 col-md-2">{{ variation.price }} €</div>
        <div class="col-md-3">
            <button class="btn btn-outline-danger" @click="deleteVar">
                Elimina
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShippingSingleVar',
    props: {
        variation: {
            type: Object,
            default: function () {
                return {}
            },
        },
    },
    methods: {
        deleteVar: function () {
            this.$emit('delete', this.variation.uuid)
        }
    },
}
</script>

<style lang="scss" scoped>
@import '~styles/shared';
</style>
