<template lang="html">
    <div class="col-md-6 ui-block" :class="color" ref="block">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'UIBlock',
    props: {
        color: {
            type: String,
            default: null
        },
        imgSrc: {
            type: String,
            default: null,
        }
    },
    methods: {
        setBackground: function() {
            if (this.imgSrc) {
                this.$refs.block.style.backgroundImage = 'url('+this.imgSrc+')'
            }
        }
    },
    mounted: function() {
        this.setBackground()
    }
}
</script>

<style lang="scss">
@import '~styles/shared';

.ui-block {
    min-height: 30vh;

    background-size: cover;
    background-position: center;
    padding: $spacer * 4;
}
</style>
