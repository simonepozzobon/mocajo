<template lang="html">
    <div :id="this.nameToLower + '-menu'" class="product-menu" @click="goTo">
        <img :src="svgSrc" class="product-img" />
    </div>
</template>

<script>
export default {
    name: 'ProductMenuIcon',
    props: {
        idx: {
            type: Number,
            default: null,
        },
        svgSrc: {
            type: String,
            default: null,
        },
        title: {
            type: String,
            default: null,
        }
    },
    computed: {
        nameToLower: function() {
            if (this.title) {
                return this.title.toLowerCase()
            }
            return null
        }
    },
    methods: {
        goTo: function() {
            this.$emit('go-to', this.nameToLower)
        }
    }
}
</script>

<style lang="css" scoped>
</style>
